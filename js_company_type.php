<?
include("sqlsrv_connect.php");

// output work type and id array
$company_type_array = array();
$company_type_array_id = array();

$sql = "SELECT * FROM company_type";
$stmt = sqlsrv_query( $conn, $sql );
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
	$company_type_array_id[] = $row[id];
	$company_type_array[] = $row[name];
}
echo "var company_type_array_id = ". json_encode($company_type_array_id) . ";\n";
echo "var company_type_array = ". json_encode($company_type_array) . ";\n";


// output zone name and id array
$company_zone_array = array();
$company_zone_array_id = array();

$sql = "SELECT * FROM zone";
$stmt = sqlsrv_query( $conn, $sql );
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
	$company_zone_array_id[] = $row[id];
	$company_zone_array[] = $row[name];
}
echo "var company_zone_array_id = ". json_encode($company_zone_array_id) . ";\n";
echo "var company_zone_array = ". json_encode($company_zone_array) . ";\n";

?>