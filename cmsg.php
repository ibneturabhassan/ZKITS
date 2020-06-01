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
			
			
if(isset($_POST['submit'])){
////// insert and refresh
$rec = $_POST['username'];
$msg = $_POST['msg'];
$sender = $_COOKIE['User_id_ZKITS'];;

$checkstr = strlen($msg) ;
if ( $checkstr == 0 ) {
echo "<script> alert('Please fill out the field');
window.location.href = 'cmsg.php'; </script>";
exit;}

$sql1=mysqli_query($conn,"SELECT * FROM `users` where username ='$rec' ");
$row1=mysqli_num_rows($sql1);
if ( $row1 == 0 OR $row1 > 1) {
echo "<script> alert('Incorrect username!! No user with such username exists.');
window.location.href = 'cmsg.php'; </script>";
exit;
}
$row2=mysqli_fetch_array($sql1);
$rec_id = $row2['user_id'] ;
// Create connection





include 'conn.php';

// Check connection
// new end
$sql = "INSERT INTO msg (sender_id, rec_id, msg)
VALUES ('$sender', '$rec_id', '$msg')";

if (mysqli_query($conn,$sql)) {
    echo "<script> alert('Message sent successfully');
	window.location.href = 'cmsg.php'; </script>";
}

mysqli_close($conn);


} else {

	
// layout elements
include '_inc/header.php'; 
include '_inc/msgleft.php';
?>


<td rowspan="2" valign="top" width=50%>

<style type="text/css">

.box {
    background: none repeat scroll 0 0 #EEEEEE;
    border: 0 none;
    padding: 10px;
    width: 400px;
}
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
<?php
error_reporting(E_ERROR | E_PARSE);
if (isset($_GET['id'])) {
$id = $_GET['id'];

$sql1=mysqli_query($conn,"SELECT * FROM `users` where user_id ='$id'");
$row1=mysqli_fetch_array($sql1);
$user = $row1['username'];
}
?>

<form method=post action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
<table width=100% border=0>

<tr>
<td colspan=2>
<input class="box" style="resize: none; width:100%;font-size:14px" required name=username
value="<?php echo $user ;?>"
 placeholder="To: 'Username'"></td>
</tr>

<tr>
<td colspan=2>
<textarea class="box" style="resize: none; width:100%;font-size:12px" required id=contentbox rows="12" name=msg placeholder="Message..."></textarea>
</td>
</tr>

<tr>

<td style="text-align: right;"><input class="button-8" type=submit name=submit value=Send>
</td>
</tr>

</table>
</form>

</td>
</html>
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
