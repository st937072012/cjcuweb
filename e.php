<html> 
<head> 
<title>MS SQL Connection Test</title> 
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script >
	var a;
		$(function(){
			
			aja();

			function aja(){

				a = $.ajax({
					url: 's.php',
					type: 'post',
					dataType: 'html',
					beforeSend:function(){
						$('#btn').text('new request');
					}
				})
				.done(function(data) {
					$('#btn').text('done');
					$('d').append(data);
					console.log("OK,done,and a new request");
					aja();
				})
				.fail(function() {
					console.log("error");
					$('#btn').text('error');
					a.abort();
				})
				.always(function() {
					console.log("DisConnect and reconnect");
					$('#btn').text('reconnect');
				});

			}
			
			$('#btn').click(function(event) {
				a.abort();
				console.log("ajax obj: ", a);
			});


		});

	</script>
</head> 
<body> 

<div id="d"></div>
<a href="d.php">Go other</a>
<button id='btn'>Abort Ajax</button>
</body> 
</html> 