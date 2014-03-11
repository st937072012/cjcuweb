<? session_start(); 
include_once("cjcuweb_lib.php");

if(isset($_GET['workid'])) $work_id=$_GET['workid']; else{header("Location: home.php"); exit;}
if(isset($_SESSION['username'])) $user_id = $_SESSION['username'];
 ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>工作資料</title>
	<!-- 取得公司資訊 -->
	<script><? include_once("js_work_detail.php"); echo_work_detail_array($work_id); ?></script>
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
</head>


<body>
<h1>工作資料</h1><hr>
<a href="../../home.php">回首頁</a>
<div id="detail"></div>

<?
	
	function isapplywork($user_id,$work_id){
		include("sqlsrv_connect.php");
		$sql="select count(user_id) from line_up where user_id=? and work_id=?";
        $params = array($user_id,$work_id);
        $result = sqlsrv_query($conn, $sql, $params);
        if($result){
        	$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC);
        
        	if($row[0]==0) return true;
        	return false;
        }
        else return false;
	}

	// 如果身分為學生，印出給予應徵的按鈕
	if(isset($_SESSION['username']) && $_SESSION['level']==$level_student && isapplywork($user_id,$work_id)){
		echo '<br><br>';
		echo '<form name="getjobform" method="post" action="../../student_apply_job.php">';
		echo '<input type="hidden" name="work_id" value="'.$work_id.'" />';
		echo '<input type="submit" name="button" value="我要應徵" />';
		echo '</form>';
	}



?>

<script>

	$(function(){
		//w.name,w.date,w.company_id,one.name typeone,two.name typetwo,three.name typethree,w.start_date,w.end_date,
	    //prop.name popname,w.is_outside,z.name zonename,w.address,w.phone,w.pay,[recruitment _no],w.detail,[check]
		var html_detail = "",idx=0;
		var column_name = ["工作名稱","發布時間","所屬公司","工作分類1","工作分類2","工作分類3","應徵開始","應徵結束"
						,"工作性質","校內外工作","工作地點","詳細地址","連絡電話","薪資待遇","招募人數","詳細說明","通過審核"];
		for(var key in work_detail_array){
			html_detail+=column_name[idx]+"&emsp;&emsp;&emsp;"+work_detail_array[key]+"<br>";
			idx++;
		}	
		$('#detail').html(html_detail);
	});
</script>
</body>
</html>
