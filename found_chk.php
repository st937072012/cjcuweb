<?php
	include_once 'sqlsrv_connect.php';
	include("class.phpmailer.php"); //匯入PHPMailer類別

	$email = $_POST['foundemail'];
    $sql = "select email from company where email like '$email'";
    
   

if ($email==null) {
	
 echo "<meta http-equiv='content-type' content='text/html; charset=UTF-8'  />";  
 echo "<script language=javascript>";
 echo "window.alert('很抱歉，Email不可為空!')"; 
 echo "</script>";
 echo "<META HTTP-EQUIV='refresh' CONTENT='0;URL=found.php'>";


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
 echo "<META HTTP-EQUIV='refresh' CONTENT='0;URL=found.php'>";
  
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


       
set_time_limit(1000);//設定PHP執行時間

$mail_link="http://localhost/cjcuweb/password_check.php?key=".$allkey."&emailkey=".$email;
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
$mail->Body = "<a  href=\"$mail_link \"target=\"_top\">您曾送出了修改密碼的請求，請點我修改密碼。</a>"; //郵件內容，可以使用html格式

$mail->IsHTML(true); //郵件內容為html ( true || false)
$mail->AddAddress($info['email']); //收件者郵件及名稱，信要寄到哪個信箱










if(!$mail->Send()) 
{
     echo "發送錯誤: " . $mail->ErrorInfo;
}
else
{
 echo "<meta http-equiv='content-type' content='text/html; charset=UTF-8'  />";  
 echo "<script language=javascript>";
 echo "window.alert('寄送成功! 您的密碼重新設定認證信已經寄到".$info['email']."請到您的信箱進行密碼重新設定!')"; 
 echo "</script>";
 echo "<META HTTP-EQUIV='refresh' CONTENT='0;URL=login.php'>";

}
	
}





}

	















?>
