<?php

$uid=$_COOKIE['User_id_ZKITS'] ;

include 'conn.php';


if($_POST['user_id'])
{
$user_id=$_POST['user_id'];
$user_id = mysqli_escape_String($user_id);


$sql_in = "INSERT into follow_user(uid_fk,user_id) values ('$uid','$user_id')";
mysqli_query( $conn, $sql_in);
}

?>