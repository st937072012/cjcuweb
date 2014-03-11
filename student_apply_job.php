<?session_start();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include_once("cjcuweb_lib.php");
// 確認身分為學生
if(isset($_SESSION['username']) && $_SESSION['level']==$level_student){

include_once("sqlsrv_connect.php");
include_once("cjcuweb_lib.php");
$user_id = $_SESSION['username'];
$work_id = $_POST['work_id'];
$sql = "insert into line_up(user_id,work_id)values(?,?)";
$params = array($user_id,$work_id);
$options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$result = sqlsrv_query($conn,$sql,$params,$options);

if($result)success_return();
else error_return();
}
// 無權訪問本頁面
else{header("Location: home.php"); exit;}

function error_return(){
	echo '應徵失敗! 跳轉中，請稍後...';
    echo '<meta http-equiv=REFRESH CONTENT=1;url= work/'.$work_id.'/>';
}
function success_return(){
	echo '應徵成功! 跳轉中，請稍後...';
    echo '<meta http-equiv=REFRESH CONTENT=1;url=student_work.php>';
}
?>