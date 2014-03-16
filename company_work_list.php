<? session_start(); 
if(isset($_SESSION['username'])) $company_id = $_SESSION['username']; 
else{header("Location: home.php"); exit;} ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>管理工作</title>
	<!-- 取得公司資訊 -->
</head>
<body>
<h1>管理工作</h1><hr>
<a href="home.php">回首頁</a><br>
<? include_once('work_list_lib.php'); work_list($company_id); ?>
</body>
</html>