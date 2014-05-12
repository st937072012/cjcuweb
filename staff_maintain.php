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
	<script>
	<? include_once("js_get_all_audit.php");  
	get_all_audit(1); 
	get_all_audit(2);
	get_all_staff(2);
	get_all_staff(3);
	?>
	</script>
	<script>

	$(function(){

        var fa;


	    var record1 = $('#company-maintain-record1');
		for(var i=0;i<company_list_array1.length;i++){
				record1.append( append_data(0,1,company_list_array1[i],i,1) );
		}

		for(var i=0;i<company_list_array2.length;i++){
				record1.append( append_data(0,2,company_list_array2[i],i,2) );
		}

		var record2 = $('#work-maintain-record2');
		for(var i=0;i<work_list_array1.length;i++){
		record2.append( append_data(1,1,work_list_array1[i],i,1) );			
		}
		for(var i=0;i<work_list_array2.length;i++){
		record2.append( append_data(1,2,work_list_array2[i],i,2) );			
		}



	var info = $('#staff-maintain-info');
		for(var i=0;i<staff_list_array3.length;i++){
		info.append( append_data2(0,staff_list_array3[i],i) );			
		}

		for(var i=0;i<staff_list_array2.length;i++){
		info.append( append_data2(1,staff_list_array2[i],i) );			
		}





		function append_data(type1,type2,data,i,ch){

		
			if(type1==0){
				icontype = 'fa fa-building-o';
				lintext = 'company';
				titname = data.ch_name;
			}
			else{
				icontype = 'fa fa-book';
				lintext = 'work';
				titname = data.wname;
			}	




			if(type2==1)
	        pass = $('<input>').attr({id: 'staff-maintain-apply-ok' ,disabled:'disabled',type: 'button',value :'通過'});

			else if(type2==2)
		    pass = $('<input>').attr({id: 'staff-maintain-apply-no' ,disabled:'disabled',type: 'button',value :'不通過'});



			var 
			icon = $('<i>').addClass(icontype),
		    wlink= $('<a>').attr({href: lintext+'/'+data.id,target: '_blank'}).text(" "+titname),
			h1 = $('<h1>').append(icon).append(wlink),
			eyes = $('<i>').addClass('fa fa-eye'),
			overview = $('<a>').addClass('staff-audit-overview').append(eyes).append(' Overview'),
			left = $('<div>').addClass('staff-audit-list-left').append(h1).append(overview),
			right= $('<div>').addClass('staff-audit-list-right').append(pass),
			all = $('<div>').attr({t:type1,n:titname}).addClass('staff-audit-list').append(left).append(right);
			return all;
		}

		function append_data2(type1,data,i){

		
			if(type1==0){
				iconindex="http://akademik.unissula.ac.id/themes/sia/images/user.png"
	
				titname = data.user_name;
			}
			else{
				iconindex="https://chapters.theiia.org/rochester/Officer%20and%20Board/Male_Icon.png";
		
				titname = data.user_name;
			}	





			var 
		    wimg = $('<img>').attr({src:iconindex,height:"40px",width:"40px"}),
			wlink= $('<a>').text(" "+titname),
			h1 = $('<h1>').append(wimg).append(wlink),
			eyes = $('<i>').addClass('fa fa-eye'),
			overview = $('<a>').addClass('staff-audit-overview').append(eyes).append(' Overview'),
			left = $('<div>').addClass('staff-audit-list-left').append(h1).append(overview),
	
			right= $('<div>').addClass('staff-audit-list-right'),

			all = $('<div>').attr({t:type1,n:titname}).addClass('staff-audit-list').append(left).append(right);
			return all;
		}















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


		$('#name-filter').keyup(function(event) {
			filterByName();
		});



		function filterByName(){

			ftype = $('#type-filter').val();
			fname = $('#name-filter').val();

			$('.staff-audit-list').css('display', 'block');

			switch(ftype) {
				case "1":
					$('.staff-audit-list[t!=0]').css('display', 'none');break;
				case "2":
					$('.staff-audit-list[t!=1]').css('display', 'none');break;		
			}	

			if(fname!='')
			$('.staff-audit-list').each(function(index, el) {
				var objname = $( this ).attr('n').toLowerCase();
				if(objname.match(fname.toLowerCase())==null) $( this ).css('display', 'none');
			});

		}





	});

	

	</script>

</head>
<body>



<div class="staff-audit-filterbox">
<select id="type-filter">
	<option value="0" selected="selected">顯示全部</option>
</select>
<input type="text" id="name-filter" placeholder="過濾名稱">
</div>

<div class="workedit-tabbox">
	<div class="sub-tab tab-active" tabtoggle='workedit1'><i class="fa fa-user tab-img"></i> 會員</div>
	<div class="sub-tab" tabtoggle='workedit1'><i class="fa fa-building-o tab-img"></i> 公司</div>
	<div class="sub-tab" tabtoggle='workedit1'><i class="fa fa-book tab-img"></i> 工作</div>
</div>


<div class="workedit-content" id='workedit-content'>

	<div id='staff-maintain-info' class="" tabtoggle='workedit2'></div>
	<div id='company-maintain-record1' class="workedit-content-hide" tabtoggle='workedit2'></div>
	<div id='work-maintain-record2' class="workedit-content-hide" tabtoggle='workedit2'></div>
</div>

</body>
</html>