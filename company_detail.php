<? session_start(); 
if(isset($_POST['company_id'])) $work_id=$_POST['company_id']; else{header("Location: home.php"); exit;} ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>公司資料</title>
	<!-- 取得公司資訊 -->
	<script><? include_once("js_company_detail.php"); echo_company_detail_array($work_id); ?></script>
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
</head>


<body>
<h1>公司資料</h1><hr>
<a href="home.php">回首頁</a>
<div id="detail"></div>
<script>
//ch_name,en_name,phone,fax,uni_num,name,pic,email,name,name,address,budget,introduction,doc,staff_num,censored,url
	$(function(){
		var html_detail = "",idx = 0;
		var column_name = ["中文名稱","英文名稱","連絡電話","傳真號碼","統一編號","負責人　","照片網址","電子信箱","公司類別","公司位置","公司地址","資本額　","關於公司","相關文件","員工數量","審核狀況","相關連結"];
		for(var key in company_detail_array){
			html_detail+=column_name[idx]+"&emsp;&emsp;&emsp;"+company_detail_array[key]+"<br>";
			idx++;
		}

		
		$('#detail').html(html_detail);
	});
</script>
</body>
</html>
