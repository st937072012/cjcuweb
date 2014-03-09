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

include_once("cjcuweb_lib.php");

if(isset ($_SESSION['username'])){
$who="";

switch ($_SESSION['level']) {
	case 3: $who = "同學"; break;
	case 4: $who = "廠商"; break;
	case 2: $who = "老師"; break;
	case 1: $who ="員工";break;
	default: $who = "駭客";break;
}


echo "你好".$who." ".$_SESSION['username']."&nbsp;" ;

	if($_SESSION['level'] == $level_company) {
		echo '<a href="my_work.php">管理工作</a>&nbsp;';
		echo '<a href="add_work.php">新增工作</a>&nbsp;';
	}

echo '<a href="logout.php">登出</a>&nbsp;';
}	
else echo '<a href="login.html">登入</a>';

?>

<h1>工作列表</h1>
<table border="1">
<tr><td>發布時間</td><td>工作性質</td><td>工作名稱</td><td>公司名稱</td><td>上班地點</td></tr>

<?
	// 引入函式庫避免重複執行
	include_once("sqlsrv_connect.php");

	$sql = "select w.date,p.name,w.name,c.ch_name,z.name from work as w, work_prop as p , company as c,zone as z where w.work_prop_id = p.id and w.company_id = c.id and w.zone_id = z.id ";
	
	// 查詢語句 ? 時，設定其值陣列，因為此 SQL 不需要用到外來參數，所以給予空陣列即可
	$params = array();

	// 設定資料庫內部指標屬性 SQLSRV_CURSOR_KEYSET = Lets you access rows in any order.
	// 詳細可以參閱: http://msdn.microsoft.com/en-us/library/hh487160.aspx
 	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );

	$result = sqlsrv_query($conn, $sql, $params , $options );
	if($result){
		while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC)  ){
			echo "<tr>";
			echo "<td>".$row[0]."</td>";
			echo "<td>".$row[1]."</td>";
			echo "<td><a href=#>".$row[2]."</a></td>";
			echo "<td>".$row[3]."</td>";
			echo "<td>".$row[4]."</td>";
			echo "</tr>";
		}
	}
	else die(print_r( sqlsrv_errors(), true));
	
	// 釋放資源
	sqlsrv_free_stmt($result);

	?>

</table>

</body>
</html>