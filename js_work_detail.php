<?
/* 工作詳細資料轉成JS Array */
$GLOBALS['cust_company'] ='';

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
$GLOBALS['cust_company'] = $row['company_id'];
}





/* 工作詳細資料轉成JS Array ，目的是要 assign 給前端,讓其能設定工作的目前資料,以提供修改 */
function echo_work_detail_edit_array($conn,$work_id){

include_once("cjcuweb_lib.php");

// id name date *company_id [work_type_id] start_date end_date [work_prop_id] is_outside 
// [zone_id] address phone pay recruitment _no detail check 

// GOD SQL query
$sql = "declare @h int;set @h = (select work_type_id from work where id=?);
		declare @i int;set @i = (select parent_no from work_type  where id=@h);
		declare @j int;set @j = (select parent_no from work_type  where id=@i);

		select w.id,w.name,[date],t1.id type1,t2.id type2,t3.id type3,
		w.start_date,w.end_date,w.work_prop_id,w.is_outside,w.zone_id,w.address,w.phone,w.pay,[recruitment _no] rno,w.detail,[check],z.zone zone
		from work w , work_type t1,work_type t2,work_type t3,zone z
		where w.id=? and t1.id=@j and t2.id=@i and t3.id=@h and z.id=w.zone_id";

$stmt = sqlsrv_query($conn, $sql, array((int)$work_id,(int)$work_id));
if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC); 
else die(print_r( sqlsrv_errors(), true));
echo "var work_detail_array = ". json_encode($row) . ";";
}



?>