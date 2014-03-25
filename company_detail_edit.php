<? session_start(); 
if(isset($_GET['companyid'])) $company_id=$_GET['companyid']; else{header("Location: home.php"); exit;}
 ?>

<!doctype html>
<html>
<head>
	<!-- 取得公司資訊 -->
	<script>
	<? include_once("js_company_detail.php"); echo_company_detail_array($company_id); ?>
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
</head>
<body>
<div id="detail"></div>
</body>
</html>
