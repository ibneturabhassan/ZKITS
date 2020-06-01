<?php

include 'conn.php';
$DD = $_POST['Date']; 
$MM = $_POST['Month']; 
$YY = $_POST['Year']; 
$birth = "$YY-$MM-$DD";
$p1 = $_POST['pass'];
$p2 = $_POST['pass2'];
$a = $_POST['firstname'];
$b = $_POST['lastname'];
$c = $_POST['username'];
$d = $_POST['gender'];
$e = $_POST['classsection'];
$f = $_POST['zno'];
$g = $_POST['shouse'];
$h = $_POST['email'];
$i = $_POST['phno'];
$j = $_POST['houseaddress'];
// new start

if ( strlen($a) <= 2) {
echo 'error';
exit;
}



 	if (!get_magic_quotes_gpc()) {

 		$c = addslashes($c);

 	}
$usercheck = $c;

 $check = mysqli_query($conn,"SELECT username FROM users WHERE username = '$usercheck'") 

or die(mysqli_error());

 $check2 = mysqli_num_rows($check);
 if ($check2 != 0) {

 		die('Sorry, the username '.$c.' is already in use.');

 				}


 // this makes sure both passwords entered match

 	if ($p1 != $p2) {

 		die('Your passwords did not match. ');

 	}



 	// here we encrypt the password and add slashes if needed

 	$p1 = md5($p1);

 	if (!get_magic_quotes_gpc()) {

 		$p1 = addslashes($p1);

 		$c = addslashes($c);

 			}
// Create connection
include 'conn.php';
 
// new end
$sql = "INSERT INTO req (firstname, lastname, username, password, gender, birth, classsection, zno, shouse, email, phno, houseaddress, status)
VALUES ('$a', '$b', '$c', '$p1', '$d', '$birth', '$e', '$f', '$g', '$h', '$i', '$j', 'unseen')";



if (mysqli_query($conn,$sql)) {
    echo "Your Request have been sent successfully. Our team will contact you shortly for confirmation of your account. Stay tuned to your e-mail address and phone. Your account will be verified within 4 or 5 days.";
}

mysqli_close($conn);

?>