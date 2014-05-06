<? session_start(); 
// 身分驗證

?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/work_detail_edit.css?v=3">
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

	<script>

	$(function(){

		
		$.ajax({
		  type: 'get',
		  url: 'add_work.php',
		  data: {mode:'edit',workid:  <?  echo (int)$_POST['workid']; ?> },
		  success: function (data) { $('#workedit-content-edit').html(data) ;  }
		});

		$.ajax({
		  type: 'get',
		  url: 'company_work_apply_list.php',
		  data: {workid:  <?  echo (int)$_POST['workid']; ?> },
		  success: function (data) { $('#workedit-content-apply').html(data) ;  }
		});



		var tabgroup = $('div[tabtoggle="workedit1"]');
		tabgroup.click(function(event) {
			tabgroup.removeClass('tab-active');
			$(this).addClass('tab-active');
			var index = tabgroup.index( this );
			$('div[tabtoggle="workedit2"]').removeClass('workedit-content-hide');
			$('div[tabtoggle="workedit2"]:not(div[tabtoggle="workedit2"]:eq('+index+'))').addClass('workedit-content-hide');
		});

		tabgroup[<?  echo (int)$_POST['page']; ?>].click();

	});


	</script>

</head>
<body>
	
<div class="workedit-tabbox">
	<div class="sub-tab tab-active" tabtoggle='workedit1'><i class="icon-pencil tab-img"></i>編輯</div>
	<div class="sub-tab" tabtoggle='workedit1'><i class="icon-check tab-img"></i>審核</div>
	<div class="sub-tab" tabtoggle='workedit1'><i class="icon-cog tab-img"></i>設定</div>
</div>


<div class="workedit-content" id='workedit-content'>
	
<div id='workedit-content-edit' class="" tabtoggle='workedit2'></div>

<div id='workedit-content-apply' class="workedit-content-hide" tabtoggle='workedit2'>
	

</div>

<div id='workedit-content-set' class="workedit-content-hide" tabtoggle='workedit2'>	

<h2>複製工作</h2>

<h2>刪除工作</h2>

</div>

</div>

</body>
</html>