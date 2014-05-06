<?
/* 公司詳細資料轉成JS Array */
function echo_company_detail_array($work_id){
include("sqlsrv_connect.php");

// 取出公司資料 (如果 column 一樣,一定要設定不同的column 否則傳回 php arry 會吃掉 column name 相同的資料，包含所有關連到的column name)
    $sql = "select c.ch_name,c.en_name,c.phone,c.fax,c.uni_num,c.name,c.pic,c.email,t.name typename,z.name zonename,c.address,c.budget,c.introduction,c.doc,c.staff_num,c.url,c.censored "
	      ."from company c,zone z,company_type t "
	      ."where c.id= ? and c.type=t.id and c.zone_id=z.id";

	$stmt = sqlsrv_query($conn, $sql, array($work_id));
	if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC); 
	else die(print_r( sqlsrv_errors(), true));

    echo "var company_detail_array = ". json_encode($row) . ";";
}


/*
var company_detail_array = {
"ch_name":"\u9577\u69ae\u516c\u53f8",
"en_name":"cjcu",
"phone":"03111111",
"fax":"",
"uni_num":"0912345",
"name":"\u738b\u8463",
"pic":"",
"email":"123@gmail",
"typename":"\u8fb2\u3001\u6797\u3001\u6f01\u3001\u7267\u696d",
"zonename":"\u5f70\u5316\u7e23",
"address":"\u53f0\u5357\u5e02",
"budget":5000,
"introduction":"\u8cfa\u5927\u9322",
"doc":"",
"staff_num":200,
"url":"cjcu.com",
"censored":0
};*/

?>

