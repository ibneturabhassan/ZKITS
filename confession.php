<?php include_once("analyticstracking.php") ?>


<?php 

//Connects to your Database 
include 'conn.php';
include 'flib.php';

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

if(isset($_POST['submit'])){
////// insert and refresh
$status = $_POST['post'];
$user = $_COOKIE['User_id_ZKITS'];
$group = "confession";

$checkstr = strlen($status) ;
if ( $checkstr == 0 ) {
echo "<script> alert('Please fill out the field');
window.location.href = 'confession.php'; </script>";
exit;}


// Create connection


$conn = mysqli_connect("localhost", "root", "") or die(mysqli_error()); 
 mysqli_select_db("test") or die(mysqli_error()); 

// Check connection
// new end
$sql = "INSERT INTO posts (user_id, location, post)
VALUES ('$user', '$group', '$status')";

if (mysqli_query($conn,$sql)) {
    echo "<script> alert('Status updated successfully');
	window.location.href = 'confession.php'; </script>";
}

mysqli_close($conn);


} else {
// print form
include '_inc/header.php'; 
include '_inc/left.php';
include 'loadbar.php';
?>
<html>
<td rowspan="2" valign=top width=50%>

<style type="text/css">
.button-8 {
	background: #25A6E1;
	background: -moz-linear-gradient(top,#25A6E1 0%,#188BC0 100%);
	background: -webkit-gradient(linear,left top,left bottom,color-stop(0%,#25A6E1),color-stop(100%,#188BC0));
	background: -webkit-linear-gradient(top,#25A6E1 0%,#188BC0 100%);
	background: -o-linear-gradient(top,#25A6E1 0%,#188BC0 100%);
	background: -ms-linear-gradient(top,#25A6E1 0%,#188BC0 100%);
	background: linear-gradient(top,#25A6E1 0%,#188BC0 100%);
	filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#25A6E1',endColorstr='#188BC0',GradientType=0);
	padding:8px 13px;
	color:#fff;
	font-family:'Helvetica Neue',sans-serif;
	font-size:17px;
	border-radius:4px;
	-moz-border-radius:4px;
	-webkit-border-radius:4px;
	border:1px solid #1A87B9
}                
</style>



<form method=post action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
<table width=100% border=0>
<tr>
<td colspan=2>
<textarea style="resize: none; width:100%;font-size:12px" required rows="4" id=contentbox maxlength="400" name=post placeholder="Confess something..."></textarea>
</td>
</tr>

<tr>
<td>
<div id="barbox"><div id="bar"></div></div><div id="count">400</div>

</td>

<td style="text-align: right;"><input class="button-8" type=submit name=submit value=Post>
</td>
</tr>

</table>
</form>




<?php
$search = mysqli_query($conn,"SELECT pid, user_id, post, date FROM posts WHERE location = 'confession' ORDER BY date DESC");

?>
<?php
while($row = mysqli_fetch_assoc($search)) {
 
$name = $row['user_id'];
$getelement = mysqli_query($conn,"SELECT gender FROM users WHERE user_id = '$name'");
$getelement2 = mysqli_query($conn,"SELECT classsection FROM profile WHERE user_id = '$name'");
$row3 = mysqli_fetch_assoc($getelement);
$row4 = mysqli_fetch_assoc($getelement2);

  
 ?>
<a href=comment.php?post=<?php echo $row['pid'];?> >
<table width=98% border=0 style="margin: 10px; background-color: #9ec9ff;" >
<tr>
<td rowspan=2 width=85px><img src="./images/confession.png" style="width:75px; height:75px;"></td>
<td valign=bottom>
<?php 
 if ($row3['gender'] == 'Male' ) { echo "#Boy<br>";} else {echo "#Girl<br>";}
 echo "#".$row4['classsection']."<br>";
 ?>

</td>
</tr>
<tr>
<td valign=top><?php echo dateDiff($row['date']);?></td>
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
?>

<?php
include '_inc/right.php';
}

 			} 

 		} 

 		} 

 else 

 

 //if the cookie does not exist, they are taken to the login screen 

 {			 

 header("Location: login.php"); 

 } 

 ?> 
