<html> 
<head> 
<title>MS SQL Connection Test</title> 
</head> 
<body> 


<?php
$server = 'localhost';
$database = 'iJK_BookStore';
$userid = 'sol';
$password = 'demonzap123123';
// Connect to MSSQL
//$dbconn = mssql_connect($server, $userid, $password);
//select a database to work with
 
$con = mssql_connect( $server, $userid, $password);  
 echo $con;

?>

</body> 
</html> 