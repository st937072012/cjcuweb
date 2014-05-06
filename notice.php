<?
session_start();
$lev = $_SESSION['level'];
$usr = $_SESSION['username'];  




// is not sign in
if($usr==''){

echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
echo "您無權訪問該頁面!".$usr; 
exit;
} 

?>

<!DOCTYPE html>
<html>
<head>

	<title>通知</title>
	<meta charset="utf-8">

	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

	<script><? include_once("js_get_all_notify.php");  get_all_notify($usr,$lev); ?></script>
	<script>

	var ctu = true;

	$(function(){

		appenData(msglist_array);

		// print json array
		function appenData(array){
			var c = $('#msg');
			for(var i=0;i<array.length;i++){
			 for (var k in array[i]) {
		       c.append(array[i][k]+" ");
		     }
			c.append('<br>');
			}	
		}

		var ajax;
		getMsg_longpolling();
		
		//use long polling to get new msg every 3 sec
		function getMsg_longpolling(){

		 ajax =  $.ajax({
               type:"POST",
               data: {level:<? echo '"'.$lev.'"'; ?>,username:<? echo '"'.$usr.'"'; ?>},      
               url:"ajax_get_new_msg.php",
               beforeSend: function( xhr ) {
				    console.log('sent request in long polling');
				}
            })
			.done(function(data) {
		    	data= data.trim();
               	if(data=='')console.log('no any data');            	
               	else if(data=='0')location.replace('../../../cjcuweb/login.php');               
               	else{
         		var arr = JSON.parse(data);
               	appenData(arr);
                $('title').text('New Message~!!');
               	}
	               	
			})
			.fail(function() {ajax.abort(); })
			.always(function() {
				getMsg_longpolling();
			});
		
		}


		

		$('.list').click(function(event) {
			console.log(ctu,ajax);
			ctu=false;
			ajax.abort();
			console.log(ctu,ajax);
		});

	});

	</script>

</head>

<body>

<div id="msg"></div>


</body>
</html>