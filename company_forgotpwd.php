<!doctype html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>密碼找回</title>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>


<style type="text/css">
#email_chk{
color: red;

}	


</style>

</head>
<body>
<h1>密碼找回</h1><hr>
<form name="check" method="post" action="company_forgotpwd_chk.php" onsubmit="return check_email();">
請輸入當初所註冊的EMAIL：<input type="text" name="foundemail" id="foundemail" /><span id="email_chk"></span><br><br>
<input type="submit" name="button" value="送出" /></form>



<script type="text/javascript">
	
function check_email(){



	var boo = true;
	if(document.check.foundemail.value ==""){
		$('#email_chk').text("Email不可為空");
		boo = false;
	}
	else $('#email_chk').text("");
	return boo;
}





</script>
</body>
</html>