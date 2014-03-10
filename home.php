<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>


<body>
<h1>長榮大學-媒合系統</h1>
<hr>

<?
include_once("cjcuweb_lib.php");

if(isset ($_SESSION['username'])){
$who="";
switch ($_SESSION['level']) {
	case 3: $who = "同學"; break;
	case 4: $who = "廠商"; break;
	case 2: $who = "老師"; break;
	case 1: $who ="員工";break;
	default: $who = "駭客";break;
}

echo "你好".$who." ".$_SESSION['username']."&nbsp;" ;

	$company_id = $_SESSION['username'];
	if( $_SESSION['level'] == $level_company) {
		echo '<form  name="company_detail_form" action="company_detail.php" method="post"><input name="company_id" type="hidden" value="'.$company_id.'"></form>';
		echo '<a href="#" onclick="document.company_detail_form.submit();">公司資訊</a>&nbsp;';
		echo '<a href="company_work_list.php">管理工作</a>&nbsp;';
		echo '<a href="add_work.php">新增工作</a>&nbsp;';
	}

	else if( $_SESSION['level'] == $level_student){
		echo '<a href="student_work.php">我的應徵</a>&nbsp;';
	}


echo '<a href="logout.php">登出</a>&nbsp;';
}	

else echo '<a href="login.html">登入</a>';

?>

<h1>工作列表</h1>
<? include_once('work_list_lib.php'); work_list(NULL); ?>
</body>
</html>