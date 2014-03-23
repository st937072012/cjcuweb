<? session_start(); 
if(isset($_SESSION['username'])) $user_id = $_SESSION['username']; 
else{header("Location: home.php"); exit;} ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>我的應徵列表</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script> $(function(){$('#view-header').load('public_view/header.php #header');});</script>
	<!-- 取得公司資訊 -->
</head>
<body>
<div id="view-header"></div>
<h1>應徵列表</h1><hr>
<a href="home.php">回首頁</a><br>
<? include_once('work_list_lib.php'); student_work_list($user_id); ?>
</body>
</html>