<? session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

include("mysql_connect.inc.php");

$id = mysql_real_escape_string( trim($_POST['id']));
$pw = mysql_real_escape_string( trim($_POST['pw']));
$ch_name = mysql_real_escape_string( trim($_POST['ch_name']));
$en_name = mysql_real_escape_string( trim($_POST['en_name']));
$phone = mysql_real_escape_string( trim($_POST['phone']));
$fax = mysql_real_escape_string( trim($_POST['fax']));
$uni_num = mysql_real_escape_string( trim($_POST['uni_num']));
$name = mysql_real_escape_string( trim($_POST['name']));
$pic = mysql_real_escape_string( trim($_POST['pic']));
$email = mysql_real_escape_string( trim($_POST['email']));
$type = mysql_real_escape_string( trim($_POST['type']));
$zone = mysql_real_escape_string( trim($_POST['zone']));
$adress = mysql_real_escape_string( trim($_POST['address']));
$budget = mysql_real_escape_string( trim($_POST['budget']));
$introduction = mysql_real_escape_string( trim($_POST['introduction']));
$doc = mysql_real_escape_string( trim($_POST['doc']));
$stuff_num =mysql_real_escape_string( trim( $_POST['stuff_num']));
$url = mysql_real_escape_string( trim($_POST['url']));




if(empty($id) || empty($pw) || empty($ch_name) || empty($uni_num) || empty($name) || empty($address)){
	echo 'You are hacker!';
    echo '<meta http-equiv=REFRESH CONTENT=1;url=add_company.php>';
}

else{
	// MD5加密
	$pw = md5($pw);
	$sql = "insert into company(id,password,ch_name,en_name,phone,fax,uni_num,name,pic,email,zone_id,address,budget,introduction,doc,stuff_num,url)value('$id','$pw','$ch_name','$en_name','$phone','$fax','$uni_num','$name','$pic','$email','$zone','$address','$budget','$introduction','$doc','$stuff_num','$url')";
	$result = mysql_query($sql);

	if($result){
		echo '註冊成功! 跳轉中，請稍候...';
		echo '<meta http-equiv=REFRESH CONTENT=1;url=company_login.php>';
	}
	else{
		echo '註冊失敗! 跳轉中，請稍候...';
		echo '<meta http-equiv=REFRESH CONTENT=1;url=add_company.php>';
	}
}

?>