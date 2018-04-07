<?php
	
include_once('config.php');

$logout = "UPDATE users SET session_id = NULL WHERE session_id = '".session_id()."'" ;
mysqli_query($link, $logout);
unset($_SESSION['user']);

header("Location:index");
exit();

?>