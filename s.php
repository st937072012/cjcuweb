<?
session_start();
session_write_close();

sleep(5);

echo $_SESSION['level'];

?>