<?php session_start(); 
include_once 'sqlsrv_connect.php';
include("class.phpmailer.php");

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




set_time_limit(1000);//設定PHP執行時間
$mail= new PHPMailer(); //建立新物件
$mail->IsSMTP(); //設定使用SMTP方式寄信
$mail->SMTPAuth = true; //設定SMTP需要驗證
$mail->SMTPSecure = "ssl"; // Gmail的SMTP主機需要使用SSL連線
$mail->Host = "smtp.gmail.com"; //Gamil的SMTP主機
$mail->Port = 465;  //Gamil的SMTP主機的埠號(Gmail為465)。
$mail->CharSet = "utf-8"; //郵件編碼

$mail->Username = "st937072000@gmail.com"; //寄信Gamil帳號
$mail->Password = "wetai30254"; //寄信Gmail密碼

$mail->From = "www.cjcu.edu.tw"; //寄件者信箱，也可以與寄信的帳號一樣
$mail->FromName = "長榮大學職涯發展中心"; //寄件者姓名

$mail->Subject ="您好，關於您在長榮大學媒合系統的使用者密碼。";  //郵件標題
$mail->Body = "您好，恭喜您! 您的密碼已經變更完成。"; //郵件內容，可以使用html格式

$mail->IsHTML(true); //郵件內容為html ( true || false)
$mail->AddAddress($check2); //收件者郵件及名稱，信要寄到哪個信箱










if(!$mail->Send()) 
{
 echo "發送錯誤: " . $mail->ErrorInfo;
}
else
{

 echo "<meta http-equiv='content-type' content='text/html; charset=UTF-8'  />"; 	
 echo "<script language=javascript>";
 echo "window.alert('您的密碼已經修改完成!')"; 
 echo "</script>";
 echo "<META HTTP-EQUIV='refresh' CONTENT='0;URL=login.php'>";


     
}






}










}






}




?>