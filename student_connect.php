<? session_start(); ?>
<!--上方語法為啟用session，此語法要放在網頁最前方-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
//連接資料庫
//只要此頁面上有用到連接MySQL就要include它
include_once("mysql_connect.inc.php");
include_once("cjcuweb_lib.php");

$user = sqlsrv_escape(trim($_POST['id']));
$pwd = sqlsrv_escape(trim($_POST['pw']));

// 驗證身分是否正確
if(verification($user,$pwd)){

 		//將帳號寫入session，方便驗證使用者身份
        $_SESSION['username'] = $user;
        $_SESSION['level'] = $level_student;
        echo '登入成功!';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=home.php>';

}
else{
		echo '登入失敗!';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=student_login.php>';
}

?>