<? session_start(); 
include('cjcuweb_lib.php');
if(!isset($_SESSION['username']) || $_SESSION['level'] != $level_student) {
 	echo "<br>No permission";
 	exit; 
}

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<script><? include_once("js_student_detail.php"); echo_student_detail_array($_SESSION['username']); ?></script>
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	
</head>


<body>
<script>

	$(function(){
		// call header

		var html_detail = "",idx = 0;
		var column_name = ["學號　　","姓名　　","系所　　","大頭貼照","生日　　","綽號　　","性別　　","連絡電話","詳細地址","電子信箱","履歷檔案"];
		var input_name = ["user_no" , "user_name" , "dep_name" , "pic" , "birthday" , "nickname" , "sex" , "phone" , "address" , "email" , "doc"];
		for(var key in user_detail_array){
			//不能修改的欄位
			if(idx == 0){
            html_detail+=column_name[idx]+"&emsp;&emsp;&emsp;"+user_detail_array[key]+"<br>";
			}
			else{
			html_detail+=column_name[idx]+"&emsp;&emsp;&emsp;<input type='text' name ='"+input_name[idx]+"' value='"+user_detail_array[key]+"'><br>";
			}
			idx++;
		}	
		    html_detail+="<br><input type='submit' value='submit'/>";
		$('#detail').html(html_detail);

	});
</script>

<form method="post" action="updata.php" id="detail"></form>

</body>
</html>
