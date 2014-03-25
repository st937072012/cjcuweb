<?

   // 基本連線資料
<<<<<<< HEAD
   $serverName = "localhost"; 
   $database   = 'cjcuweb';
   $uid = 'ap';
   $pwd = '1234';
=======
   $serverName = 'localhost'; 
   $database   = 'cjcuweb';

   $uid = null;
   $pwd = null;

   $uid = "sol";
   $pwd = "12345678";

>>>>>>> dce847b63b28ef3aa0e8e75cd79c16cc2548307d
   
   // ReturnDatesAsStrings 設定為true，使DateTime返回字串型態資料
   // CharacterSet 設定為 utf-8，使回傳中文資料時，不會出現亂碼
   $connectionInfo = array( "Database"=>$database , "UID"=> $uid , "PWD"=> $pwd ,'ReturnDatesAsStrings'=>true ,"CharacterSet" =>"UTF-8");
   
   $conn = sqlsrv_connect( $serverName, $connectionInfo);
   if( $conn === false) {
       die( print_r( sqlsrv_errors(), true));
   }

?>