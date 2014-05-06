<? session_start(); 
// 審核頁面  身分驗證
include_once('cjcuweb_lib.php');
if($_SESSION['level']!=$level_staff){
	echo "No permission"; exit; 
}

?>

<!doctype html>
<html>
<head>
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/work_detail_edit.css?v=0">
	<script></script>
	<script>

	$(function(){

		// TAB Control 
		var tabgroup = $('div[tabtoggle="workedit1"]');
		tabgroup.click(function(event) {
			tabgroup.removeClass('tab-active');
			$(this).addClass('tab-active');
			var index = tabgroup.index( this );
			$('div[tabtoggle="workedit2"]').removeClass('workedit-content-hide');
			$('div[tabtoggle="workedit2"]:not(div[tabtoggle="workedit2"]:eq('+index+'))').addClass('workedit-content-hide');
		});
		tabgroup[<?  echo (int)$_GET['page']; ?>].click();

	});

	

	</script>

</head>
<body>



<div class="staff-audit-filterbox">
<select id="type-filter">
	<option value="0" selected="selected">顯示全部</option>
	<option value="1">僅顯示公司</option>
	<option value="2">僅顯示工作</option>
</select>
<input type="text" id="name-filter" placeholder="過濾名稱">
</div>

<div class="workedit-tabbox">
	<div class="sub-tab tab-active" tabtoggle='workedit1'><i class="fa fa-user tab-img"></i> 會員</div>
	<div class="sub-tab" tabtoggle='workedit1'><i class="fa fa-building-o tab-img"></i> 公司</div>
	<div class="sub-tab" tabtoggle='workedit1'><i class="fa fa-book tab-img"></i> 工作</div>
</div>


<div class="workedit-content" id='workedit-content'>

	<div id='staff-audit-notyet' class="" tabtoggle='workedit2'><br><br>維護學生資料<br>包含教職員 學生<br></div>
	<div id='staff-audit-again' class="workedit-content-hide" tabtoggle='workedit2'><br><br>維護公司資料<br>包含詳細審核紀錄<br></div>
	<div id='staff-audit-again' class="workedit-content-hide" tabtoggle='workedit2'><br><br>維護工作資料<br>包含詳細審核紀錄<br></div>
</div>

</body>
</html>