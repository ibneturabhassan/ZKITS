<?php include_once("analyticstracking.php") ?>


<?php 

//Connects to your Database 
include 'conn.php';


 //Checks if there is a login cookie
 if(isset($_COOKIE['ID_my_site']))


 //if there is, it logs you in and directes you to the members page
 { 
 	$username = $_COOKIE['ID_my_site']; 

 	$pass = $_COOKIE['Key_my_site'];

 	 	$check = mysqli_query($conn,"SELECT * FROM users WHERE username = '$username'")or die(mysql_error());

 	while($info = mysqli_fetch_array( $check )) 	

 		{

 		if ($pass != $info['password']) 

 			{

 			 			}

 		else

 			{

 			header("Location: members.php");



 			}

 		}

 }


 //if the login form is submitted 

 if (isset($_POST['submit'])) { // if form has been submitted



 // makes sure they filled it in

 	if(!$_POST['username'] | !$_POST['pass']) {

 		die('You did not fill in a required field.');

 	}

 	// checks it against the database



 	if (!get_magic_quotes_gpc()) {

 		$_POST['username'] = addslashes($_POST['username']);

 	}

 	$check = mysqli_query($conn,"SELECT * FROM users WHERE username = '".$_POST['username']."'")or die(mysql_error());



 //Gives error if user dosen't exist

 $check2 = mysqli_num_rows($check);

 if ($check2 == 0) {

 		die('That user does not exist in our database. <a href=add.php>Click Here to Register</a>');

 				}

 while($info = mysqli_fetch_array( $check )) 	

 {

 $_POST['pass'] = stripslashes($_POST['pass']);

 	$info['password'] = stripslashes($info['password']);

 	$_POST['pass'] = md5($_POST['pass']);



 //gives error if the password is wrong

 	if ($_POST['pass'] != $info['password']) {

 		die('Incorrect password, please try again.');

 	}
 else 

 { 




 // if login is ok then we add a cookie 
	


$_POST['username'] = stripslashes($_POST['username']); 
$hour = time() + 3600; 
setcookie(ID_my_site, $_POST['username'], $hour); 
setcookie(Key_my_site, $_POST['pass'], $hour);			
$username = $_POST['username'];
$sql=mysqli_query($conn,"select user_id from users where username='$username'");
$row=mysqli_fetch_array($sql);
$cookiename = "User_id_ZKITS";
$value= $row['user_id'];
setcookie($cookiename, $value, $hour);

$date = date("y-m-d h:i:sa") ;
$update = mysqli_query($conn,"UPDATE users SET last_login='$date' WHERE user_id='$value'");



//then redirect them to the members area 
header("Location: members.php"); 
 } 
} 
} 

else 

{	 

 

 // if they are not logged in 

 ?> 

<html>
<head>

<style type="text/css">
div#container
{
   width: 1280px;
   position: relative;
   margin-top: 0px;
   margin-left: auto;
   margin-right: auto;
   text-align: left;
}
body
{
   text-align: center;
   margin: 0;
}
</style>
<script language="JavaScript" type="text/javascript">
<!--
function Validatelogin(theForm)
{
if (theForm.Editbox1.value == "")
{
   alert("Please enter a value for the \"Editbox1\" field.");
   theForm.Editbox1.focus();
   return false;
}
if (theForm.Editbox2.value == "")
{
   alert("Please enter a value for the \"Editbox2\" field.");
   theForm.Editbox2.focus();
   return false;
}
return true;
}
//-->
</script>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<div id="container">
<div id="bv_Image1" style="overflow:hidden;position:absolute;left:0px;top:0px;z-index:4" align="left">
<img src="./images/bv01004.jpg" id="Image1" alt="" align="top" border="0" style="min-height: 100%;min-width: 1280px;width: 100%;height: auto;position: fixed;top: 0;left: 0;"></div>
<div id="bv_Shape1" style="position:absolute;left:258px;top:350px;width:380px;height:338px;opacity:0.50;-moz-opacity:0.50;-khtml-opacity:0.50;filter:alpha(opacity=50);z-index:5" align="center">
<img src="./images/bv01002.gif" id="Shape1" align="top" alt="" title="" border="0" width="380" height="338"></div>
<div id="bv_Shape2" style="position:absolute;left:638px;top:350px;width:496px;height:338px;opacity:0.75;-moz-opacity:0.75;-khtml-opacity:0.75;filter:alpha(opacity=75);z-index:6" align="center">
<img src="./images/bv01001.gif" id="Shape2" align="top" alt="" title="" border="0" width="496" height="338"></div>
<div id="bv_Form1" style="position:absolute;left:675px;top:480px;width:402px;height:200px;z-index:7" align="left">

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<input type="text" style="position:absolute;left:27px;top:-50px;width:343px;border:2px #44A2FF solid;color:#7F7F7F;font-family:Agency FB;font-style:italic;font-size:19px;z-index:1" size="49" name="username" placeholder="Username" maxlength="40">
<input type="password" style="position:absolute;left:27px;top:-10px;width:343px;border:2px #44A2FF solid;font-family:Agency FB;font-style:italic;font-size:19px;z-index:2" size="49" name="pass" placeholder="Password" maxlength="50">
<input type="submit" name="submit" value="Login to ZKITS" style="position:absolute;left:224px;top:30px;width:148px;height:41px;z-index:0">
<div id="bv_Text1" style="position:absolute;left:32px;top:100px;width:400px;height:28px;z-index:3" align="left">
<font style="font-size:19px" color="#44A2FF" face="Agency FB"><a href="add.php">Create a new account</a> - <a onclick="alert('Please write to school page on facebook for resetting password.');" >Forgot Password?</a></font></div>

</form>
</div>
<div id="bv_Shape3" style="position:absolute;left:258px;top:150px;width:876px;height:200px;opacity:0.50;-moz-opacity:0.50;-khtml-opacity:0.50;filter:alpha(opacity=50);z-index:8" align="center">
<img src="./images/bv010051.gif" id="Shape3" align="top" alt="" title="" border="0" width="876" height="200"></div>
</div>

</body></html>

 <?php 

 } 

 

 ?>