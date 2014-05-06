<?php session_start(); 
include_once 'sqlsrv_connect.php';
include_once 'lib_mailer.php';

$check1=$_SESSION["pass_key1"];

$check2=$_SESSION["pass_key2"];


$pw1 = $_POST['pw'];
$pw2 = $_POST['pw2'];


$sql = "select log,email from company where log like '$check1' and email like '$check2'";




if ($check1 == null || $check2 == null || $pw1 == null || $pw2 == null || $pw1 !== $pw2 ) {
 echo "<meta http-equiv='content-type' content='text/html; charset=UTF-8'  />"; 	
 echo "<script language=javascript>";
 echo "window.alert('很抱歉，驗證碼有空或不相符。')"; 
 echo "</script>";
 echo "<META HTTP-EQUIV='refresh' CONTENT='0;URL=login.php'>";
}else{

$stmt = sqlsrv_query( $conn, $sql);

if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
     
}
$info=sqlsrv_fetch_array($stmt);


if($info==False){
 echo "<meta http-equiv='content-type' content='text/html; charset=UTF-8'  />"; 	
 echo "<script language=javascript>";
 echo "window.alert('很抱歉，你是駭客!請乖乖登入')"; 
 echo "</script>";
 echo "<META HTTP-EQUIV='refresh' CONTENT='0;URL=login.php'>";
  
}else{

$mdpw=md5($pw2);
$pwsetsql = "update company set pw= '$mdpw',log = null where log like '$check1' and email like '$check2'";


$stmt = sqlsrv_query( $conn, $pwsetsql);
if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));   
}else{




$emailaddress_target = $check2;
$email_title = "您好，關於您在長榮大學媒合系統的使用者密碼。";
$email_body = "您好，恭喜您! 您的密碼已經變更完成。";
$alert_something = "<meta http-equiv='content-type' content='text/html; charset=UTF-8'  />"."<script language=javascript>"."window.alert('您的密碼已經修改完成!')"."</script>"."<META HTTP-EQUIV='refresh' CONTENT='0;URL=login.php'>"; 	

send_email($emailaddress_target,$email_title,$email_body,$alert_something);











}










}






}




?>