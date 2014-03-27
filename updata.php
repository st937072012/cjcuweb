<? session_start(); 

echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

include_once("cjcuweb_lib.php");
//響應MvC開發方式 clinet端要POST過來的資料 就是input name要跟資料表欄位相同即可

//取得登入者的ID跟LEVEL權限

$userid = $_SESSION['userid'];
$userlevel = $_SESSION['level'];

//檢查目前登入者的LEVEL (驗證用)
	switch ($userlevel) {

	    case 3: //學生
	        //因為有兩個table所以要分開進行
	        $params  = array($_POST['user_name'],$_POST['dep_name']);
	        $params2 = array($_POST['pic'],$_POST['birthday'],$_POST['nickname'],$_POST['sex'],$_POST['phone'],$_POST['address'],$_POST['email'],$_POST['doc']);
	        student_updata($userid,$params,$params2);
	    break;

	    case 4: //公司
	        $params = array($_POST['ch_name'],$_POST['en_name'],$_POST['phone'],$_POST['fax'],$_POST['uni_num'],$_POST['name'],$_POST['pic'],$_POST['email']);
	        array_push($params,$_POST['address'],$_POST['budget'],$_POST['introduction'],$_POST['doc'],$_POST['staff_num'],$_POST['url']);
	        company_updata($userid,$params);
	    break;

	    case 2: //老師
	        staff_updata($userid,$params);
	    break;


	    default: 
	        echo "you are hacker!";
	    break;
    }

 
//學生的資料修改
function student_updata($userid,$params,$params2)
	{
		include_once("sqlsrv_connect.php");
		
		$sql  = "update cjcu_user set user_name=(?), dep_name=(?) where user_no ='".$userid."'"; 
		$sql2 = "update cjcu_student set pic=(?), birthday=(?), nickname=(?), sex=(?), phone=(?), address=(?), email=(?), doc=(?) where user_no ='".$userid."'"; 
        
        if( sqlsrv_query($conn, $sql, $params) && sqlsrv_query($conn, $sql2, $params2) )
        {
                echo '修改成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url="student_manage.php#student-info">';
        }
        else
        {
                echo '修改失敗!';
                die( print_r( sqlsrv_errors(), true));
        }
      
	}



//廠商的資料修改
function company_updata($userid,$params)
	{
		include_once("sqlsrv_connect.php");
		
		$sql  = "update company set ch_name=(?), en_name=(?), phone=(?), fax=(?), uni_num=(?), name=(?), pic=(?), email=(?), address=(?), budget=(?), introduction=(?), doc=(?), staff_num=(?), url=(?) where id ='".$userid."'"; 
        
        if( sqlsrv_query($conn, $sql, $params) )
        {
                echo '修改成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url="company_manage.php#company-info">';
        }
        else
        {
                echo '修改失敗!';
                die( print_r( sqlsrv_errors(), true));
        }
      
	}




?>
