<? session_start(); 

if(isset($_POST['work_id'])){
	$work_id=$_POST['work_id'];
}
else{
	//重定向瀏覽器 且 後續代碼不會被執行 
	header("Location: home.php"); 
	exit;
}
//if(isset($_SESSION['username']) || isset($_SESSION['level'])==){}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>工作詳情</title>
	<script>
	<? include_once("js_work_detail.php");	?>


	</script>
</head>


<body>
<h1>工作詳情</h1><hr>

	<table border="1">
		<tr></tr><tr></tr>

	</table>




</body>



</html>