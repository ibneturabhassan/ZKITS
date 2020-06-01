<?php
include 'conn.php';

$id = $_POST['msg_id'];
$user = $_COOKIE['User_id_ZKITS'];

$sql1=mysqli_query($conn,"SELECT * FROM `msg` where rec_id ='$user' AND msg_id = '$id' AND del_rec = 'not' ");
$row1=mysqli_num_rows($sql1);

if( $row1 == '1'){
$del = mysqli_query($conn,"UPDATE msg SET del_rec='done' where msg_id='$id'");

}

?>