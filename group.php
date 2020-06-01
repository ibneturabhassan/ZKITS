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
include 'loadbar.php';

?>
<td rowspan="2" valign=top width=50%>
<?php
if (isset($_GET['group'])) { $group = $_GET['group'];}
else { ?><title>Groups</title><?php
$user = $_COOKIE['ID_my_site'];
$sql = mysqli_query($conn,"select gender from users where username = '$user'");
$row=mysqli_fetch_array($sql);
$type = $row['gender'];

$sql = mysqli_query($conn,"select group_name, type from groups where type = 'All' OR  type = '$type'");
?><br><br><?php
while($row=mysqli_fetch_array($sql)) { 
if ( $row['type'] == "All"){$type = "Open";}
if ( $row['type'] == "Male"){$type = "Boys Only";}
if ( $row['type'] == "Female"){$type = "Girls Only";}?>
<a href="group.php?group=<?php echo $row['group_name'];?>"><?php echo $row['group_name']."(".$type.")";?></a></br>

<?php }
include '_inc/right.php'; exit;
}
//////check for the group
$sql = mysqli_query($conn,"Select * from groups where group_name = '$group'");
if ( mysqli_num_rows($sql) != 1){ echo "<center><h1>Invalid or broken link...!!</h1></center>"; include '_inc/right.php'; exit;}
////// check access permission
$user = $_COOKIE['ID_my_site'];
$sql = mysqli_query($conn,"select gender from users where username = '$user'");
$row=mysqli_fetch_array($sql); 

$sql1 = mysqli_query($conn,"select type from groups where group_name = '$group'");
$row1=mysqli_fetch_array($sql1);
if ( $row1['type'] != 'All') {
if ( $row1['type'] != $row['gender']){ echo "<center><h1>Access Denied...!!</h1></center>"; include '_inc/right.php'; exit; }

}


if(isset($_POST['submit'])){
////// insert and refresh
$status = $_POST['post'];
$user = $_COOKIE['User_id_ZKITS'];
$group = $_GET['group'];

$checkstr = strlen($status) ;
if ( $checkstr == 0 ) {
echo "<script> alert('Please fill out the field');
window.location.href = 'group.php"."?group=".$group."'; </script>";
exit;}


// Create connection





include 'conn.php';

// Check connection
// new end
$sql = "INSERT INTO posts (user_id, location, post)
VALUES ('$user', '$group', '$status')";

if (mysqli_query($conn,$sql)) {
    echo "<script> alert('Status updated successfully');
	window.location.href = 'group.php"."?group=".$group."'; </script>";
}

mysqli_close($conn);


}

?>
<title><?php echo $_GET['group'];?></title>

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



<form method=post action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?group=".$group;?>" >
<table width=100% border=0>
<tr>
<td colspan=2>
<textarea style="resize: none; width:100%;font-size:12px" required rows="4" id=contentbox maxlength=400 name=post placeholder="Share something..."></textarea>
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
include 'flib.php';

$run = mysqli_query($conn,"SELECT pid, user_id, post, date FROM posts WHERE location = '$group' ORDER BY date DESC LIMIT 0, 50");


while($row = mysqli_fetch_array($run)) {

$name = $row['user_id'];
$getelement = mysqli_query($conn,"SELECT firstname, lastname, username, profile_image FROM users WHERE user_id = '$name'");
$row3 = mysqli_fetch_assoc($getelement);

?>
 <a href=comment.php?post=<?php echo $row['pid'];?> >
<table width=98% border=0 style="margin: 10px; background-color: #9ec9ff;" >
<tr>
<td rowspan=2 width=85px>  <img src="./uploads/<?php echo $row3['profile_image']; ?>" style="width:75px; height:75px;">  </td>
<td valign=bottom> <a href=profile.php?id=<?php echo $name; ?>>
<?php
echo $row3['firstname']."&nbsp".$row3['lastname']."&nbsp&nbsp"."<b>".$row3['username'];
 ?>
</a>
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
?>
</td>
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
