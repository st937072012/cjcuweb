<? session_start(); 
include_once("cjcuweb_lib.php");

if(isset($_GET['workid'])) $work_id=$_GET['workid']; else{header("Location: home.php"); exit;}
if(isset($_SESSION['username'])) $user_id = $_SESSION['username'];
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>工作資料</title>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/work_detail.css">

	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

</head>


<body>
<div id="view-header"></div>


<div class="div-align overfix">



	<div id="work_detail" class="work-box">
	    <div id="page-menu">
            <a href="#edit"> <div class="page">修改</div></a>
            <a href="#copy"> <div class="page">設定</div></a>
            <a href="#check"><div class="page">審核</div></a>
	    </div><br class="menu-end">

	    <div id="page-cont">
	       
	    </div>
	</div>


	<div id="company_detail" class="work-company-box" >
		<h1>關於公司</h1>
		<p>ewewfewf</p>
		<p>ewewfewf</p>
		<p>ewewfewf</p>
		<p>ewewfewf</p>
		<p>ewewfewf</p>
	</div>
</div>


<script>
//載入頁面時 依照hash秀出對應的頁面
$(document).ready(function(){

    if(location.hash){  var newhash = window.location.hash.substring(1);
    //載入hash並動作   
   
    gotohash(newhash);
    }

});

//當hash發生改變 
window.onhashchange = function(){
       
    if(location.hash){  var hash = location.hash.substring(1);
    //載入hash並動作
    gotohash(hash);
   

    }
}


function gotohash (hash){
	var url = "";

    switch(hash){
        case 'edit':
            url = "work_detail_edit.php?workid="+<? echo $work_id; ?>;
        break;
        case 'copy':
			url = "work_detail_copy.php";
        break;
        case 'check':
            url = "work_detail_check.php";
        break;
    }
        
    $.ajax({
			  type: 'get',
			  url: '../'+url,
			  data: {},
			  success: function (data) { $('#page-cont').html(data) ;  }
	});

}


</script>

</body>
</html>
