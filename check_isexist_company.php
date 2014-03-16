<?php
session_start(); 
include_once("sqlsrv_connect.php");



$sql = "select * from company where id=?";
// 查詢語句 ? 時，設定其值陣列，因為此 SQL 需要用到外來參數1個 $id
$params = array($_POST['id']);
$options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$result = sqlsrv_query($conn,$sql,$params,$options);

if($result){
	$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC);

	// 查無帳號
	if(count($row) ==0 ){ echo "0"; }
	else  echo "1";
}





?>
