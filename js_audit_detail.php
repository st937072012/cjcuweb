<?
// 取出審核的所有細節

function echo_audit_detail_array($obj_id,$type){

	include("sqlsrv_connect.php");
	$audit_array = array();
	$para = array($type , $obj_id);
	$sql = "select staff_no,censored,msg,time from audit where type=? and obj_id=? order by time desc";
	$stmt = sqlsrv_query($conn, $sql, $para);
	if($stmt)  
		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
			$audit_array[] = $row;
	else  
		die(print_r( sqlsrv_errors(), true));

	echo "var audit_array = ". json_encode($audit_array).";";

}


?>