<? 
session_start(); 
// 立刻驗證登入身分，防止駭客繞過登入
if(isset ($_SESSION['username']) && $_SESSION['level']==2){

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
include("mysql_connect.inc.php");
$name =  mysql_real_escape_string( trim($_POST['name']));
$work_type = mysql_real_escape_string( trim($_POST['work_type']));
$work_type_list = mysql_real_escape_string( trim($_POST['work_type_list']));
$year = mysql_real_escape_string( trim($_POST['year']));
$month = mysql_real_escape_string( trim($_POST['month']));
$date = mysql_real_escape_string( trim($_POST['date']));
$hour = mysql_real_escape_string( trim($_POST['hour']));
$minute = mysql_real_escape_string( trim($_POST['minute']));
$work_prop = mysql_real_escape_string( trim($_POST['work_prop']));
$zone_name = mysql_real_escape_string( trim($_POST['zone_name']));
$address = mysql_real_escape_string( trim($_POST['address']));
$phone = mysql_real_escape_string( trim($_POST['phone']));
$pay = mysql_real_escape_string( trim($_POST['pay']));
$detail = mysql_real_escape_string( trim($_POST['detail']));

if($name=="" || $work_type=="" || $work_type_list=="" || $year=="" || $month=="" || $date=="" || $hour==""  || $minute=="" || $work_prop=="" || $zone_name=="" || $address==""){
	
echo $name ."<br>";
echo $work_type ."<br>" ;
echo $work_type_list ."<br>";
echo $year ."<br>";
echo $month ."<br>";
echo $date ."<br>";
echo $hour ."<br>";
echo $minute ."<br>" ;
echo $work_prop ."<br>";
echo $zone_name."<br>" ;
echo $address ."<br>";
	

	echo 'You are hacker!';
    //echo '<meta http-equiv=REFRESH CONTENT=1;url=add_work.php>';
    exit;

}else{

	//datetime format  1970-01-01 00:00:00
	$end_date = $year."-".$month."-".$date." ".$hour.":".$minute.":"."00";
	//新增work
	$sql = "insert into work(name,company_id,work_type_id,work_type_list_id,end_date,work_prop_id,zone_id,address,phone,pay,detail)"
			."value('$name','$company_id','$work_type','$work_type_list','$end_date','$work_prop','$zone_name','$address','$phone','$pay','$detail')";
	$result = mysql_query($sql);

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