<? session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/company_manage.css">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script><? include_once("js_student_detail.php"); echo_student_detail_array($_GET['userid']); ?></script>
	<script> 
	$(function(){

		$('.profile-pic-change, #profile-btn-edit').hide();

		$('#view-header').load('../public_view/header.php #header');

		// init load data
		$('title').text(user_detail_array['username']);
		$('#userno').text(user_detail_array['userno']);
		$('#username, #profile-name').text(user_detail_array['username']+" ("+user_detail_array['nickname']+")");
		$('#birthday').text(user_detail_array['birthday']);
		$('#sex').text(  (user_detail_array['sex']=='0')?'男':'女'  );
		$('#phone').text(user_detail_array['phone']);
		$('#depname').text(user_detail_array['depname']);
		$('#email').text(user_detail_array['email']);
		$('#address').text(user_detail_array['address']);
		$('#doc').text(user_detail_array['doc']);



		<?
			if($_GET['userid']==$_SESSION['userid']){
				echo "isStud();";
			}
		?>

		function isStud(){
			$('#profile-btn-edit').show();
			$('.profile-pic').mouseenter(function(event) {
			$('.profile-pic-change').fadeIn(100);
			}).mouseleave(function(event) {
				$('.profile-pic-change').fadeOut(100);
			});
		}

	});
	</script>

</head>

<body>


<div id="view-header"></div>

<div class="div-align">


<div class="profile-cover">
	<img class="profile-cover-img" src="http://upload.wikimedia.org/wikipedia/commons/b/b6/Wfm_glasgow_school_of_art.jpg">
	<h1 class="profile-name" id="profile-name"></h1>
</div>

<div class="profile-pic">
	<img class="profile-pic-img" src="http://www.aspete.gr/site/Student.png">
	<div class="profile-pic-change">更換照片</div>
</div>



<div class="profile-content overfix">


<div class="profile-boxleft">
	<h2>關於 <a id="profile-btn-edit" href="../student_manage.php">修改</a> </h2><br>
	<h3>基本資訊</h3>
	<p><span class="profile-span-title">學號</span><span id="userno"></span></p>
	<p><span class="profile-span-title">姓名</span><span id="username"></span></p>
	<p><span class="profile-span-title">生日</span><span id="birthday"></span></p>
	<p><span class="profile-span-title">性別</span><span id="sex"></span></p>

	<br><hr><br>

	<h3>系所</h3>
	<span id="depname"></span><br>

	<br><hr><br>

	<h3>聯絡方式</h3>
	<p><span class="profile-span-title">電話</span><span id="phone"></span></p>
	<p><span class="profile-span-title">信箱</span><span id="email"></span></p>
	<p><span class="profile-span-title">地址</span><span id="address"></span></p>

</div>


<div class="profile-boxright">

<div class="profile-boxinner"><h2>履歷表</h2>
<p id="doc"></p>
</div>

</div>


</div>





</div>

</body>
</html>