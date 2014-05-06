<? 
session_start();
$lev = $_SESSION['level'];
$user = $_SESSION['username'];



function echo_data($user,$lev){
	//if($lev=='0')$lev = $_SESSION['level2'];

	include("../cjcuweb_lib.php");
	if(isset ($user)){
		//echo $user ;
		if( $lev == $level_company) {/*
			echo '<span><a href="../../../cjcuweb/company/'.$company_id.'">公司資訊</a></span>';
			echo '<span><a href="../../../cjcuweb/company_work_list.php">管理工作</a></span>';
			echo '<span><a href="../../../cjcuweb/add_work.php">新增工作</a></span>';
			echo '<span><a href="../../../cjcuweb/company_manage_apply.php">管理應徵</a></span>';*/
			echo '<span><a href="../../../cjcuweb/company/'.$user.'">'.$user.'</a></span>';
			echo '<span><a href="../../../cjcuweb/company_manage.php">管理</a></span>';
		}
		else if( $lev == $level_student){
			/*echo '<span><a href="../../../cjcuweb/student_work.php">我的應徵</a></span>';*/
			echo '<span><a href="../../../cjcuweb/student/'.$user.'">'.$user.'</a></span>';
			echo '<span><a href="../../../cjcuweb/student_manage.php">管理</a></span>';
		}
		else if( $lev == $level_staff){
			echo '<span><a href="../../../cjcuweb/staff/'.$user.'">'.$user.'</a></span>';
			echo '<span><a href="../../../cjcuweb/staff_manage.php">管理</a></span>';
		}
		else if( $lev == $level_teacher){
			echo '<span><a href="../../../cjcuweb/teacher/'.$user.'">'.$user.'</a></span>';
			echo '<span><a href="../../../cjcuweb/teacher_manage.php">管理</a></span>';
		}
//
		echo '<span><a href="../../../cjcuweb/notice.php">通知</a></span>';
		echo '<span><a href="../../../cjcuweb/logout.php">登出</a></span>';

	}	
	else echo '<span><a href="../../../cjcuweb/login.php">登入</a></span>';

	//echo $user." >".$lev." >".$level_student ." >" .$_SESSION['level2'];
}
?>


<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
<div id="header" class="div-align">
<!--<div id="header">-->
	<div class="sub"><a href="../../../cjcuweb/home.php"><h1>長大職涯</h1></a></div>
	<div class="sub2"> 
	<? echo_data($user,$lev)	 ?>  

	</div>
</div>

</body>
</html>