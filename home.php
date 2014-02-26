<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>


<body>
<h1>長榮大學-媒合系統</h1>
<hr>

<?


if(isset ($_SESSION['username'])){

$who="";
switch ($_SESSION['level']) {
	case 0:	$who = "求職者";break;
	case 1:	$who = "同學";break;
	case 2:	$who = "廠商";break;
	case 3:	$who = "老師";break;
	default: $who = "駭客";break;}


echo "你好".$who." ".$_SESSION['username']."&nbsp;" ;

if($_SESSION['level'] == 2) {
	echo '<a href="my_work.php">管理工作</a>&nbsp;';
	echo '<a href="add_work.php">新增工作</a>&nbsp;';
}

echo '<a href="logout.php">登出</a>&nbsp;';
	

}
else{
echo '<a href="login.html">登入</a>';
}
?>

<h1>工作列表</h1>
<table border="1">
<tr><td>發布時間</td><td>工作性質</td><td>工作名稱</td><td>公司名稱</td><td>上班地點</td></tr>

	<?
	include("mysql_connect.inc.php");
	//$sql = "select * from work";
	$sql = "select w.date,p.name,w.name,c.ch_name,z.name from work as w, work_prop as p , company as c,zone as z where w.work_prop_id = p.id and w.company_id = c.id and w.zone_id = z.id ";
	$result = mysql_query($sql);
	while( $row = mysql_fetch_array($result) ){
		echo "<tr>";
		echo "<td>".$row[0]."</td>";
		echo "<td>".$row[1]."</td>";
		echo "<td><a href=#>".$row[2]."</a></td>";
		echo "<td>".$row[3]."</td>";
		echo "<td>".$row[4]."</td>";
		echo "</tr>";
	}

	?>

</table>

</body>
</html>