<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>密碼重置</title>



<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

<style type="text/css">

#pw_hint1{

color: red;

}	

#pw_hint2{

color: red;
	
}	


</style>


</head>
<body>
<h1>密碼重置</h1><hr>
<form name="password_reset" method="post" action="company_emailpwd_modify.php" onsubmit="return check_data();">
密碼*：<input type="password" name="pw" id="pw" /> <span id="pw_hint1"></span> <br>
再一次輸入密碼*：<input type="password" name="pw2" id="pw2" /> <span id="pw_hint2"></span><br>


<input type="submit" name="button" value="確定" />
<input type="button"  value="取消" onclick="location.href='login.php'"/>
</form>



<script type="text/javascript">
	


function check_data(){
	var boo = true;
	if(document.password_reset.pw.value ==""){
		$('#pw_hint1').text("密碼為空");
		boo = false;


	}
	else $('#pw_hint1').text("");

	if(document.password_reset.pw2.value ==""){
		$('#pw_hint2').text("再次輸入密碼為空");
		boo = false;
	}
	else $('#pw_hint2').text("");


    if((document.password_reset.pw.value!=document.password_reset.pw2.value)&&(document.password_reset.pw2.value!="")){

	$('#pw_hint2').text("再次輸入密碼與第一次輸入的密碼不相符");
	boo = false;
   }else if(document.password_reset.pw2.value ==""){
		$('#pw_hint2').text("再次輸入密碼為空");
		boo = false;
	}
    else $('#pw_hint2').text("");



  

	return boo;
}






</script>

</body>


</html>