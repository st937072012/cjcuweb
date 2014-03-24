<? session_start(); 

echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

include_once("cjcuweb_lib.php");

//檢查目前登入者的權限 (驗證用)

$userid = $_SESSION['userid'];
$userlevel = $_SESSION['level'];

//userid跟level驗證

	switch ($userlevel) {
	    case 3: //學生
	        $params  = array($_POST['val1'],$_POST['val2']);
	        $params2 = array($_POST['val3'],$_POST['val4'],$_POST['val5'],$_POST['val6'],$_POST['val7'],$_POST['val8'],$_POST['val9'],$_POST['val10']);
	        student_updata($userid,$params,$params2);
	    break;

	    case 4: //公司
	        $table_name = "company";
	    break;

	    case 2: //老師
	        $table_name = "staff";
	    break;


	    default: $who = "駭客";
	    break;
    }

 

function student_updata($userid,$params,$params2)
	{
		include_once("sqlsrv_connect.php");
		
		$sql  = "update cjcu_user set user_name=(?), dep_name=(?) where user_no ='".$userid."'"; 
		$sql2 = "update cjcu_student set pic=(?), birthday=(?), nickname=(?), sex=(?), phone=(?), address=(?), email=(?), doc=(?) where user_no ='".$userid."'"; 
        
        if( sqlsrv_query($conn, $sql, $params) && sqlsrv_query($conn, $sql2, $params2) )
        {
                echo '修改成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url="student/'.$_SESSION["username"].'">';
        }
        else
        {
                echo '修改失敗!';
                die( print_r( sqlsrv_errors(), true));
        }
      
	}


?>
