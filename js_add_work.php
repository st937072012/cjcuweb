<?
include("sqlsrv_connect.php");


$options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET);


// out put server date of year array 
$year_array = array();
$year = (int)date("Y"); 
$year_array[] = $year;
$year_array[] = $year++;
$year_array[] = $year++;
echo "var year_array = ". json_encode($year_array) . ";\n";



// output work type and id array
$work_type = array();
$work_type_id = array();
$params = array(0);
$sql = "select * from work_type where parent_no=?";
$result = sqlsrv_query($conn, $sql, $params , $options );
while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC) ){
	$work_type_id[] = $row[0];
	$work_type[] = $row[1];
}
echo "var work_type_id = ". json_encode($work_type_id) . ";\n";
echo "var work_type = ". json_encode($work_type) . ";\n";



// output work prop and id array
$work_prop = array();
$work_prop_id = array();
$params = array();
$sql = "select * from work_prop";
$result = sqlsrv_query($conn, $sql, $params , $options );
while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC) ){
	$work_prop_id[] = $row[0];
	$work_prop[] = $row[1];
}
echo "var work_prop_id = ". json_encode($work_prop_id) . ";\n";
echo "var work_prop = ". json_encode($work_prop) . ";\n";



?>