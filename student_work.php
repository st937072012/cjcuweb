<? session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
if(isset($_SESSION['username'])) $userid = $_SESSION['username']; 
else{echo "您無權訪問該頁面!"; exit;} 
?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/work.css">
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script><? include_once('js_work_list.php'); echo_student_apply_list_array($userid);  ?>

    /* front-end 架構
<div class="work-list-box">

	<div class="sub-box"><img src="" class="work-img"></div>
	<div class="sub-box">
		<h1 class="work-tit"><a href="#">標題</a></h1>
		<p class="work-hint">類別<br>校外 工讀<br>時間0</p>
	</div>
	<div class="sub-box2">
		<p>未審查</p>
	</div>

</div>
    */
    $(function(){

 		 var body = $('#company-work-list-container');

		 for(var i=0;i<work_list_array.length;i++){
		   
		    	//work_list_array[i][apply_count]
		    	var check_status='';

		    	var img = $('<img>').attr('src', 'https://cdn2.iconfinder.com/data/icons/picol-vector/32/book_text-128.png').addClass('work-img'),
		    		
		    		tita = $('<a>').attr('href', 'work/'+work_list_array[i]['wid']).text(work_list_array[i]['wname']),
		    		tit = $('<h1>').addClass('work-tit').append(tita),
		    		hint = $('<p>').addClass('work-hint')
		    		.append(work_list_array[i]['name']+'<br>'+ (work_list_array[i]['isout']=='0'?'校內 ':'校外 ')+ work_list_array[i]['propname'] +'<br>'+ work_list_array[i]['date']),
		    		hint2 = $('<p>'),
		    		
		    		subbox1 = $('<div>').addClass('sub-box').append(img),
		    		subbox2 = $('<div>').addClass('sub-box').append(tit).append(hint),
		    		subbox3 = $('<div>').addClass('sub-box2').append(hint2),

		    		mainbox = $('<div>').addClass('work-list-box').append(subbox1).append(subbox2).append(subbox3);
		    		
		    		switch(work_list_array[i]['ch']) {
		    		case 0: check_status='未審核'; hint2.addClass('nonecheck').text(check_status); break;
		    		case 1: check_status='已錄取'; hint2.addClass('yescheck').text(check_status); break;
		    		case 2: check_status='不錄取'; hint2.addClass('nocheck').text(check_status); break;
		    		}

		    		body.append(mainbox);
		    }


		  $('#search-btn').click(function(event) { 
		  	resort_work($('#search-txt').val());	
		  });
		  
		  $('#search-txt').on('input', function(event) {
		  	console.log($('#search-txt').val());
		  	resort_work($('#search-txt').val());
		  });

		  function resort_work(txt){
		  		if(txt=='') $('.work-list-box').removeClass('hide-work');
		  		else{
		  			$('.work-list-box').each(function(index, el) {
		  			var tit_txt = $(this).find('.work-tit a').text().toLowerCase();
		  			var search_txt = txt.toLowerCase();
		  			if(tit_txt.match(search_txt)==null) $(this).addClass('hide-work');
		  			else $(this).removeClass('hide-work');
		  			});
		  		}
		  }


    });
</script>
</head>
<body>
<div id='search-box'>
<input type='text' placeholder='搜尋工作名稱' id='search-txt'>
<input type="button" value="搜尋" id='search-btn'>
</div>
<div id='company-work-list-container'></div>
</body>
</html>