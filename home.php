<?php session_start(); ?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script>$(function(){ $('#view-header').load('public_view/header.php #header');});</script>

</head>
<body>
<div id="view-header"></div>





<div class="div-align">
	<? include_once('work_list_lib.php'); work_list(NULL); ?>

	
</div>



</body>
</html>