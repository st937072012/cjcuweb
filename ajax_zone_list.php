<?

include("mysql_connect.inc.php");

// 防注入
$zone = mysql_real_escape_string(trim($_POST['zone']));

$result = mysql_query("select id,name from zone where zone = '$zone'");

while( $row = mysql_fetch_array($result) ){
	echo '<option value="'.$row[0].'">'.$row[1].'</option>';
}

?>