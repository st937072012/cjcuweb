
<?
function get_all_notify($user,$level){

	include("sqlsrv_connect.php");

	// except company level = 4 , the rest are < 4
	// if it is company, level is 1 ,else 0
	$level= ($level==4)? 1 : 0;
 	$para = array($user , $level);

	
	$sql = "UPDATE cjcu_notify SET isnews=0 ,time=GETDATE() WHERE user_no=? and user_level=?";
	$stmt = sqlsrv_query($conn, $sql, $para);

	if($stmt) {
		$sql ="select * from msg where recv=? and recv_level=?";
		$stmt = sqlsrv_query($conn, $sql, $para);
		$msglist_array = array();

		if($stmt)  while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) $msglist_array[] = $row;
		else  die(print_r( sqlsrv_errors(), true));

	    echo "var msglist_array = ". json_encode($msglist_array).";";
	}
	else  die(print_r( sqlsrv_errors(), true));

}
?>