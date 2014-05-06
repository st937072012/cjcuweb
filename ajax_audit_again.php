<?

session_start(); 
session_write_close();

include('cjcuweb_lib.php');

if($_SESSION['level']!=$level_company){
	echo "0"; 
	exit; 
}

include("sqlsrv_connect.php");

$params = array($_SESSION['username']);
$sql = "update company set censored=3 where id=?";
$result = sqlsrv_query($conn, $sql, $params);

if(!$result){
	echo "0"; exit;
}

?>