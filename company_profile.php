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
	<script><? include_once("js_company_detail.php"); 	echo_company_detail_array($_GET['companyid']); 	?></script>
	<script><? include_once('js_work_list.php'); echo_work_manage_list_array($_GET['companyid']);  ?></script>
	<script> 
	$(function(){

		$('#view-header').load('../public_view/header.php #header');
		$('.profile-pic-change, #profile-btn-edit').hide();

		// load into container company_detail_array
		$('title , #profile-name').text(company_detail_array['ch_name']);
		$('#ch_name').text(company_detail_array['ch_name']);
		$('#en_name').text(company_detail_array['en_name']);
		$('#boss').text(company_detail_array['name']);
		$('#unicode').text(company_detail_array['uni_num']);

		$('#budget').text(company_detail_array['budget']);
		$('#stuffnum').text(company_detail_array['staff_num']);
		$('#phone').text(company_detail_array['phone']);
		$('#email').text(company_detail_array['email']);
		$('#fax').text(company_detail_array['uni_num']);
		$('#address').text(company_detail_array['zonename']+" "+company_detail_array['address']);
		$('#cptype').text(company_detail_array['typename']);
		$('#cpurl').append($('<a>').attr('href',company_detail_array['url']).text(company_detail_array['url']));
		$('#introduction').text(company_detail_array['introduction']);

		var listbox = $('#profile-worklist');
		for(var i=0;i<work_list_array.length;i++){
			var container = $('<p>').addClass('profile-span-box'),
			tita = $('<a>').attr('href', '../work/'+work_list_array[i]['wid']).addClass('profile-span-left').text(work_list_array[i]['wname']),
			titloc = $('<span>').addClass('profile-span-right').text((work_list_array[i]['isout']=='0'?'校內 ':'校外 ')+ work_list_array[i]['propname']);
			listbox.append(container.append(tita).append(titloc));
		}

		<?
			if($_GET['companyid']==$_SESSION['userid']){
				echo "isCompany();";
			}
		?>

		function isCompany(){
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
	<img class="profile-cover-img" src="http://www.teamswork.tv/wp-content/uploads/2011/09/sub-page-1111.jpeg">
	<h1 class="profile-name" id="profile-name"></h1>
</div>

<div class="profile-pic">
	<img class="profile-pic-img" src="http://img.dxycdn.com/trademd/upload/pic/2011/12/02/1322737843.jpg">
	<div class="profile-pic-change">更換照片</div>
</div>

<div class="profile-content overfix">
	
<div class="profile-boxleft">
<h2>關於 <a id="profile-btn-edit" href="../company_manage.php">修改</a> </h2><br>
<h3>公司資訊</h3>
<p><span class="profile-span-title">中文名稱</span><span id="ch_name"></span></p>
<p><span class="profile-span-title">英文名稱</span><span id="en_name"></span></p>
<p><span class="profile-span-title">負責人</span><span id="boss"></span></p>
<p><span class="profile-span-title">統一編號</span><span id="unicode"></span></p>
<p><span class="profile-span-title">資本額</span><span id="budget"></span></p>
<p><span class="profile-span-title">員工數</span><span id="stuffnum"></span></p>
<br><hr><br>

<h3>聯絡方式</h3>
<p><span class="profile-span-title">電話</span><span id="phone"></span></p>
<p><span class="profile-span-title">傳真</span><span id="fax"></span></p>
<p><span class="profile-span-title">信箱</span><span id="email"></span></p>
<p><span class="profile-span-title">地址</span><span id="address"></span></p>
<br><hr><br>


<h3>公司類型</h3>

<p><span id="cptype"></span></p>

<br><hr><br>


<h3>相關連結</h3>

<p><span class="profile-span-title">公司網站</span><span id="cpurl"></span></p>


</div>

<div class="profile-boxright">

<div class="profile-boxinner"><h2>簡介</h2>
<span id="introduction"></span>
</div>

<div class="profile-boxinner" id="profile-worklist">
	<h2>公司職缺</h2>
</div>

</div>



</div>



</div>




</body>
</html>