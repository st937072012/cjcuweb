<?php session_start(); 
function echo_data(){
	include_once("../cjcuweb_lib.php");
	if(isset ($_SESSION['username'])){
		//echo $_SESSION['username'] ;
		$company_id = $_SESSION['username'];
		if( $_SESSION['level'] == $level_company) {
			echo '<span><a href="../../../cjcuweb/company/'.$company_id.'">公司資訊</a></span>';
			echo '<span><a href="../../../cjcuweb/company_work_list.php">管理工作</a></span>';
			echo '<span><a href="../../../cjcuweb/add_work.php">新增工作</a></div>';
		}
		else if( $_SESSION['level'] == $level_student){
			echo '<span><a href="../../../cjcuweb/student/'.$_SESSION['username'].'">'.$_SESSION['username'].'</a></span>';
			echo '<span><a href="../../../cjcuweb/student_work.php">我的應徵</a></span>';
		}
	echo '<span><a href="../../../cjcuweb/logout.php">登出</a></span>';
	}	
	else echo '<span><a href="../../../cjcuweb/login.html">登入</a></span>';
}
?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
<div id="header">
<!--<div id="header">-->
	<div class="sub"><a href="../../../cjcuweb/home.php"><h1>長榮大學 媒合系統</h1></a></div>
	<div class="sub2"><? echo_data(); ?></div>
</div>
</body>
</html>