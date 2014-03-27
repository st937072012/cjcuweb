<?
/* 學生詳細資料轉成JS Array */
function echo_student_detail_array($user_id){
include_once("sqlsrv_connect.php");
include_once("cjcuweb_lib.php");

// 取出學生資料 (如果 column 一樣,一定要設定不同的column 否則傳回 php arry 會吃掉 column name 相同的資料，包含所有關連到的column name)
	$sql = "select r.user_no userno,r.user_name username,r.dep_name depname,s.pic pic,s.birthday birthday,s.nickname nickname,s.sex sex,s.phone phone,s.address address,s.email email,s.doc doc "
		  ."from cjcu_user r,cjcu_student s where r.user_no=? and s.user_no=?";
	
	$stmt = sqlsrv_query($conn, $sql, array($user_id,$user_id));
	if($stmt) $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC); 
	else die(print_r( sqlsrv_errors(), true));

    echo "var user_detail_array = ". json_encode($row) . ";\n";
}

?>