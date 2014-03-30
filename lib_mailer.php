	<?
	/* 寄送Email通知功能 */
    //$emailaddress_target --> 為收件人Email
    //$email_title         --> 為Email寄件標題
    //$email_body          --> 為Email[文章內容
    //$alert_something     --> 為Email寄發成功後要印出的訊息
	function send_email($emailaddress_target,$email_title,$email_body,$alert_something){

	include_once("lib/class.phpmailer.php"); //匯入PHPMailer類別
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
    $mail->IsHTML(true); //郵件內容為html ( true || false)
    $mail->AddAddress($emailaddress_target); //收件者郵件及名稱，信要寄到哪個信箱

    $mail->Subject =$email_title;  //郵件標題
    $mail->Body = $email_body; //郵件內容，可以使用html格式
    

    if(!$mail->Send()) 
    {
     echo "發送錯誤: " . $mail->ErrorInfo;
    }
    else
    {
    
    echo $alert_something;

    }





	}




  


	?>