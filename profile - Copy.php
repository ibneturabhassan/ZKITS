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
include '_inc/header.php'; 
include '_inc/left.php';
			
if (isset($_GET['id'])) {$id = htmlspecialchars($_GET['id']);}
else {$id = htmlspecialchars($_COOKIE['User_id_ZKITS']);}


$sql=mysqli_query($conn,"select firstname, lastname, username, gender, profile_image from users where user_id='$id'");
$row=mysqli_fetch_array($sql); 
$numrow = mysqli_num_rows($sql);

$profile=mysqli_query($conn,"select day, month, year, classsection, roll, sportshouse, relation, interested, hometown, ccity, religiousviews, politicalviews, favquotes from profile where user_id='$id'");
$rowpro=mysqli_fetch_array($profile);
$numpro = mysqli_num_rows($profile);

$contact=mysqli_query($conn,"select mail, phone, padd, website, others from cinfoprofile where user_id='$id'");
$cinfo=mysqli_fetch_array($contact);
$numcinfo = mysqli_num_rows($contact);
if ($numrow == 0){ echo ("<td rowspan=2 valign=top width=50%><a align=center><h1>Invalid Link...!!</h1></a></td>");
include '_inc/right.php';
exit;
}
?>
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

<title><?php echo $row['firstname']."&nbsp;". $row['lastname'] ; ?></title>
<td rowspan="2" valign=top width=50%>
<table border=0 width=100%>
<tr><!--Head of profile-->
<td width=150px >
<div>

<a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">
<img src="uploads\<?php echo $row['profile_image']; ?>" style="width:150px;height:150px;">
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
<font style="font-size: 30px;"><?php echo $row['firstname']."&nbsp;". $row['lastname'] ."<br>"."(" .$row['username']. ")" ;?></font>
</td>
</tr>
</table> <br> <br>
<table width=100% border=0>
<?php



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

 			} 

 		} 

 		} 

 else 

 

 //if the cookie does not exist, they are taken to the login screen 

 {			 

 header("Location: login.php"); 

 } 

 ?> 
