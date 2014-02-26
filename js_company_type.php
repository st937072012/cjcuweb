<?
include("mysql_connect.inc.php");
// output work type and id array
$company_type_array = array();
$company_type_array_id = array();
$sql = "select * from company_type";
$result = mysql_query($sql);
while( $row = mysql_fetch_array($result) ){
	$company_type_array_id[] = $row[0];
	$company_type_array[] = $row[1];
}
echo "var company_type_array_id = ". json_encode($company_type_array_id) . ";\n";
echo "var company_type_array = ". json_encode($company_type_array) . ";\n";

?>