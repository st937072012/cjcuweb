<?php
include_once 'sqlsrv_connect.php';
session_start();


$check1 = $_GET['key'];
$check2 = $_GET['emailkey'];

$sql = "select log,email from company where log like '$check1' and email like '$check2'";








if ($check1 ==null || $check2 ==null) {
 echo "<meta http-equiv='content-type' content='text/html; charset=UTF-8'  />"; 	
 echo "<script language=javascript>";
 echo "window.alert('很抱歉，驗證碼有空。')"; 
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

echo "<META HTTP-EQUIV='refresh' CONTENT='0;URL=company_emailpwd_reset.php'>";


$_SESSION['pass_key1']=$check1;
$_SESSION['pass_key2']=$check2;



}






}






















?>