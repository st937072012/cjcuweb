<? session_start(); 
if(isset($_SESSION['username'])) $company_id = $_SESSION['username']; 
else{header("Location: home.php"); exit;} ?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/work.css">
</head>
<body>
<? include_once('work_list_lib.php'); work_list($company_id); ?>
</body>
</html>