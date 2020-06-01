<?php
include 'conn.php';
$user = $_COOKIE['User_id_ZKITS'];
$changed = mysqli_query($conn,"UPDATE notifications SET status='seen' WHERE subject_id='$user'") or die (mysql_error());

?>