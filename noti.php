<?php 

//Connects to your Database 
include 'conn.php';


 //checks cookies to make sure they are logged in 

 if(isset($_COOKIE['ID_my_site'])) 

 { 

 	$username = $_COOKIE['ID_my_site']; 

 	$pass = $_COOKIE['Key_my_site']; 

 	 	$check = mysqli_query($conn,"SELECT * FROM users WHERE username = '$username'")or die(mysqli_error()); 

 	while($info = mysqli_fetch_array( $check )) 	 

 		{ 

 

 //if the cookie has the wrong password, they are taken to the login page 

 		if ($pass != $info['password']) 

 			{ 			header("Location: login.php"); 

 			} 

 

 //otherwise they are shown the admin area	 

 	else 

 			{ 

	
// layout elements
include '_inc/header.php'; 
include '_inc/left.php';

$user = $_COOKIE['User_id_ZKITS'];
$changed = mysqli_query($conn,"UPDATE notifications SET status='seen' WHERE subject_id='$user'") or die (mysqli_error());

?>
<html>
<td rowspan="2" valign=top width=50%>


<?php
$username = $_COOKIE['User_id_ZKITS'];
$sql2=mysqli_query($conn,"SELECT * FROM `notifications` where subject_id ='$username' ORDER BY created_date DESC LIMIT 0, 15");

while($row1 = mysqli_fetch_assoc($sql2)) { 
$actor = $row1['actor_id'];

$sql1=mysqli_query($conn,"SELECT * FROM `users` where user_id ='$actor' ");
$element = mysqli_fetch_assoc($sql1);
?>
<table width=98% style="margin: 10px; background-color: #9ec9ff;">
<tr>
<td width=75px>
<img src="uploads/<?php echo $element['profile_image'];?>" style="width:75px;height:75px;border:0">
</td>
<td>
<a href ='comment.php?post=<?php echo $row1['object_id'];?>'><?php echo $element['username']." ";if ( $row1['type_id'] == 1 ) {echo 'commented on your post';} ?></a><br><br>
</td></tr>
</table>
<?php

}
?>

</td>
</html>
<?php
include '_inc/right.php';


 			} 

 		} 

 		} 

 else 

 

 //if the cookie does not exist, they are taken to the login screen 

 {			 

 header("Location: login.php"); 

 } 

 ?> 
