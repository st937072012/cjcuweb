<?
/* 工作詳細資料轉成JS Array */
function echo_work_detail_array($work_id){
include_once("sqlsrv_connect.php");
include_once("cjcuweb_lib.php");

// id name date *company_id [work_type_id] start_date end_date [work_prop_id] is_outside 
// [zone_id] address phone pay recruitment _no detail check 

// GOD SQL query
$sql = "declare @h int;set @h = (select work_type_id from work where id=?);
		declare @i int;set @i = (select c.parent_no from work_type c where c.id=@h);
	  	declare @j int;set @j = (select b.parent_no from work_type b where b.id=@i);	  

	    select w.name,w.date,w.company_id,one.name typeone,two.name typetwo,three.name typethree,w.start_date,w.end_date,
	    prop.name popname,w.is_outside,z.name zonename,w.address,w.phone,w.pay,[recruitment _no],w.detail,[check]
	    from work w,work_type one,work_type two,work_type three,work_prop prop,zone z 
	    where w.id=? and w.work_prop_id=prop.id and w.zone_id=z.id  and one.id=@j and two.id=@i and three.id=@h";

$stmt = sqlsrv_query($conn, $sql, array((int)$work_id,(int)$work_id));
if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC); 
else die(print_r( sqlsrv_errors(), true));
echo "var work_detail_array = ". json_encode($row) . ";";
}

?>