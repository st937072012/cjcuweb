<?php
	include_once 'sqlsrv_connect.php';
  include_once 'lib_mailer.php';

	$email = $_POST['foundemail'];
    $sql = "select email from company where email like '$email'";
    
   

if ($email==null) {
	
 echo "<meta http-equiv='content-type' content='text/html; charset=UTF-8'  />";  
 echo "<script language=javascript>";
 echo "window.alert('很抱歉，Email不可為空!')"; 
 echo "</script>";
 echo "<META HTTP-EQUIV='refresh' CONTENT='0;URL=company_forgotpwd.php'>";


}else{




$stmt = sqlsrv_query( $conn, $sql);

if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
     
}
$info=sqlsrv_fetch_array($stmt);





if($info==False){
 echo "<meta http-equiv='content-type' content='text/html; charset=UTF-8'  />";   
 echo "<script language=javascript>";
 echo "window.alert('很抱歉，此Email並不存在!')"; 
 echo "</script>";
 echo "<META HTTP-EQUIV='refresh' CONTENT='0;URL=company_forgotpwd.php'>";
  
}

else{
    


if (!empty($_SERVER['HTTP_CLIENT_IP']))
{
  $ip=$_SERVER['HTTP_CLIENT_IP'];
}
else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
{
  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}
else
{
  $ip=$_SERVER['REMOTE_ADDR'];
}




$allkey=md5($ip).md5($email).md5(date("Y-m-d H:i:s")).md5("60");
$keysql = "update company set log= '$allkey' where email like '$email'";


$stmt = sqlsrv_query( $conn, $keysql);
if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
     
}


       


$mail_link="http://localhost/cjcuweb/company_emailpwd_chk?key=".$allkey."&emailkey=".$email; //上線後ip必須更改為正確的index

$email_title = "您好，關於您在長榮大學媒合系統的使用者密碼。";  
$email_body =  "<a  href=\"$mail_link\">您曾送出了修改密碼的請求，請點我修改密碼。</a>"; 

$emailaddress_target = $info['email']; 


$alert_something = "<meta http-equiv='content-type' content='text/html; charset=UTF-8'  />"."<script language=javascript>"."window.alert('寄送成功! 您的密碼重新設定認證信已經寄到".$info['email']."請到您的信箱進行密碼重新設定!')"."</script>"."<META HTTP-EQUIV='refresh' CONTENT='0;URL=login.php'>";  


send_email($emailaddress_target,$email_title,$email_body,$alert_something);





	






}
}
	

?>