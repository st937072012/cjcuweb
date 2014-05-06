<?
/* 工作列表轉成JS Array */
function echo_work_list_array(){

include("sqlsrv_connect.php");

$para = array();

$sql = "select w.id wid,w.name wname,z.name zname,w.is_outside isout,p.name propname,[recruitment _no] rno,w.date date
 from work w,zone z,work_prop p
 where w.zone_id = z.id and work_prop_id = p.id";

$stmt = sqlsrv_query($conn, $sql, $para);

$work_list_array = array();

if($stmt) {

	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) $work_list_array[] = $row;
	
	echo "var work_list_array = ". json_encode($work_list_array) . ";";	

}
else die(print_r( sqlsrv_errors(), true));

}




function echo_work_manage_list_array($companyid){

	include("sqlsrv_connect.php");
	$para = array($companyid);

	$sql = "select w.id wid,w.name wname,z.name zname,w.is_outside isout,p.name propname,[recruitment _no] rno,w.date date,t.name
	 from work w,zone z,work_prop p,work_type t
	 where w.zone_id = z.id and work_prop_id = p.id and w.company_id=? and w.work_type_id=t.id";

	$stmt = sqlsrv_query($conn, $sql, $para);
	$work_list_array = array();

	if($stmt) while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) $work_list_array[] = $row;
	else die(print_r( sqlsrv_errors(), true));


		
	for($i=0;$i<count($work_list_array);$i++){

		// 多少人應徵
		$sql = 'select COUNT(l.work_id)c from line_up l where work_id=?';
		$para = array($work_list_array[$i]['wid']);
		$stmt = sqlsrv_query($conn, $sql, $para);
		if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ;
		$work_list_array[$i]['apply_count']=  $row['c'];
		
		// 多少人錄取
		$sql = 'select COUNT(l.[check])c from line_up l where  work_id=? and [check]=1';
		$para = array($work_list_array[$i]['wid']);
		$stmt = sqlsrv_query($conn, $sql, $para);
		if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ;
		$work_list_array[$i]['check_count']=  $row['c'];

	}

		
	echo "var work_list_array = ". json_encode($work_list_array) . ";";	
}	



function echo_student_apply_list_array($userid){

		include("sqlsrv_connect.php");
		include("cjcuweb_lib.php");
		$para = array($userid);

		$sql = "select w.id wid,w.name wname,z.name zname,w.is_outside isout,p.name propname,[recruitment _no] rno,w.date date,t.name,l.[check] ch
				from work w,zone z,work_prop p,work_type t,line_up l
				where l.work_id = w.id  and w.zone_id = z.id and work_prop_id = p.id and w.work_type_id=t.id and l.user_id=?";
		
		$stmt = sqlsrv_query($conn, $sql, $para);
		$work_list_array = array();


		if($stmt) {
		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) $work_list_array[] = $row;
		echo "var work_list_array = ". json_encode($work_list_array) . ";";	
		}
		else die(print_r( sqlsrv_errors(), true));

}




?>