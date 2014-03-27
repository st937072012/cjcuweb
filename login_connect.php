<?session_start();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

include_once("sqlsrv_connect.php");
include_once("cjcuweb_lib.php");

$sel    = sqlsrv_escape(trim($_POST['sel']));
$userid = sqlsrv_escape(trim($_POST['id']));
$pw     = sqlsrv_escape(trim($_POST['pw']));



switch ($sel) {
    case "student":
        student_login($conn,$userid,$pw);
    break;
    case "company":
        company_login($conn,$userid,$pw);
    break;
    case "staff":
        echo '老師會員 coming soon';
    break;
}



function student_login($conn,$userid,$pw){
    //因為學生的驗證要配合學校 顧目前先不做太完整的驗證

    include_once("cjcuweb_lib.php");

    if(verification($userid,$pw)){

        $_SESSION['username'] = $userid;
        $_SESSION['level'] = 3;
        //level吃不到cjcu_lib裡面的變數level_student

        login_echo(1);
    }
    else{
        login_echo(0);
    }

}






function company_login($conn,$userid,$pw){


    $sql = "select * from company where id=?";
    $params  = array($userid);
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);

    $result  = sqlsrv_query( $conn , $sql , $params , $options );
    if( $result ){

	$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC);

	
	    // 資料表查無帳號 , 沒有輸入或密碼不符
	    if(count($row) != 0 && $userid != null && $pw != null && $row[1] == md5($pw)){

            $_SESSION['username'] = $userid;
            $_SESSION['level'] = 4;

            login_echo(1);
	    }
        
	    else{

	    	login_echo(0);
	    }
	
    }
}




function login_echo($os){

    if($os == 1){
        echo '登入成功! 跳轉中，請稍後...';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=home.php>';
    }else{
        echo '帳號或密碼錯誤! 跳轉中...';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
    }
}


?>