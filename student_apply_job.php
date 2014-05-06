<?session_start();

include_once("cjcuweb_lib.php");
// 確認身分為學生
if(isset($_SESSION['username']) && $_SESSION['level']==$level_student){

include_once("sqlsrv_connect.php");
include_once("cjcuweb_lib.php");

$user_id = $_SESSION['username'];
$work_id = $_POST['workid'];

$sql = "insert into line_up(user_id,work_id)values(?,?)";
$params = array($user_id,$work_id);
$options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$result = sqlsrv_query($conn,$sql,$params,$options);

if($result)success_return();
else error_return($work_id);
}

// 無權訪問本頁面
else{header("Location: home.php"); exit;}

function error_return($work_id){
	
	echo '<meta charset="utf-8" http-equiv="refresh" content="2; url= work/'.$work_id.'" />';
	echo '應徵失敗...跳轉中...';
   //header("Location: work/$work_id");
}
function success_return(){

	echo '<meta charset="utf-8" http-equiv="refresh" content="2; url=student_manage.php#student-applywork" />';
	echo '應徵成功...跳轉中...';
   //header("Location: student_manage.php#student-applywork");
}
?>