<?

function echo_staff_detail_array($user_id){

include_once("sqlsrv_connect.php");


$sql = "select u.user_no,u.user_name,u.dep_no,u.dep_name,u.role,t.pic,t.phone,t.email,t.pic
		from cjcu_user u, cjcu_staff t
		where u.user_no =? and t.user_no=u.user_no";
	
	$stmt = sqlsrv_query($conn, $sql, array($user_id));
	if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC); 
	else die(print_r( sqlsrv_errors(), true));

    echo "var staff_detail_array = ". json_encode($row) . ";\n";
}

?>