<?session_start();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

include_once("sqlsrv_connect.php");
include_once("cjcuweb_lib.php");

$id = sqlsrv_escape(trim($_POST['id']));
$pw = sqlsrv_escape(trim($_POST['pw']));

$sql = "select * from company where id=?";
// 查詢語句 ? 時，設定其值陣列，因為此 SQL 需要用到外來參數1個 $id
$params = array($id);
$options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$result = sqlsrv_query($conn,$sql,$params,$options);


if($result){

	$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC);

	// 查無帳號
	if(count($row) ==0 ){ error_return(); exit; }

	// 密碼不符或沒有輸入
	if($id != null && $pw != null && $row[0] == $id && $row[1] == md5($pw)){

        $_SESSION['username'] = $id;
        $_SESSION['level'] = 4;
       	success_return();
	}
	else error_return(); 
	
}
else die(print_r( sqlsrv_errors(), true));


function error_return(){

	echo '登入失敗! 跳轉中，請稍後...';
    echo '<meta http-equiv=REFRESH CONTENT=1;url=company_login.php>';
}

function success_return(){
	echo '登入成功! 跳轉中，請稍後...';
    echo '<meta http-equiv=REFRESH CONTENT=1;url=home.php>';
}

?>