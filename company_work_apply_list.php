<? session_start(); 

include("cjcuweb_lib.php");
include("sqlsrv_connect.php");


if(isset($_SESSION['username'])) $company_id = $_SESSION['username']; 
else{
	echo "No permission!"; 
	exit;
} 

if( !isCompanyWork($conn,$_SESSION['username'],$_GET['workid']) || 
	$_SESSION['level']!=$level_company){
	echo 'No permission!';
	exit;
}

// 是否為該公司的工作
function isCompanyWork($conn,$companyid,$workid){
	$sql = "select company_id from work where id=?";
	$params = array($workid);
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$result = sqlsrv_query($conn,$sql,$params,$options);
	$row = sqlsrv_fetch_array($result,SQLSRV_FETCH_NUMERIC);
	if($row[0]==$companyid) return true;
	else return false;
}


?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/company_worK_apply_list.css">
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

    <script><? include_once('js_company_work_detai_list.php'); echo_company_work_apply_list_array($_GET['workid']);  ?>
    /*
    <div class="work-list-box">
	<div class="sub-box"><img src="" class="work-img"></div>
	<div class="sub-box">
		<h1 class="work-tit"><a href="#">Chou Gun Gun</a></h1>
		<p class="work-hint"><a href="#">下載履歷</a></p>
	</div>
	<div class="sub-box2">
		<input type="button" value="錄取" class="passing-btn">
		<input type="button" value="不錄取" class="notpassing-btn" >
	</div>
	</div>*/
    $(function(){
    	var body = $('#company-work-list-container');
    	for(var i=0;i<company_work_apply_list_array.length;i++){

    		var wimg = $('<img>').attr('src', 'http://akademik.unissula.ac.id/themes/sia/images/user.png').addClass('work-img'),
    			tita = $('<a>').attr('href', 'student/'+company_work_apply_list_array[i]['user_id']).text(company_work_apply_list_array[i]['user_id']),
    			doca = $('<a>').attr('href', 'doc/'+company_work_apply_list_array[i]['doc']).text('下載履歷'),
    			passbtn = $('<input>').attr({type: 'button', value: '錄取'}).addClass('passing-btn'),
    			notpassbtn = $('<input>').attr({type: 'button', value: '不錄取'}).addClass('notpassing-btn'),

    			subbox1 = $('<div>').addClass('sub-box').append(wimg),
    			subbox2 = $('<div>').addClass('sub-box').append($('<h1>').addClass('work-tit').append(tita))
    			.append($('<p>').addClass('work-hint').append(doca)),
    			subbox3 = $('<div>').addClass('sub-box2');

    			

    			passbtn.on('click',{arr:company_work_apply_list_array[i]},function(event) {
    				var t = $(this);
					$.ajax({
					  type: 'post',
					  url: 'company_work_apply_user.php',
					  data: {check:1,user: event.data.arr['user_id'] ,workid:<? echo $_GET['workid']; ?>},
					  success: function (data) {

						console.log(data); 

					  	var result = (data=='0')? "更新失敗" : "已錄取";
					  	var target = t.parent(".sub-box2");
					  	target.empty();
					  	target.append($('<div>').addClass('isapply').text(result));  
					  }
					});
    			});

    			notpassbtn.on('click',{arr:company_work_apply_list_array[i]},function(event) {
    				var t = $(this);
    				$.ajax({
					  type: 'post',
					  url: 'company_work_apply_user.php',
					  data: {check:2, user: event.data.arr['user_id'] ,workid:<? echo $_GET['workid']; ?>} ,
					  success: function (data) { 
					  	console.log(data); 
					  	var result = (data=='0')? "更新失敗" : "不錄取";
					  	var target = t.parent(".sub-box2");
					  	target.empty();
					  	target.append($('<div>').addClass('isnotapply').text(result));  
					  }
					});
    			});


				switch(company_work_apply_list_array[i]['check']) {
					case 0:
						subbox3.append(passbtn).append(notpassbtn);break;
					case 1:
						subbox3.append($('<div>').addClass('isapply').text('已錄取'));break;
					case 2:
						subbox3.append($('<div>').addClass('isnotapply').text('不錄取'));break;	
				}	
			var mainbox = $('<div>').addClass('work-list-box').append(subbox1).append(subbox2).append(subbox3);
				body.append(mainbox);
    	}



    	
    });
    </script>
</head>
<body>
<!--
<div id='search-box'>
<input type='text' placeholder='搜尋應徵者名稱' id='search-txt'>
<input type="button" value="搜尋" id='search-btn'>
</div>-->
<h3>應徵者列表</h3>
<div id='company-work-list-container'></div>
</body>
</html>