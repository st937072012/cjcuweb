<? session_start(); ?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>帳戶管理</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/company_manage.css">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src="js/jquery.hashchange.min.js"></script>
	<script>
	$(function(){

		$('#view-header').load('public_view/header.php #header');

		$(window).hashchange( function(){

		  	var loc = location.hash.replace( /^#/, '' );
		  	switch(loc) {
			case 'student-info':doajax(0);break;
			case 'student-applywork':doajax(1);break;
			case 'student-note':doajax(2);break;
			case 'student-notice':doajax(3);break;
			default:doajax(0);
			}

		});

		$(window).hashchange();



		function doajax(idx){

				$('.list').removeClass('list-active');
				$('.list:eq('+idx+')').addClass('list-active');
				$('#right-box-title').text($('.list:eq('+idx+')').text());

				switch(idx) {
				// student info
				case 0:
				tpe = 'get';
				para = { userid: <? echo "\"".$_SESSION['username']."\"" ?> };
				url = "student_detail_edit.php";
				break;
				// 
				case 1:
				tpe = 'get';
				para = {};
				url = "student_work.php";
				break;
				// manage work
				case 2:
				tpe = 'get';
				para = {};
				url = "student_note.php";
				break;
				// notice
				case 3:
				tpe = 'post';
				para = {};
				url = "notice.php";	
				break;
			}
			$.ajax({
			  type: tpe,
			  url: url,
			  data: para,
			  success: function (data) { $('#contailer-box').html(data) ;  }
			});
		}


	});
	</script>
</head>


<body>
<div id="view-header"></div>


<div class="div-align overfix">

	<div id="" class="left-box" >
		<h2><? echo $_SESSION['username'] ?></h2><br><hr>
		<a href="#student-info"><div class="list">個人資訊</div></a><hr>
		<a href="#student-applywork"><div class="list">我的應徵</div></a><hr>
		<a href="#student-note"><div class="list">工作日誌(暫時)</div></a><hr>
		<a href="#student-notice"><div class="list">通知</div></a><hr>
	</div>


	<div id="" class="right-box">
		<h2 id="right-box-title"></h2>
		<br>
		<div id="contailer-box"></div>
	</div>

	
</div>

</body>
</html>