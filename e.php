<html> 
<head> 
<title>MS SQL Connection Test</title> 
</head> 
<body> 


<?
$server = 'cjcuweb.mssql.somee.com';
$userid = 'scandal0705_SQLLogin_1';
$password = 'b5ow614v9p';
// Connect to MSSQL
//$dbconn = mssql_connect($server, $userid, $password);
//select a database to work with
 
//$con = mssql_connect( $server, $userid, $password);  
 //echo $con;




   $serverName = 'localhost'; 

   $database = "iJK_BookStore";

 

   // Get UID and PWD from application-specific files. 

   $uid = 'demonzap_SQLLogin_1';

   $pwd = '9od7kcae62';


   try {

      $conn = new PDO( "sqlsrv:server=$serverName;Database = $database", null, null); 

      $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); 

   }

 

   catch( PDOException $e ) {

      die( "Error connecting to SQL Server".$e->getMessage() ); 

   }

 

   echo "Connected to SQL Server";

 

?>

</body> 
</html> 