<? session_start(); 
include_once("cjcuweb_lib.php");

if(isset($_GET['workid'])) $work_id=$_GET['workid']; else{header("Location: home.php"); exit;}
if(isset($_SESSION['username'])) $user_id = $_SESSION['username'];
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/company_manage.css">
	<style type="text/css">
	#ch{
		font-size: 16px;

		margin-left: 10px;
	}
	#date{
		font-size: 12px;
		color: #555;
	}
	#btn-apply{
		width: 100px;
		height: 40px;
		font-size: 16px;
		background-color: #CC6600;
		color: #FFF;
		text-align: center;
		font-weight: bold;
		border: none;
		cursor: pointer;
		margin-top: 50px;
	}

	#btn-apply:hover{
		background-color: #FF9900;
	}
	.b-space{
		margin-bottom: 100px;
	}
	</style>
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

	<script>

	<? 
	include_once("js_work_detail.php"); 
	echo_work_detail_array($_GET['workid']);  ?> 

	<? include_once('js_work_list.php'); 
	echo_work_manage_list_array($GLOBALS['cust_company']);  ?> 

	<? include_once("js_company_detail.php"); 
	echo_company_detail_array($GLOBALS['cust_company']); 
	?> 

	</script>
	<script>


	/*
	var work_detail_array = 
	{"name":"\u7a7a\u5eda","date":"2014-03-09 15:43:32.997",
	"company_id":"cjcu","typeone":"\u9910\u98f2\u65c5\u904a\u904b\u52d5",
	"typetwo":"\u7cfb\u7d71\u5206\u6790\u5de5\u7a0b\u5e2b",
	"typethree":"\u8cc7\u8a0a\u652f\u63f4\u8207\u670d\u52d9",
	"start_date":"2014-01-01 00:00:00","end_date":"2014-01-01 00:00:00",
	"popname":"\u5de5\u8b80","is_outside":0,"zonename":"\u81fa\u5317\u5e02",
	"address":"\u53f0\u5357\u5e02","phone":"03311111","pay":"1111111",
	"recruitment _no":3,"detail":"11vwevwvwevw","check":0};
	*/
	$(function(){	

		$('#view-header').load('../public_view/header.php #header');

		$('#profile-btn-edit').hide();



		// init load data
		$('title, #name').text(work_detail_array['name']);
		$('#date').text(work_detail_array['date'].split(" ")[0]);
		$('#prop').text( (work_detail_array['is_outside']=='0'?'校內':'校外')+' '+ work_detail_array['popname']);
		$('#type').text(work_detail_array['typeone']+" > "+work_detail_array['typetwo']+" > "+work_detail_array['typethree']);
		$('#rno').text(work_detail_array['recruitment _no']);
		$('#pay').text(work_detail_array['pay']);
		$('#start_date').text(work_detail_array['start_date'].split(" ")[0]);
		$('#end_date').text(work_detail_array['end_date'].split(" ")[0]);
		$('#phone').text(work_detail_array['phone']);
		$('#address').text(work_detail_array['address']);
		$('#detail').text(work_detail_array['detail']);

		if(work_detail_array['check']=='0')
			$('#ch').text('未審核').css('color', '#444');
		else if(work_detail_array['check']=='1')
			$('#ch').text('審核通過').css('color', '#339933');
		else
			$('#ch').text('審核不通過').css('color', '#CC3333');
		// in this way, check = 2 or 3 is not pass

		<?
			function isapplywork($user_id,$work_id){
				include("sqlsrv_connect.php");
				$sql="select count(user_id) from line_up where user_id=? and work_id=?";
		        $params = array($user_id,$work_id);
		        $result = sqlsrv_query($conn, $sql, $params);
		        if($result){
		        	$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC);   
		        	if($row[0]==0) return true;
		        	return false;
		       }else return false;
			}
			if(isset($_SESSION['username']) && $_SESSION['level']==$level_student && isapplywork($user_id,$work_id))
				echo "show_apply_form();";
		?>

		function show_apply_form(){
			var wid= $('<input>').attr({type: 'hidden',	name: 'workid'}).val(<? echo $_GET['workid'];?>),
			submit = $('<input>').attr({type: 'submit',name: 'button',id:'btn-apply'}).val('我要應徵'),
			form = $('<form>').attr({name:'getjobform',method:'post',action:'../student_apply_job.php',id:'apply_form'});
			$('.profile-boxleft').append(form.append(wid).append(submit));
		}



		if(work_detail_array['company_id']==<? echo "'".$_SESSION['username']."'"; ?>){
			$('#profile-btn-edit').show().attr('href', '../company_manage.php#work'+<? echo "'".$_GET['workid']."'"; ?>);
		}


		var listbox = $('#other_work');
		for(var i=0;i<work_list_array.length;i++){
			var container = $('<p>').addClass('profile-span-box'),
			tita = $('<a>').attr('href', '../work/'+work_list_array[i]['wid']).addClass('profile-span-left').text(work_list_array[i]['wname']),
			titloc = $('<span>').addClass('profile-span-right').text((work_list_array[i]['isout']=='0'?'校內 ':'校外 ')+ work_list_array[i]['propname']);
			listbox.append(container.append(tita).append(titloc));
		}

		$('#cp_name').append($('<a>').attr('href', '../company/'+<? echo "'".$GLOBALS['cust_company']."'"; ?>).text(company_detail_array['ch_name']));
		$('#cp_type').text(company_detail_array['typename']);
		$('#cp_boss').text(company_detail_array['name']);
		$('#cp_phone').text(company_detail_array['phone']);



	});
	</script>
</head>


<body>
<div id="view-header"></div><br>

<div class="div-align overfix b-space">


<div class="profile-boxleft">
<h1><span id="name"></span><span id="ch"></span><a id="profile-btn-edit" href="">修改</a> </h1>
<br>
<span id="date"></span>
<br>
<br>

<p><span class="profile-span-title">類型</span><span id="type"></span></p>
<p><span class="profile-span-title">性質</span><span id="prop"></span></p>
<p><span class="profile-span-title">招募人數</span><span id="rno"></span></p>
<p><span class="profile-span-title">待遇</span><span id="pay"></span></p>
<br><hr><br>

<h3>招募時間</h3>
<p><span class="profile-span-title">開始時間</span><span id="start_date"></span></p>
<p><span class="profile-span-title">結束時間</span><span id="end_date"></span></p>


<br><hr><br>

<h3>聯絡方式</h3>
<p><span class="profile-span-title">電話</span><span id="phone"></span></p>
<p><span class="profile-span-title">地址</span><span id="address"></span></p>

<br><hr><br>

<h3>詳細內容</h3>
<span id="detail"></span><br>

</div>


<div class="profile-boxright">

<div class="profile-boxinner" id="about_work"><h2>關於公司</h2>

<p class="profile-span-box">
<span class="profile-span-left">名稱</span>
<span class="profile-span-right" id="cp_name"></span></p>

<p class="profile-span-box">
<span class="profile-span-left">類型</span>
<span class="profile-span-right" id="cp_type"></span></p>

<p class="profile-span-box">
<span class="profile-span-left">負責人</span>
<span class="profile-span-right" id="cp_boss"></span></p>

<p class="profile-span-box">
<span class="profile-span-left">連絡電話</span>
<span class="profile-span-right" id="cp_phone"></span></p>


</div>

<div class="profile-boxinner" id="other_work"><h2>其他職缺</h2></div>

</div>


</div>



</body>
</html>
