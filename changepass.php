<?php include_once("analyticstracking.php") ?>


<?php



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








///////// outer condition

include 'conn.php';
if (isset($_POST['submit'])) { // if form has been submitted

$username = $_COOKIE['ID_my_site']; 
$cpwd = md5($_POST['password']);
$npwd = md5($_POST['newpwd']);
$repwd = md5($_POST['rpwd']);

 // makes sure they filled it in
$lcpwd = strlen($_POST['password']);
$lnpwd = strlen($_POST['newpwd']);
$lrepwd = strlen($_POST['rpwd']);

 	if($lcpwd == 0 or $lnpwd == 0 or $lrepwd == 0) {

 		die('You did not fill in a required field.');

 	}
    if( $npwd != $repwd ) {
	   die('Your new password does not match');
	}

	
	
 $check = mysqli_query($conn,"SELECT password  FROM `users` WHERE `username` = '$username'");
$check2 = mysqli_fetch_array($check);
if ($check2['password'] != $cpwd) {

 		die('Your current password is incorrect');
		exit;

 				}else{
				
	
$changed = mysqli_query($conn,"UPDATE users SET password='$npwd' WHERE username='$username'") or die (mysqli_error());

echo "You have successfully changed your password.";
}
}


else 

{	 

 

 
 include '_inc/header.php';
 include '_inc/left.php';
 ?> 
<td rowspan="2" valign=top width=50%>
<html>
<head>

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

.abt-search-box {
    background: none repeat scroll 0 0 #EEEEEE;
    border: 0 none;
    padding: 10px;
    width: 400px;
}
</style>



<title>ZKITS -- Change Password</title>
</head>
<body>
<center>
<form class="form-container" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<table border="0">
<tr>
<td><input class="abt-search-box" type="password" name="password" value="" placeholder="Current Password"/></td>
</tr>
<tr>
<td><input class="abt-search-box" type="password" name="newpwd" value="" placeholder="New Password"/></td>
</tr>
<tr>
<td><input class="abt-search-box" type="password" name="rpwd" value="" placeholder="Repeat New Password"/></td>
</tr>
<tr><td colspan=2 ><p align=center>
<input  class="button-8"  type="submit" name="submit" value="Change Password" /></p>
</td>
</tr>
</table>
</form>
</center>
</body>
</html>
</td>
 <?php 
include '_inc/right.php';
 } 

 

////////////outer condition 
 
 
 
  			} 

 		} 

 		} 

 else 

 

 //if the cookie does not exist, they are taken to the login screen 

 {			 

 header("Location: login.php"); 

 } 

 ?> 
 