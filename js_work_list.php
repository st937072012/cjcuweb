<?
/* 工作列表轉成JS Array */
function echo_work_list_array(){
include_once("sqlsrv_connect.php");
include_once("cjcuweb_lib.php");

$sql = "select w.id wid,w.name wname,z.name zname,w.is_outside isout,p.name propname,[recruitment _no] rno,w.date date
 from work w,zone z,work_prop p
 where w.zone_id = z.id and work_prop_id = p.id";

$stmt = sqlsrv_query($conn, $sql, array());

$work_list_array = array();

if($stmt) {

	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) $work_list_array[] = $row;
	
	echo "var work_list_array = ". json_encode($work_list_array) . ";";	

}
else die(print_r( sqlsrv_errors(), true));

}

?>