<?

function sqlsrv_escape($str)
{
    if(get_magic_quotes_gpc())
    {
        $str= stripslashes($str);
    }
    return str_replace("'", "''", $str);
}













?>