<?session_start();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?

// 引入函式庫避免重複執行
	include_once("sqlsrv_connect.php");
	echo('<table border="1"><tr><td>發布時間</td><td>工作性質</td><td>工作名稱</td><td>公司名稱</td><td>上班地點</td></tr>');
	$params = array();
 	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$sql = "select * from cjcu_dep";
	//$sql = "select w.date ,p.name,w.name,c.ch_name,z.name from work as w, work_prop as p , company as c,zone as z where w.work_prop_id = p.id and w.company_id = c.id and w.zone_id = z.id ";
	$result = sqlsrv_query($conn, $sql , $params, $options);



	if( $result === false ) {
	     die( print_r( sqlsrv_errors(), true));
	}


/*
	while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC) ){

		//$datetime = date('Y-m-d', $row[0]);

		echo "<tr>";
		echo "<td>".$row[0]."</td>";
		echo "<td>".$row[1]."</td>";
		echo "<td><a href=#>".$row[2]."</a></td>";
		echo "<td>".$row[3]."</td>";
		echo "<td>".$row[4]."</td>";
		echo "</tr>";
	}
*/	
	echo('</table>');

	//echo $result;
	
	$r = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC);
	echo 'arrat count is: '.count($r);
	//echo 'array is: '.$r;
	
	sqlsrv_free_stmt( $result);
?>