<?
/* 應徵者列表轉成JS Array */
function echo_company_work_apply_list_array($workid){

include("sqlsrv_connect.php");
include("cjcuweb_lib.php");

$para = array($workid);
$sql = "select l.user_id,s.doc,[check] from line_up l,cjcu_student s where l.work_id=? and l.user_id= s.user_no";
$stmt = sqlsrv_query($conn, $sql, $para);

$company_work_apply_list_array= array();

if($stmt) {
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) $company_work_apply_list_array[] = $row;
	echo "var company_work_apply_list_array = ". json_encode($company_work_apply_list_array) . ";";	
}
else die(print_r( sqlsrv_errors(), true));

}

?>