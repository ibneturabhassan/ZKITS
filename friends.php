<?php include_once("analyticstracking.php") ?>


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
?>
<html>
<title>Friends</title>
<td rowspan="2" valign=top width=50%>
<?php
$uid_fk =  $_COOKIE['User_id_ZKITS'];
$followed =mysqli_query($conn,"select user_id from follow_user where uid_fk ='$uid_fk'");

?>
<h2>friends (<?php echo mysqli_num_rows($followed); ?>)</h2>
<i>Your friends do not know you follow them. It is absolutely anonymous</i>


<?php 
$uid_fk = $_COOKIE['User_id_ZKITS'];
$followed =mysqli_query($conn,"select user_id from follow_user where uid_fk ='$uid_fk'");

while($row = mysqli_fetch_assoc($followed)) { 
$friend = $row['user_id'];
$getelement = mysqli_query($conn,"SELECT firstname, lastname, username, profile_image FROM users WHERE user_id = '$friend'");
$row3 = mysqli_fetch_assoc($getelement);
?>
<a href=profile.php?id=<?php echo $row['user_id'];?>>
<TABLE border=0 width=100%>
<TR valign=top>
<TD width=150>
<img src=uploads\<?php echo $row3['profile_image']; ?> style="width:150px;height:150px">
</TD>
<TD valign=middle width=300px>
<div style="font-size: 20px;"><?php echo $row3['firstname']."&nbsp".$row3['lastname']."&nbsp&nbsp"."<br><b>(".$row3['username'].")"; ?></div>
</TD>
<TD valign=middle>
<?php
include 'follow4friend.php';
?>
</TD>
</TR>
</TABLE>
</a><br>
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
