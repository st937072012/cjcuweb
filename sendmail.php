<?php
set_time_limit(2000);//設定PHP執行時間
include("class.phpmailer.php"); //匯入PHPMailer類別

$mail= new PHPMailer(); //建立新物件
$mail->IsSMTP(); //設定使用SMTP方式寄信
$mail->SMTPAuth = true; //設定SMTP需要驗證
$mail->SMTPSecure = "ssl"; // Gmail的SMTP主機需要使用SSL連線
$mail->Host = "smtp.gmail.com"; //Gamil的SMTP主機
$mail->Port = 465;  //Gamil的SMTP主機的埠號(Gmail為465)。
$mail->CharSet = "utf-8"; //郵件編碼

$mail->Username = "st937072000@gmail.com"; //寄信Gamil帳號
$mail->Password = "wetai30254"; //寄信Gmail密碼

$mail->From = "st937072000@gmail.com"; //寄件者信箱，也可以與寄信的帳號一樣
$mail->FromName = "就是蛋"; //寄件者姓名

$mail->Subject ="就是蛋關心你";  //郵件標題
$mail->Body = "天氣很冷"."<br>注意保暖"; //郵件內容，可以使用html格式

$mail->IsHTML(true); //郵件內容為html ( true || false)
$mail->AddAddress("st937072000@yahoo.com.tw"); //收件者郵件及名稱，信要寄到哪個信箱

if(!$mail->Send()) 
{
     echo "發送錯誤: " . $mail->ErrorInfo;
}
else
{

     echo "<div align=center>寄送成功</div>";
}
?>