<?session_start();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php");

$id = mysql_real_escape_string(trim($_POST['id']));
$pw = mysql_real_escape_string(trim($_POST['pw']));


$sql = "select * from company where id = '$id'";
$result = mysql_query($sql);
$row = @mysql_fetch_row($result);

if($id != null && $pw != null && $row[0] == $id && $row[1] == md5($pw))
{		

        $_SESSION['username'] = $id;
        $_SESSION['level'] = 2;
        echo '登入成功! 跳轉中，請稍後...';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=home.php>';
}
else
{
        echo '登入失敗! 跳轉中，請稍後...';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=company_login.php>';
}
?>