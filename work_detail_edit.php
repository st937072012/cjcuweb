<? session_start();?>
<meta charset="UTF-8">
<?

include_once("sqlsrv_connect.php");
include_once("cjcuweb_lib.php");



if(isset($_GET['workid']) && $_SESSION['level']==$level_company) {
	$work_id=$_GET['workid']; 
	$user_id = $_SESSION['username'];
}
else{
	echo "您沒有權限訪問這個畫面!!";
	exit;
}

echo '<h1>工作內容<span id="work_edit">編輯</span></h1>';


//js_work_detail.php已經整合到此php 如果這邊穩定運作後js_work_detail.php可以刪除
$column_name = array("工作名稱","發布時間","所屬公司","工作分類1","工作分類2","工作分類3","應徵開始","應徵結束","工作性質","校內外工作","工作地點","詳細地址","連絡電話","薪資待遇","招募人數","詳細說明","通過審核");

// GOD SQL query
$sql = "declare @h int;set @h = (select work_type_id from work where id=?);
		declare @i int;set @i = (select c.parent_no from work_type c where c.id=@h);
	  	declare @j int;set @j = (select b.parent_no from work_type b where b.id=@i);	  

	    select w.name,w.date,w.company_id,one.name typeone,two.name typetwo,three.name typethree,w.start_date,w.end_date,
	    prop.name popname,w.is_outside,z.name zonename,w.address,w.phone,w.pay,[recruitment _no],w.detail,[check]
	    from work w,work_type one,work_type two,work_type three,work_prop prop,zone z 
	    where w.id=? and w.work_prop_id=prop.id and w.zone_id=z.id  and one.id=@j and two.id=@i and three.id=@h";

$stmt = sqlsrv_query($conn, $sql, array((int)$work_id,(int)$work_id));
$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) ;
     
for ($i = 0; $i < count($row); $i++) {

			echo '<h2>'.$column_name[$i].'</h2>';
            echo '<p>'.$row[$i].'</p>';
            echo '<hr>';
}


function isapplywork($user_id,$work_id){

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
		echo '<form name="getjobform" method="post" action="../../student_apply_job.php" id="apply_form">';
		echo '<br><br>';
		echo '<input type="hidden" name="work_id" value="'.$work_id.'" />';
		echo '<input type="submit" name="button" value="我要應徵" />';
		echo '</form>';
	}


?>
	
