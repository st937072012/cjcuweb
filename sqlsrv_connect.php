<?

   // connect sqlsrv 
   $serverName = 'localhost'; 
   $database = 'cjcuweb';
   $uid = 'zap';
   $pwd = '12345678';
   $conn;
   
   try {
      $conn = new PDO( "sqlsrv:server=$serverName;Database = $database", null, null); 
      $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); 
   }
   catch( PDOException $e ) {
      die( "Error connecting to SQL Server".$e->getMessage() ); 
   }

?>