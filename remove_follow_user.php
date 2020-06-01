<?php

$uid=$_COOKIE['User_id_ZKITS'] ;

include 'conn.php';
 

if($_POST['user_id'])
{
$user_id=$_POST['user_id'];
$user_id = mysqli_escape_String($user_id);



$sql_in = mysqli_query($conn,"DELETE from follow_user Where uid_fk='$uid' and user_id='$user_id'");
}

?>