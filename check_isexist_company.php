<?php
session_start(); 
include("mysql_connect.inc.php");


$id = mysql_real_escape_string(trim($_POST['id']));
$sql = "select * from company where id = '$id'";
$result = mysql_query($sql);
$row = @mysql_fetch_row($result);

// 1 is exist or 0
if($id != null && $pw != null && $row[0] == $id )echo "1";
else echo "0";
?>
