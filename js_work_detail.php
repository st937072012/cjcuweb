<?
include("sqlsrv_connect.php");
// output work detail and its company
$company_array = array();
$work_array = array();

$sql = "SELECT * FROM company_type";
$stmt = sqlsrv_query( $conn, $sql );
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
	$company_type_array_id[] = $row[id];
	$company_type_array[] = $row[name];
}
echo "var company_array = ". json_encode($company_array) . ";\n";
echo "var work_array = ". json_encode($work_array) . ";\n";

?>