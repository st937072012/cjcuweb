<?php session_start(); ?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>長榮大學 - 媒合系統</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/home.css">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script>
	<? include_once('js_work_list.php'); echo_work_list_array(); ?>
	$(function(){ 
		$('#view-header').load('public_view/header.php #header');
		$('#search-detail').hide();
		$('#btn_detail_search').on('click', function(event) {
			event.preventDefault();
			$('#search-detail').slideToggle('fast');
		});

		/* modle of work 
			<div class="work">
				<h1>wefewfwefwefwefewfwefwefwefwefewf</h1>
				<p>台南市</p>
				<p>校外 工讀</p>
				<p>需求 8人</p>
				<p class="date">2013/01/10</p>
			</div>
		*/

		// put work in work-list-container's index
		var list_container_index = 0;

		for(var i=0;i<work_list_array.length;i++){

			var a_link = $('<a>').attr({href:'work/'+work_list_array[i].wid}),
				div_work = $('<div>').addClass('work'),
				work_name = $('<h1>').text(work_list_array[i].wname),
				work_zone = $('<p>').text(work_list_array[i].zname),
				work_prop = $('<p>').text(((work_list_array[i].isout=='0')?'校內 ':'校外 ') + work_list_array[i].propname),
				work_recr = $('<p>').text('需求 '+ work_list_array[i].rno +' 人'),
				work_date = $('<p>').addClass('date').text(work_list_array[i].date.split(' ')[0]);
			

			div_work.append(work_name).append(work_zone).append(work_prop).append(work_recr).append(work_date);
			a_link.append(div_work);

			if(list_container_index==4)list_container_index=0;

			$('.list:eq('+list_container_index+')').append(a_link);
			list_container_index++;
		}

	});
	</script>
</head>
<body>
<div id="view-header"></div>



<div class="top">

	<div class="search-bar container">
		<div class="set-center">
			<input type="text">
			<input type="button" value="搜尋">
			<a href="#" id="btn_detail_search">進階搜尋</a>
		</div>
	</div>

	<div class="tag-bar container" id="search-detail">
		<div class="tag">台南市</div>
		<div class="tag">台南市</div>
		<div class="tag">台南市</div>
		<div class="tag">台南市</div>
		<div class="tag">台南市</div>
		<div class="tag">台南市</div>
		<div class="tag">台南市</div>
		<div class="tag">台南市</div>
		<div class="tag">台南市</div>
	</div>
</div>

<div class="center">

	<div class="title container">
		<div class="title-left">
		<h1>Work List</h1>
		</div>

		<div class="title-right">
		<!-- <span class="tag">台南市</span> -->
		</div>
	</div>

	<div class="work-list-bar container">
		<div class="list"></div>
		<div class="list"></div>
		<div class="list"></div>
		<div class="list"></div>
	</div>


</div>
	
</body>
</html>