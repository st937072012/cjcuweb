<?
include("mysql_connect.inc.php");

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
$sql = "select * from work_type";
$result = mysql_query($sql);
while( $row = mysql_fetch_array($result) ){
	$work_type_id[] = $row[0];
	$work_type[] = $row[1];
}
echo "var work_type_id = ". json_encode($work_type_id) . ";\n";
echo "var work_type = ". json_encode($work_type) . ";\n";



// output work prop and id array
$work_prop = array();
$work_prop_id = array();
$sql = "select * from work_prop";
$result = mysql_query($sql);
while( $row = mysql_fetch_array($result) ){
	$work_prop_id[] = $row[0];
	$work_prop[] = $row[1];
}
echo "var work_prop_id = ". json_encode($work_prop_id) . ";\n";
echo "var work_prop = ". json_encode($work_prop) . ";\n";


// 



?>