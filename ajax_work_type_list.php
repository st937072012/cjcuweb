<?
include("mysql_connect.inc.php");

// 防注入
$id = mysql_real_escape_string(trim($_POST['id']));

$result = mysql_query("select id,name from work_type_list where type_id = '$id'");

while( $row = mysql_fetch_array($result) ){
	echo '<option value="'.$row[0].'">'.$row[1].'</option>';
}

?>