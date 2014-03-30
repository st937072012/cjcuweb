<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>帳號登入</title>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/member.css">
<script type="text/javascript">

function check_data(){

	var boo = true;

	if(document.company_login.sel.value ==""){
		  $('#sel_hint').text("select is null");
		  boo = false;
	}else $('#sel_hint').text("");

	if(document.company_login.id.value ==""){
		  $('#id_hint').text("account is null");
	  	  boo = false;
	}else $('#id_hint').text("");

	if(document.company_login.pw.value ==""){
		  $('#pw_hint').text("password is null");
		  boo = false;
	}else $('#pw_hint').text("");

	return boo;
}


</script>
</head>
<body>
<div id="view-header"><div id="header" class="div-align">
<div class="sub"><a href="../../../cjcuweb/home.php"><h1>長榮大學 媒合系統</h1></a></div>
</div></div>

<div id="cont" class="login">

<h1>帳號登入</h1><hr>
<form class="form" name="login" method="post" action="login_connect.php" onsubmit="return check_data()">
請選擇登入身分
<select name ="sel" >
  <option value=""></option>
  <option value="student">學生</option>
  <option value="company">廠商</option>
  <option value="staff">老師</option>
</select><span id="sel_hint"></span> <br>

帳號：<input type="text" name="id" /><span id="id_hint"></span> <br>
密碼：<input type="password" name="pw" /><span id="pw_hint"></span>

<input type="submit" class="submit" name="button" value="登入" /><br><br>
<a href="company_add.php">廠商註冊</a>　
<a href="company_forgotpwd.php">忘記密碼</a> 　
<a href="home.php">回首頁</a><br>

</form>


</div>
</body>
</html>



