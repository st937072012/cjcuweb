<? session_start(); 
if(!isset($_SESSION['username'])) {
	session_write_close();  
	echo "0";	
	exit();
}
$lev = $_SESSION['level'];
$user = $_SESSION['username'];
session_write_close();
?>

<?
// is not sign in 
include("sqlsrv_connect.php");

$level = ($lev==4)? 1 : 0;

for( $i=0; $i<3 ; $i++ ){


	// if it are new msgs , return it
	if( is_new($conn,$user,$level)=='1' ){

		$s = getnew($conn,$user,$level);

		echo $s;

	    exit();

	}
	
	// if it isn't new msgs , wait 3 sec and contiune
	sleep(3);

}






// check the msgs are new now
function is_new($conn,$user,$level){
	
	// if new == 1 return true else false
	$sql = "select isnews from cjcu_notify where user_no=? and user_level=?";
	$para = array($user , $level);
	$stmt = sqlsrv_query($conn, $sql, $para);

	if($stmt) {
		$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
		//echo "is_new=". $row['isnews'];
		return $row['isnews'];
	}
	else 
		die(print_r( sqlsrv_errors(), true));


}

// get part of new msgs 
function getnew($conn,$user,$level){

	// get the new msg.time > modify.time  of msgs
	$sql = "select * from msg where time > 
	(select time from cjcu_notify where user_no=? and user_level=?) 
	and recv=? and recv_level=?";

	$para = array($user , $level, $user , $level);
	$stmt = sqlsrv_query($conn, $sql, $para);

	$msglist_array = array();

	if($stmt) { 

		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
			$msglist_array[] = $row;

		$reval = json_encode($msglist_array);
		
		//echo 'get_news_array = ';
		//print_r($reval);

		// change new=0 and notify.time = getDate() ,becouse we'll get new msgs now
		$sql = "UPDATE cjcu_notify 
		SET isnews = 0 ,time=GETDATE() 
		WHERE user_no=? and user_level=?";

		$para = array($user , $level);
		$stmt = sqlsrv_query($conn, $sql, $para);

		if($stmt) {
			return $reval;
		}
		else  return "";
		

	}
	else return "";
	
		

	sqlsrv_close( $conn );
	// if fail return null data
	
}

// if 3*10 sec isn't new msgs , disconnect it
// and client site will send a new request
//echo "end";
?>