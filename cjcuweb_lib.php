<?

// 各種身分的權限值
$level_company = 4;
$level_student = 3;
$level_teacher = 2;
$level_stuff = 1;

// 過濾特殊符號防止注入，傳入字串後回傳過濾後的字串
function sqlsrv_escape($str)
{
    if(get_magic_quotes_gpc()) $str= stripslashes($str);
    return str_replace("'", "''", $str);
}













?>