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
			
if (isset($_GET['id'])) {$id = htmlspecialchars($_GET['id']);}
else {$id = htmlspecialchars($_COOKIE['User_id_ZKITS']);}
include '_inc/header.php'; 

///// visit
$user_id = $_COOKIE['User_id_ZKITS'];
$query= "INSERT INTO profile_visits(user_id,profile_visited) Values ('$user_id','$id')";
mysqli_query($conn, $query);


///////left
$sql=mysqli_query($conn,"select firstname, lastname, username, gender, profile_image from users where user_id='$id'");
$row=mysqli_fetch_array($sql); 
$numrow = mysqli_num_rows($sql);

if ($numrow == 0){ 
include '_inc/left.php';
echo ("<td rowspan=2 valign=top width=50%><a align=center><h1>Invalid Link...!!</h1></a></td>");
include '_inc/right.php';
exit;
}
?>
<TD width=25% id=left valign=top>
<title><?php echo $row['firstname']."&nbsp;". $row['lastname'] ; ?></title>
<style>
.black_overlay{
	display: none;
	position: absolute;
	top: 0%;
	left: 0%;
	width: 100%;
	height: 100%;
	background-color: black;
	z-index:1001;
	-moz-opacity: 0.8;
	opacity:.80;
	filter: alpha(opacity=80);
}

.white_content {
	display: none;
	position: absolute;
	top: 25%;
	left: 25%;
	width: 500px;
	height: 525px;
	padding: 0px;
	border: 5px #4497e3;
	background-color: #4497e3;
	z-index:1002;
	overflow: auto;
}


</style>

<table border=0 width=100%>
<tr><!--Head of profile-->
<td width=125px >
<div>

<a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">
<img src="uploads\<?php echo $row['profile_image']; ?>" style="width:125px;height:125px;">
</a>


<div id="light" class="white_content">
<a align="center" href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">
<img src="images/close.png" style="width:16px;height:16px;border:0">
</a>

<img src="uploads\<?php echo $row['profile_image']; ?>" style="width:500px;height:500px;border:0">

</div>

<div id="fade" class="black_overlay"></div>

</div>
</td>
<td>
<font style="font-size: 20px;"><?php echo $row['firstname']."&nbsp;". $row['lastname'] ."<br>"."(" .$row['username']. ")" ;?></font>
</td>
</tr>
</table>
<?php
//// follow
$followed =mysqli_query($conn,"select uid_fk from follow_user where user_id ='$user_id'");
if ( $id == $_COOKIE['User_id_ZKITS']){echo 'Followers:'.mysqli_num_rows($followed);}
if ( $id != $_COOKIE['User_id_ZKITS']){ include 'followbutton.php';}
?>
<br><a href="cmsg.php?id=<?php echo $id; ?>"><img src="images/sendmsg.png" alt="Send Message"></a></br>
<br><br><br>
<a href="profile.php?id=<?php echo $id; ?>&tab=wall"><img src="images/wall.png" alt="Post on your Wall" style="width:25px;height:25px;border:0"> Wall</a></br>
<a href="profile.php?id=<?php echo $id; ?>&tab=about"><img src="images/information.png" alt="Post on your Wall" style="width:25px;height:25px;border:0"> About</a></br>

</td>
<?php
///////end left			





$profile=mysqli_query($conn,"select day, month, year, classsection, roll, sportshouse, relation, interested, hometown, ccity, religiousviews, politicalviews, favquotes from profile where user_id='$id'");
$rowpro=mysqli_fetch_array($profile);
$numpro = mysqli_num_rows($profile);

$contact=mysqli_query($conn,"select mail, phone, padd, website, others from cinfoprofile where user_id='$id'");
$cinfo=mysqli_fetch_array($contact);
$numcinfo = mysqli_num_rows($contact);

?>



<td rowspan="2" valign=top width=50%>
<table width=100% border=0>
<?php
if (isset($_GET['tab'])) {$tab = htmlspecialchars($_GET['tab']);}
else {$tab = 'wall';}
if ( $tab != 'wall' AND $tab != 'about'){ exit;}

if ( $tab == 'wall' ) { ///// wall 
$search = mysqli_query($conn,"SELECT pid, post, date FROM posts WHERE location = '$id' ORDER BY date DESC");
$numofposts = mysqli_num_rows($search);

if ( $numofposts == 0) { ?>
<center><h1>No post to display</h1></center>
</table>
</td><?php
}

include 'flib.php';
while($row = mysqli_fetch_assoc($search)) {
 
$name = $id;
$getelement = mysqli_query($conn,"SELECT firstname, lastname, username, profile_image FROM users WHERE user_id = '$name'");
$row3 = mysqli_fetch_assoc($getelement);
  
 ?>

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
<td colspan=2 style="color: #dfdfdf;"> <a href=comment.php?post=<?php echo $row['pid'];?> >
<img src="images/like.ico" style="width:20px;height:20px"><?php echo "Likes(".$row2.")"."&nbsp;&nbsp;&nbsp;&nbsp;" ;?>
<img src="images/dislike.ico" style="width:20px;height:20px"><?php echo "Dislikes(".$row3.")"."&nbsp;&nbsp;&nbsp;&nbsp;" ;?>
<img src="images/comment.ico" style="width:20px;height:20px"><?php echo "Comments(".$row1.")" ;?></td>
</a>
</tr>
</table>

<?php
}//// end of loop


include '_inc/right.php';
} ///// display wall 


if ( $tab == 'about' ) {
if ( $numrow != 0) { echo
"<th colspan=2 align=center>Basic Info</th>";
}

if ( $row['gender'] != "") { echo 
"<tr>
<td  valign=top width=35%>Gender:</td>
<td>".$row['gender']."</td>
</tr>";
}

if ( $rowpro['day'] != "" AND $rowpro['month'] != "" AND $rowpro['year'] != "" ) { echo 
"<tr>
<td valign=top >Date of birth:</td>
<td>".$rowpro['day']."-".$rowpro['month']."-".$rowpro['year']."</td>
</tr>";
}

if ( $rowpro['classsection']) { echo 
"<tr>
<td valign=top >Class/Section:</td>
<td>".$rowpro['classsection']."</td>
</tr>";
}

if ( $rowpro['roll']) { echo 
"<tr>
<td valign=top >Roll Number:</td>
<td>".$rowpro['roll']."</td>
</tr>";
}

if ( $rowpro['sportshouse']) { echo 
"<tr>
<td valign=top >House:</td>
<td>".$rowpro['sportshouse']."</td>
</tr>";
}

if ( $rowpro['relation']) { echo 
"<tr>
<td valign=top >Relation:</td>
<td>".$rowpro['relation']."</td>
</tr>";
}

if ( $rowpro['interested']) { echo 
"<tr>
<td valign=top >Interested In:</td>
<td>".$rowpro['interested']."</td>
</tr>";
}

if ( $rowpro['hometown']) { echo 
"<tr>
<td valign=top >Hometown:</td>
<td>".$rowpro['hometown']."</td>
</tr>";
}

if ( $rowpro['ccity']) { echo 
"<tr>
<td valign=top >Current city:</td>
<td>".$rowpro['ccity']."</td>
</tr>";
}

if ( $numpro != 0) { echo 
"<th colspan=2 >About Me</th>";
}


if ( $rowpro['religiousviews']) { echo 
"<tr>
<td>Religious Views:</td>
<td valign=top >".$rowpro['religiousviews']."</td>
</tr>";
}

if ( $rowpro['politicalviews']) { echo 
"<tr>
<td valign=top >Political Views:</td>
<td>".$rowpro['politicalviews']."</td>
</tr>";
}

if ( $rowpro['favquotes']) { echo 
"<tr>
<td valign=top >Favorite Quotes:</td>
<td>".$rowpro['favquotes']."</td>
</tr>";
}

if ( $numcinfo != 0) { echo 
"<th colspan=2>Contact Info</th>";
}


if ( $cinfo['mail']) { echo 
"<tr>
<td valign=top >E-mail:</td>
<td>".$cinfo['mail']."</td>
</tr>";
}
if ( $cinfo['phone']) { echo 
"<tr>
<td valign=top >Phone Number:</td>
<td>".$cinfo['phone']."</td>
</tr>";
}

if ( $cinfo['padd']) { echo 
"<tr>
<td valign=top >Postal Address:</td>
<td>".$cinfo['padd']."</td>
</tr>";
}

if ( $cinfo['website']) { echo 
"<tr>
<td valign=top >Website:</td>
<td>".$cinfo['website']."</td>
</tr>";
}

if ( $cinfo['others']) { echo 
"<tr>
<td valign=top >Others:</td>
<td>".$cinfo['others']."</td>
</tr>";
}

?>
</table>
</td>
<?php
include '_inc/right.php';
} //// display about
 			} 
			

 		} 

 		} 

 else 

 

 //if the cookie does not exist, they are taken to the login screen 

 {			 

 header("Location: login.php"); 

 } 

 ?> 
