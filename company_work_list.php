<? session_start(); 
if(isset($_SESSION['username'])) $company_id = $_SESSION['username']; 
else{header("Location: home.php"); exit;} ?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<!-- 取得公司資訊 -->
</head>
<body>
<? include_once('work_list_lib.php'); work_list($company_id); ?>
</body>
</html>