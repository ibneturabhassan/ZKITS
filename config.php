<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = mysql_connect($servername, $username, $password, $dbname);
mysql_select_db('test',$conn);
?>