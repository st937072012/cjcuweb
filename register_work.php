<? 
session_start(); 
include_once("cjcuweb_lib.php");
// 立刻驗證登入身分，防止駭客繞過登入
if(isset ($_SESSION['username']) && $_SESSION['level']==$level_company){
	$company_id = $_SESSION['username'];
}
else{ //重定向瀏覽器 且 後續代碼不會被執行 
header("Location: home.php");
exit;
}
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?

// 取得所有表單資料並防止注入
include("sqlsrv_connect.php");

$name =  sqlsrv_escape(trim($_POST['name']));
$work_type = (int)sqlsrv_escape(trim($_POST['work_type_list2']));
$year1 = sqlsrv_escape(trim($_POST['year1']));
$month1 = sqlsrv_escape(trim($_POST['month1']));
$date1 = sqlsrv_escape(trim($_POST['date1']));
$hour1 = sqlsrv_escape(trim($_POST['hour1']));
$minute1 = sqlsrv_escape(trim($_POST['minute1']));
$year2 = sqlsrv_escape(trim($_POST['year2']));
$month2 = sqlsrv_escape(trim($_POST['month2']));
$date2 = sqlsrv_escape(trim($_POST['date2']));
$hour2 = sqlsrv_escape(trim($_POST['hour2']));
$minute2 = sqlsrv_escape(trim($_POST['minute2']));
$work_prop = (int)sqlsrv_escape(trim($_POST['work_prop']));
$isoutside = (int)sqlsrv_escape(trim($_POST['isoutside']));
$zone_id = (int)sqlsrv_escape(trim($_POST['zone_name']));
$recruitment_no = (int)sqlsrv_escape(trim($_POST['recruitment_no']));
$address = sqlsrv_escape(trim($_POST['address']));
$phone = sqlsrv_escape(trim($_POST['phone']));
$pay = sqlsrv_escape(trim($_POST['pay']));
$detail = sqlsrv_escape(trim($_POST['detail']));

if( !isset($name) || !isset($work_type)  || !isset($year1) || !isset($month1) || !isset($date1) || !isset($hour1)  
	|| !isset($minute1) || !isset($work_prop) || !isset($zone_name) || !isset($address) || !isset($isoutside) || !isset($year2) 
	|| !isset($month2) || !isset($date2) || !isset($hour2)  || !isset($minute2) || !isset($recruitment_no) || $zone_id==0){
	echo "HAKER!!!!";
	echo '<meta http-equiv=REFRESH CONTENT=1;url=add_work.php>';
	exit;

}else{

	//datetime format  1970-01-01 00:00:00
	$start_date = $year1."-".$month1."-".$date1." ".$hour1.":".$minute1.":00";
	$end_date = $year2."-".$month2."-".$date2." ".$hour2.":".$minute2.":00";

	$params = array();
	$sql = "insert into work(name,company_id,work_type_id,start_date,end_date,work_prop_id,is_outside,zone_id,address,phone,pay,[recruitment _no],detail)"
			."values('$name','$company_id','$work_type','$start_date','$end_date','$work_prop','$isoutside','$zone_id','$address','$phone','$pay','$recruitment_no','$detail')";
	$result = sqlsrv_query($conn, $sql, $params);
	if($result){
		echo '新增成功! 跳轉中，請稍候...';
		echo '<meta http-equiv=REFRESH CONTENT=1;url=home.php>';
	}
	else{
		echo '新增失敗! 跳轉中，請稍候...';
		echo '<meta http-equiv=REFRESH CONTENT=1;url=add_work.php>';
	}
}
?>