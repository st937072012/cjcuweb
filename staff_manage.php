<? session_start();

include('cjcuweb_lib.php');
if(!isset( $_SESSION['username'])  ) {
	if(!($_SESSION['level']==$level_teacher || $_SESSION['level']==$level_staff))
 	echo "No permission"; exit; 
 }

 ?>
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
			case 'staff-info':doajax(0);break;
			case 'staff-audit0':doajax(1.0);break;
			case 'staff-audit1':doajax(1.1);break;

			case 'staff-maintain':doajax(2);break;
			case 'staff-notice':doajax(3);break;

			default:doajax(0);
			}

		});

		$(window).hashchange();


		function doajax(idx){

				var pg = 0;

				if(idx==1.0){
					pg=0;
					idx=1;
				}
				else if(idx==1.1){
					pg=1;
					idx=1;
				}

				$('.list').removeClass('list-active');
				$('.list:eq('+idx+')').addClass('list-active');
				$('#right-box-title').text($('.list:eq('+idx+')').text());

				switch(idx) {
				// student info
				case 0:
				tpe = 'get';
				para = { userid: <? echo "\"".$_SESSION['username']."\"" ?> };
				url = "staff_detail_edit.php";
				break;
				// audit
				case 1:
				tpe = 'get';
				para = {page:pg};
				url = "staff_audit.php";
				break;
	
				// maintain
				case 2:
				tpe = 'get';
				para = {};
				url = "staff_maintain.php";
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

	<div class="left-box" >
		<h2><? echo $_SESSION['username'] ?></h2><br><hr>
		<a href="#staff-info"><div class="list">個人資訊</div></a><hr>
		<a href="#staff-audit0"><div class="list">審核</div></a><hr>
		<a href="#staff-maintain"><div class="list">維護</div></a><hr>
		<a href="#staff-notice"><div class="list">通知</div></a><hr>
	</div>


	<div id="" class="right-box">
		<h2 id="right-box-title"></h2>
		<br>
		<div id="contailer-box"></div>
	</div>

	
</div>

</body>
</html>