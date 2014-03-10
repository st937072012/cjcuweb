<?
// 以table 顯示工作清單，給予某公司id 即 印出該公司的工作
// 給予0 null 就印出所有工作
function work_list($company_id){

	include_once("sqlsrv_connect.php");
	echo '<table border="1">';

	$sql='';
	$params = array(); 
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	
	// 抓出某公司的工作列表
	if(!empty($company_id)){
	echo '<tr><td>發布時間</td><td>工作性質</td><td>工作名稱</td><td>上班地點</td></tr>';
	$sql = "select w.date,p.name workpopname,w.name workname,z.name zonename from work as w, work_prop as p ,zone as z where w.company_id=? and w.work_prop_id = p.id and w.zone_id = z.id ";
	$params = array($company_id); 
	}
	// 抓出全部工作列表
	else{
	echo '<tr><td>發布時間</td><td>工作性質</td><td>工作名稱</td><td>公司名稱</td><td>上班地點</td></tr>';
	$sql = "select w.date,p.name,w.name,c.ch_name,z.name from work as w, work_prop as p , company as c,zone as z where w.work_prop_id = p.id and w.company_id = c.id and w.zone_id = z.id ";
	$params = array(); 	
	}

	$result = sqlsrv_query($conn, $sql, $params , $options);
	if($result){
		while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC)  ){
			echo "<tr>";
			echo "<td>".$row[0]."</td>";
			echo "<td>".$row[1]."</td>";
			echo "<td><a href=#>".$row[2]."</a></td>";
			echo "<td>".$row[3]."</td>";
			if(empty($company_id)) echo "<td>".$row[4]."</td>";
			echo "</tr>";
		}
	}
	else die(print_r( sqlsrv_errors(), true));
	echo '</table>';
	// 釋放資源
	sqlsrv_free_stmt($result);
}

?>