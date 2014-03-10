<?
/* 公司詳細資料轉成JS Array */
function echo_company_detail_array($work_id){
include_once("sqlsrv_connect.php");
include_once("cjcuweb_lib.php");

// 取出公司資料 (如果 column 一樣,一定要設定不同的column 否則傳回 php arry 會吃掉 column name 相同的資料，包含所有關連到的column name)
$sql = "select c.ch_name,c.en_name,c.phone,c.fax,c.uni_num,c.name bossname,c.pic,c.email,t.name typename,z.name zonename,c.address,c.budget,c.introduction,c.doc,c.staff_num,c.censored,c.url "
	  ."from company c,zone z,company_type t "
	  ."where c.id= ? and c.type=t.id and c.zone_id=z.id";

	$stmt = sqlsrv_query($conn, $sql, array($work_id));
	if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC); 
	else die(print_r( sqlsrv_errors(), true));

echo "var company_detail_array = ". json_encode($row) . ";\n";
}

?>