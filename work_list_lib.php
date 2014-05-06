<?
//給予某公司id 即 印出該公司的工作
// 給予0 null 就印出所有工作
// 3/24 不適用，改為js_work_list
// 3/31 完全不適用
function work_list($company_id){
	include_once("sqlsrv_connect.php");
	echo '<table border="1">';
	$sql='';
	$params = array(); 
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	

	//搜尋表
	echo "<input type='text' name='search'/><input type='submit' name='button' value='搜尋工作'/><br><br>";
	// 抓出某公司的工作列表
	if(!empty($company_id)){
	$sql = "select w.id workid,w.date postdate,p.name workpopname,w.name workname,w.detail detail,z.name zonename 
	from work w, work_prop p, zone z  where  w.company_id=? and p.id= w.work_prop_id and z.id=w.zone_id  ORDER BY w.date DESC";
	$params = array($company_id); 
	}
	// 抓出全部工作列表
	else{
	$sql = "select w.id,w.date,p.name,w.name,c.ch_name,z.name from work as w, work_prop as p , company as c,zone as z where w.work_prop_id = p.id and w.company_id = c.id and w.zone_id = z.id ORDER BY w.date DESC";
	$params = array(); 	
	}

	$result = sqlsrv_query($conn, $sql, $params , $options);
	if($result){
		while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)  ){

			echo "<a class='work-title' href=work/".$row[workid]."><h1 class='work-title'>".$row[workname]."</h1></a>";
			echo "<div id='work-box'>";
			echo $row[detail]."<br>";
			echo "<b>地點</b>  ".$row[zonename];
			echo "　<b>性質</b>  ".$row[workpopname]."<br>";
			echo "<a class='time'>".$row[postdate]."</a>"."<a id='candidates'>0/5  應徵人數:10</a>";
			echo "</div><hr>";
		}
		echo "<br>";
	}
	else die(print_r( sqlsrv_errors(), true));
	

	// 釋放資源
	sqlsrv_free_stmt($result);
}


// 給予某學生id 即 印出該學生應徵的工作
// 不給 id 的話 就直接結束
// 3/31 完全不適用
function student_work_list($user_id){
	if(!isset($user_id)) exit;
	include_once("sqlsrv_connect.php");
	echo '<table border="1">';
	echo '<tr><td>發布時間</td><td>工作性質</td><td>工作名稱</td><td>公司名稱</td><td>上班地點</td></tr>';
	

	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$params = array($user_id); 
	$sql =   "select w.id,w.date,p.name,w.name,c.ch_name,z.name "
			."from work as w, work_prop as p , company as c,zone as z,line_up as up "
			."where up.user_id=? and up.work_id=w.id and w.work_prop_id = p.id and w.company_id = c.id and w.zone_id = z.id ORDER BY w.date DESC";
	$result = sqlsrv_query($conn, $sql, $params , $options);

	if($result){
		while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC) ){
			echo "<tr>";
			echo "<td>".$row[1]."</td>";
			echo "<td>".$row[2]."</td>";
			echo "<td><a href=work/".$row[0]."/>".$row[3]."</a></td>";
			echo "<td>".$row[4]."</td>";
			if(empty($company_id)) echo "<td>".$row[5]."</td>";
			echo "</tr>";
		}
	}
	else die(print_r( sqlsrv_errors(), true));
	echo '</table>';
	// 釋放資源
	sqlsrv_free_stmt($result);
}

?>