<? session_start(); 
if(isset($_GET['companyid'])) $_SESSION['userid']=$_GET['companyid']; else{header("Location: home.php"); exit;}
?>

<!doctype html>
<html>
<head>
	<!-- 取得公司資訊 -->
	<script><? include_once("js_company_detail.php"); echo_company_detail_array($_SESSION['userid']); ?></script>

    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	
</head>

<body>
<script>
	$(function(){

		var html_detail = "",idx = 0;
		var column_name = ["中文名稱","英文名稱","連絡電話","傳真號碼","統一編號","負責人　","照片網址","電子信箱","公司類別","公司位置","公司地址","資本額　","關於公司","相關文件","員工數量","相關連結","審核狀況"];
		for(var key in company_detail_array){
	     	//特殊處理欄位
	     	if(idx == 16||idx == 8||idx == 9){

                //公司類型
			    if(idx == 8){
	     			html_detail+=column_name[idx]+"&emsp;&emsp;&emsp;<select name='"+key+"' id='company_type'></select> <br>";
	     		}

	     		//公司地點
			    if(idx == 9){
	     			html_detail+=column_name[idx]+"&emsp;&emsp;&emsp;<select name='"+key+"' id='company_zone'></select> <br>";
	     		}

	     		//審核的顯示處理
                if(idx == 16){
				    if(company_detail_array[key] == 0){
                    html_detail+="<br>"+column_name[idx]+"&emsp;&emsp;&emsp;未通過<br>";
			        }else 
			        if(company_detail_array[key] == 1){
                    html_detail+="<br>"+column_name[idx]+"&emsp;&emsp;&emsp;通過<br>";
			        }
			    }

	     	}
	     	//不能修改的欄位
			//else if(idx == 99){
			//html_detail+=column_name[idx]+"&emsp;&emsp;&emsp;"+company_detail_array[key]+"<br>";
	     	//}
            //普通欄位
	     	else{
            html_detail+=column_name[idx]+"&emsp;&emsp;&emsp;<input type='text' name ='"+key+"' value='"+company_detail_array[key]+"'><br>";
		    }
			idx++;
		}	
		    html_detail+="<br><input type='submit' value='submit'/>";
		$('#detail').html(html_detail);
	});

    //從後端得到公司類型
    <?php include("js_company_type.php"); ?> 
    for(var i=0;i<company_type_array.length;i++)
    $("#company_type").append($("<option></option>").attr("value", company_type_array_id[i]).text(company_type_array[i]));

    //從後端得到公司地點
    for(var i=0;i<company_zone_array.length;i++)
    $("#company_zone").append($("<option></option>").attr("value", company_zone_array_id[i]).text(company_zone_array[i]));


</script>


<form method="post" action="updata.php" id="detail"></form>
</body>
</html>
