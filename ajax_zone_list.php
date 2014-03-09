<?

include("sqlsrv_connect.php");
$params = array(trim($_POST['zone']));
$options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$sql = "select id,name from zone where zone =?";
$result = sqlsrv_query($conn, $sql, $params , $options );
	while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC) ){
		echo '<option value="'.$row[0].'">'.$row[1].'</option>';
	}
?>