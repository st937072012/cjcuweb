<?
session_start();
include_once("cjcuweb_lib.php");

// 防止駭客繞過登入
if(isset ($_SESSION['username']) && $_SESSION['level'] == $level_company){

	// 取得公司電話與地址
	include_once("sqlsrv_connect.php");
	$sql = "select address,phone from company where id=?";
	$params = array($_SESSION['username']);
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$result = sqlsrv_query($conn,$sql,$params,$options);
	$row = sqlsrv_fetch_array($result,SQLSRV_FETCH_NUMERIC);
	$company_address = $row[0];
	$company_phone = $row[1];
}
else{
//重定向瀏覽器 且 後續代碼不會被執行 
header("Location: home.php"); 
exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增工作</title>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<style type="text/css">span{color: #f00;}</style>
</head>
<body>
<h1>新增工作</h1><hr>

<form name="work" method="post" action="register_work.php" onsubmit="return check_data();">

工作名稱*：<input type="text" name="name" id="name"/><span id="name_hint"></span><br>

工作類型* : <select name="work_type" id="work_type"><option>請選擇</option></select> 
			<select name="work_type_list1" id="work_type_list1"><option>請選擇</option></select><!-- 要等 work_type 選完才載入 -->
			<select name="work_type_list2" id="work_type_list2"><option>請選擇</option></select><!-- 要等 work_type 選完才載入 -->
			<span id="work_type_hint"></span>
			<br>

開始日期* : <select name="year1" id="year1"></select>年
			<select name="month1" id="month1"></select>月
			<select name="date1" id="date1"></select>日&nbsp;
			<select name="hour1" id="hour1"></select>時 
			<select name="minute1" id="minute1"></select>分<br>

截止日期* : <select name="year2" id="year2"></select>年
			<select name="month2" id="month2"></select>月
			<select name="date2" id="date2"></select>日&nbsp;
			<select name="hour2" id="hour2"></select>時 
			<select name="minute2" id="minute2"></select>分<br>

工作性質* : <select name="work_prop" id="work_prop"></select> <br>

校內外工作*：<input type="radio" name="isoutside" value="0" checked="true">校外工作
			 <input type="radio" name="isoutside" value="1">校內工作<br>

工作地點* : <select name="zone" id="zone"></select> 
			<select name="zone_name" id="zone_name"></select>
			<span id="zone_name_hint"></span> <br>

招募人數*：<input type="number" name="recruitment_no" id="recruitment_no" value="1" /> <br>

聯絡地址*：<input type="text" name="address" id="address"/> 
		   <label><input type="checkbox" id="address_same" >同公司地址</label> 
		   <span id="address_hint"></span> <br> 
  <? echo '<input type="hidden" name="hidden_address" id="hidden_address" value="'.$company_address.'"/>';?>

連絡電話 : <input type="text" name="phone" id="phone"/> 
		   <label><input type="checkbox" id="phone_same" >同公司電話</label> <br>
  <? echo '<input type="hidden" name="hidden_phone" id="hidden_phone" value="'.$company_phone.'"/>';?>

薪資待遇：<input type="pay" name="pay"/> &nbsp; (可填 時薪,月薪 或 面議)<br>

工作內容：<br><textarea name="detail" cols="45" rows="5"></textarea> <br>

<input type="submit" name="button" value="確定" />
<input type="button"  value="取消" onclick="location.href='home.php'"/>
</form>



<script>
	// php load some help data for js array
	<?php include("js_add_work.php"); ?> 
	
	$(function(){

		// 生成年 
		for(var i=0;i<year_array.length;i++)
		$("#year1,#year2").append($("<option></option>").attr("value", year_array[i]).text(year_array[i]));
		//生成 月
		for(var i=1;i<=12;i++)
		$("#month1,#month2").append($("<option></option>").attr("value", i).text(i));
		// 生成 天
		for(var i=1;i<=31;i++)
		$("#date1,#date2").append($("<option></option>").attr("value", i).text(i));
		// 生成 時
		for(var i=0;i<=23;i++)
		$("#hour1,#hour2").append($("<option></option>").attr("value", i).text(i));
		// 生成 分
		for(var i=0;i<=59;i++)
		$("#minute1,#minute2").append($("<option></option>").attr("value", i).text(i));
		
		// 生成工作位置基本資料
		$("#zone").append($("<option></option>").attr("value", 0).text("國內"));
		$("#zone").append($("<option></option>").attr("value", 1).text("國外"));

		// 生成工作位置細目
		change_zone_list();
		
		// 生成工作類型
		for(var i=0;i<work_type.length;i++)
		$("#work_type").append($("<option></option>").attr("value", work_type_id[i]).text(work_type[i]));
		
		// 生成 工作性質
		for(var i=0;i<work_prop.length;i++)
		$("#work_prop").append($("<option></option>").attr("value", work_prop_id[i]).text(work_prop[i]));

		// 改變月份重新生成天數
		$("#month1").change(function() {
			//清空日期
			$("#date1 option").remove();
			var m = $(this).val;
			var d = (m==1 || m==3 || m==5 || m==7  || m==8  || m==10 || m==12)?31:30;
			for(var i=1;i<=d;i++) $("#date1").append($("<option>").attr("value", i).text(i));
		});
		$("#month2").change(function() {
			//清空日期
			$("#date2 option").remove();
			var m = $(this).val;
			var d = (m==1 || m==3 || m==5 || m==7  || m==8  || m==10 || m==12)?31:30;
			for(var i=1;i<=d;i++) $("#date2").append($("<option>").attr("value", i).text(i));
		});




		// 工作類型第一層 改變時，用ajax列出 第二層 工作類型細目
		$('#work_type').change(function() {
			var id = $(this).val();
			// 清空工作類別細目
			$("#work_type_list1 option").remove();
			// 執行AJAX取得細目資料
			$.ajax({
			type:"POST",
			async:false, 
			url:"ajax_work_type_list.php",
			data:"id="+id+"&list=1",
			success:function(msg){ $('#work_type_list1').html(msg);	},
			error: function(){alert("網路連線出現錯誤!");}
			});
		});

		// 工作類型第二層 改變時，用ajax列出 第三層 工作類型細目
		$('#work_type_list1').change(function() {
			var id = $(this).val();
			// 清空工作類別細目
			$("#work_type_list2 option").remove();
			// 執行AJAX取得細目資料
			$.ajax({
			type:"POST",
			async:false, 
			url:"ajax_work_type_list.php",
			data:"id="+id+"&list=2",
			success:function(msg){ $('#work_type_list2').html(msg);	},
			error: function(){alert("網路連線出現錯誤!");}
			});
		});




		// 工作地點改變時，用AJAX列出地點細目
		$('#zone').change(function() {
			// 清空地點細目
			change_zone_list();
		});
		// 勾選了"同公司地址",自動輸入
		$("#address_same").click( function(){
	   		if( $(this).is(':checked') ) $('#address').val($('#hidden_address').val());
	   		else $('#address').val('');
		});
		// 勾選了"同公司電話",自動輸入
		$("#phone_same").click( function(){
			if( $(this).is(':checked') ) $('#phone').val($('#hidden_phone').val());
	   		else $('#phone').val('');
		});


		function change_zone_list(){
			var zone = $('#zone').val();
			$("#zone_name option").remove();
			// 執行AJAX取得細目資料
			$.ajax({
			type:"POST",
			async:false, 
			url:"ajax_zone_list.php",
			data:"zone="+zone,
			success:function(msg){ $('#zone_name').html(msg);},
			error: function(){alert("網路連線出現錯誤!");}
			});
		}
	});

	  function check_data(){
			var boo = true;
			if($('#name').val()==""){
				boo = false;
				$('#name_hint').text("姓名不可為空");
			}
			else $('#name_hint').text("");
			if($('#work_type_list2').val()==null){
				boo = false;
				$('#work_type_hint').text("請選擇工作類型");
			}
			else $('#work_type_hint').text("");
			if($('#address').val()==""){
				boo = false;
				$('#address_hint').text("請填寫正確地址");
			}
			else $('#address_hint').text("");
			if($('#zone_name').val()=="請選擇"){
				boo = false;
				$('#zone_name_hint').text("請選擇工作地點");
			}
			else $('#zone_name_hint').text("");
			return boo;
		}

</script>
</body>


</html>