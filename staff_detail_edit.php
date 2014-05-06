<? session_start(); 
include('cjcuweb_lib.php');
if(!isset( $_SESSION['username']) ||  $_SESSION['level']!= $level_staff ) {
 	echo "No permission"; exit; }
?>
<!doctype html>
<html>
<head>
	<script><? include_once("js_staff_detail.php"); echo_staff_detail_array($_SESSION['username']); ?></script>
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script>

	$(function(){
		$('#st_name').val(staff_detail_array.user_name);
		$('#st_dep').val(staff_detail_array.dep_name);
		$('#st_pic').val(staff_detail_array.pic);
		$('#st_phone').val(staff_detail_array.phone);
		$('#st_mail').val(staff_detail_array.email);
		$('#st_self').val(staff_detail_array.role=='1'?'管理員':'教職員');
	});

</script>

	
</head>

<body>


<form method="post" action="updata.php" id="detail">
	
	<span>姓名</span><input name="st_name" id="st_name" type="text"><br>
	<span>科系</span><input name="st_dep" id="st_dep" type="text" disabled><br>
	<span>大頭貼照</span><input name="st_pic" id="st_pic" type="text"><br>
	<span>電話</span><input name="st_phone" id="st_phone" type="text"><br>
	<span>Email</span><input name="st_mail" id="st_mail" type="text"><br>
	<span>身分</span><input name="st_self" id="st_self" type="text" disabled><br><br>
	<input type='submit' value='修改'><br>

</form>

</body>
</html>
