<? session_start(); 
include_once("sqlsrv_connect.php");
include_once("cjcuweb_lib.php");


$sql = 'SELECT * FROM line_up';
$stmt = sqlsrv_query( $conn, $sql );

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
      echo "<div class='check_object'>";
      echo "$row[ch_name]";
}

sqlsrv_free_stmt($stmt);
//釋放記憶體資源



?>