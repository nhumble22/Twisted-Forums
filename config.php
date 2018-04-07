<?php
date_default_timezone_set("Pacific/Auckland");
session_start();

//whats needed for accessing database
$host = "localhost";
$username = "admin";
$password = "admin";
$dbname = "forum";

$link = mysqli_connect($host, $username, $password, $dbname);
if (!$link) {
	die("Sorry no connection" . mysqli_connect_error() . "(". mysqli_connect_errorno() . ")");
}
//whats needed for accessing database

?>