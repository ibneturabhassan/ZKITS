<?php
include 'conn.php';


///// variables
$pid = $_POST['postid'];
$username = $_COOKIE['User_id_ZKITS'];
$cmt = $_POST['comment'];
////// checking pid value
$sql1=mysqli_query($conn,"SELECT `post` FROM `posts` where pid ='$pid' ");
$row1=mysqli_num_rows($sql1);
if ( $cmt == "" or $row1 == 0 ){ exit;}

///// inserting comment
$query= "INSERT INTO comment(id,comment,pid,name) Values ('','$cmt','$pid','$username')";
mysqli_query($conn,$query);
echo $cmt;

///// inserting notification row
$actor = $_COOKIE['User_id_ZKITS'];
$object = $pid;

$sql1=mysqli_query($conn,"SELECT `user_id` FROM `posts` where pid ='$pid' ");
$row1=mysqli_fetch_array($sql1);
$subject = $row1['user_id'];


$type = 1;
$status = 'unseen';

if ( $actor != $subject){
$sql5 = "INSERT INTO `notifications`(`id`, `actor_id`, `subject_id`, `object_id`, `type_id`, `status`, `created_date`) VALUES (Null,$actor,$subject,$object,$type,'$status',CURRENT_TIMESTAMP)";
mysqli_query($conn,$sql5);
}
?>