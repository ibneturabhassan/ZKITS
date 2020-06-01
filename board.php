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

// print form
include '_inc/header.php'; 
include '_inc/left.php';
?>
<html>
<title>Notice Board</title>
<td rowspan="2" valign=top width=50%>





<?php
$search = mysqli_query($conn,"SELECT pid, post, date FROM posts WHERE location = 'notice' ORDER BY date DESC");
 
include 'flib.php';
while($row = mysqli_fetch_assoc($search)) {
 
  
 ?>
 <a href=comment.php?post=<?php echo $row['pid'];?> >
<table width=98% border=0 style="margin: 10px; background-color: #9ec9ff;" >

<tr>
<td valign=top style="padding:10px"><b><?php echo $row['post'];?></b></td>
</tr>
<tr>
<td colspan=2 style="padding:5px" ><?php 

echo dateDiff($row['date']) ;?></td>
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
?>

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
