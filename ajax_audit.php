<?
session_start(); 
session_write_close();

// 審核頁面  身分驗證
include('cjcuweb_lib.php');

if($_SESSION['level']!=$level_staff){
	echo "0-1"; 
	exit; 
}

//data: {censored:c, obj_id:obj_id, type:t, msg:m},
include("sqlsrv_connect.php");

$staff_no = $_SESSION['username'];
$censored = trim($_POST['censored']);
$obj_id = trim($_POST['obj_id']);
$type = trim($_POST['type']) ;
$msg = trim($_POST['msg']) ;


// insert a new record 
$params = array($staff_no,$type,$obj_id,$censored,$msg);
$sql = "insert into audit(staff_no,type,obj_id,censored,msg)"
		." values(?,?,?,?,?)";
$result = sqlsrv_query($conn, $sql, $params);

if(!$result){
	echo '0-2';
	exit;
}
else{
	// update new censored value to db


	// use type to judge table
	switch ($type) {
		case '0':
			$table = 'company';
			$cname = 'censored';
			break;
		case '1':
			$table = 'work';
			$cname = '[check]';
			break;
		default:
			echo '0-3'; exit;
	}

	$params2 = array($censored,$obj_id);
	$sql2 = "update ".$table." set ".$cname."=? where id=?";
	$result2 = sqlsrv_query($conn, $sql2, $params2);

	if(!$result2){
		echo '0-4';
		exit;
	}

}


?>