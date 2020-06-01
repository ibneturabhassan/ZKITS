<?php include_once("analyticstracking.php") ?>


<?php 

//Connects to your Database 
include 'conn.php';


 //checks cookies to make sure they are logged in 

 if(isset($_COOKIE['ID_my_site'])) 

 { 

 	$username = $_COOKIE['ID_my_site']; 

 	$pass = $_COOKIE['Key_my_site']; 

 	 	$check = mysqli_query($conn,"SELECT * FROM users WHERE username = '$username'")or die(mysql_error()); 

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
include 'loadbar.php';
?>
<html>
<title>Home</title>
<td rowspan="2" valign=top width=50%>
<h1><a href="members.php">Home</a> <a href="stream.php">Stream</a></h1>
<?php
include 'flib.php';

$run = mysqli_query($conn,"SELECT pid, user_id, post, date, location FROM posts WHERE location != 'notice' ORDER BY date DESC LIMIT 0, 30");


while($row = mysqli_fetch_array($run)) {
///// check
$location = $row['location'];

if ( is_numeric($location) ) {

$name = $row['user_id'];
$user = $_COOKIE['User_id_ZKITS'];
$num = mysqli_query($conn,"SELECT * FROM follow_user WHERE uid_fk = '$user' AND user_id = '$name'");
if ( mysqli_num_rows($num) != 0){




$getelement = mysqli_query($conn,"SELECT firstname, lastname, username, profile_image FROM users WHERE user_id = '$name'");
$row3 = mysqli_fetch_assoc($getelement);
$pro = $row3['profile_image'];
?>
 <a href=comment.php?post=<?php echo $row['pid'];?> >
<table width=98% border=0 style="margin: 10px; background-color: #9ec9ff;" >
<tr>
<td rowspan=2 width=85px>  <img src="<?php if ($row['location'] == "confession") {echo'./images/confession.png';} else {echo'./uploads/'.$pro;} ?>" style="width:75px; height:75px;">  </td>
<td valign=bottom>
<?php
if ( $location == "confession") {
$getelement4 = mysqli_query($conn,"SELECT gender FROM users WHERE user_id = '$name'");
$row4 = mysqli_fetch_assoc($getelement4);
if ($row4['gender'] == 'Male' ) { echo "#Boy<br>";} else {echo "#Girl<br>";}
} else  { ?> <a href=profile.php?id=<?php echo $name; ?>><?php

echo $row3['firstname']."&nbsp".$row3['lastname']."&nbsp&nbsp<b>".$row3['username']."</b></a><br>";
}
if(is_numeric($location)){ echo "Posted on his wall";} else {echo "Posted in ".$location;}
 ?>
</td>
</tr>
<tr>
<td valign=top><?php 

echo dateDiff($row['date']) ;?></td>
</tr>
<tr>
<td colspan=2 style="padding:10px" ><?php echo nl2br(preg_replace('/<[^<]+?>/', ' ', $row['post']) ) ;?></td>
</tr>

<?php
$no = $row['pid'];
$sql1=mysqli_query($conn,"SELECT `pid` FROM `comment` where pid ='$no' ");
$row1=mysqli_num_rows($sql1);
///// likes
$sql2=mysqli_query($conn,"SELECT * FROM `wcd_yt_rate` where id_item ='$no' AND rate = '1' ");
$row2=mysqli_num_rows($sql2);
//// dislikes
$sql3=mysqli_query($conn,"SELECT * FROM `wcd_yt_rate` where id_item ='$no' AND rate = '2' ");
$row3=mysqli_num_rows($sql3);

?>
<tr>
<td colspan=2 style="color: #dfdfdf;">
<img src="images/like.ico" style="width:20px;height:20px"><?php echo "Likes(".$row2.")"."&nbsp;&nbsp;&nbsp;&nbsp;" ;?>
<img src="images/dislike.ico" style="width:20px;height:20px"><?php echo "Dislikes(".$row3.")"."&nbsp;&nbsp;&nbsp;&nbsp;" ;?>
<img src="images/comment.ico" style="width:20px;height:20px"><?php echo "Comments(".$row1.")" ;?></td>
</tr>
</table></a>

<?php
}

}

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
