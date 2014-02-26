<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>廠商登入</title>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript">
	
function check_data(){
	var boo = true;
	if(document.company_login.id.value ==""){
		$('#id_hint').text("account is null");
		boo = false;
	}
	else $('#id_hint').text("");
	if(document.company_login.pw.value ==""){
		$('#pw_hint').text("password is null");
		boo = false;
	}
	else $('#pw_hint').text("");
	return boo;
}


</script>
</head>
<body>
<h1>廠商登入</h1><hr>
<form name="company_login" method="post" action="company_connect.php" onsubmit="return check_data()">
帳號：<input type="text" name="id" /><span id="id_hint"></span> <br>
密碼：<input type="password" name="pw" /><span id="pw_hint"></span><br><br>
<input type="submit" name="button" value="登入" />
<a href="add_company.php">申請帳號</a> 
<a href="home.php">回首頁</a>

</form>
</body>
</html>



