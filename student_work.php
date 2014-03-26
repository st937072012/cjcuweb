<? session_start(); 
if(isset($_SESSION['username'])) $user_id = $_SESSION['username']; 
else{header("Location: home.php"); exit;} ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
</head>
<body>
<? include_once('work_list_lib.php'); student_work_list($user_id); ?>
</body>
</html>