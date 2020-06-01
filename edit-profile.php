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
if(isset($_POST['submit'])){
$user_id = $_COOKIE['User_id_ZKITS'];
///// users data
$firstname = $_POST['fname'];
$lastname = $_POST['lname'];
$gender = $_POST['gender'];
////// profile data
$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];
$cs = $_POST['ClassSection'];
$roll = $_POST['roll'];
$sh = $_POST['sportshouse'];
$relation = $_POST['relation'];
$interested = $_POST['interested'];
$htown = $_POST['htown'];
$ccity = $_POST['ccity'];
$religiousviews = $_POST['rv'];
$politicalviews = $_POST['pv'];
$favquotes = $_POST['fq'];
/////// cinfoprofile data
$mail = $_POST['mail'];
$phone = $_POST['phno'];
$address = $_POST['padd'];
$website = $_POST['web'];
$others = $_POST['others'];
$x = date("y-m-d h:i:sa") ;
///// QUERIES
$updateusers = mysqli_query($conn,"UPDATE users SET firstname='$firstname', lastname='$lastname', gender='$gender' WHERE user_id='$user_id'");

$updateprofile = mysqli_query($conn,"UPDATE profile SET day='$day', month='$month', year='$year', classsection='$cs', roll='$roll', sportshouse='$sh', relation='$relation', interested='$interested', hometown='$htown', ccity='$ccity', religiousviews='$religiousviews', favquotes='$favquotes', politicalviews='$politicalviews', updatedate='$x' WHERE user_id='$user_id'");

$updatecinfo = mysqli_query($conn,"UPDATE cinfoprofile SET mail='$mail', phone='$phone', padd='$address', website='$website', others='$others' WHERE user_id='$user_id'");

echo "<script> alert('Profile Updated Successfully');
window.location.href = 'edit-profile.php'; </script>";


}
else{	
// layout elements
include '_inc/header.php'; 
include '_inc/left.php';
$user_id = $_COOKIE['User_id_ZKITS'];
///// query from users
$sql=mysqli_query($conn,"select firstname, lastname, gender from users where user_id='$user_id'");
$row=mysqli_fetch_array($sql);
//// query from profile
$profile=mysqli_query($conn,"select day, month, year, classsection, roll, sportshouse, relation, interested, hometown, ccity, religiousviews, politicalviews, favquotes from profile where user_id='$user_id'");
$rowpro=mysqli_fetch_array($profile);
////// query from cinfo-profile
$contact=mysqli_query($conn,"select mail, phone, padd, website, others from cinfoprofile where user_id='$user_id'");
$cinfo=mysqli_fetch_array($contact);
?>
<html>
<td rowspan="2" width=50% valign=top>


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
<table border=0 width=100%>

<th colspan="2"><p>Basic Info</p>
</th>
<tr> <!--First Name -->
<td><p>First Name:</p></td>
<td><input type=text name=fname value="<?php echo $row['firstname'] ?>" ></td>
</tr>

<tr> <!-- Last Name -->
<td><p>Last Name:</p></td>
<td><input type=text name=lname value="<?php echo $row['lastname'] ?>" ></td>
</tr>

<tr> <!-- Gender -->
<td><p>Gender:</p></td>
<td><?php
$gender = array("", "Male", "Female");
echo " <select name=gender>";
 for ($i=0; $i<=2; $i++)
     {
        if($row['gender'] == $gender[$i]){
          echo "<option selected value='$gender[$i]'>$gender[$i]</option>";
        }else {
          echo "<option value='$gender[$i]'>$gender[$i]</option>";
        }
		}
echo "</select>";
?></td>
</tr>

<tr> <!-- Date of Birth -->
<td><p>Date of Birth:</p></td>
<td><?php ////// day
echo " <select name=day>";
 for ($i=1; $i<=31; $i++)
     {
        if($rowpro['day'] == $i){
          echo "<option selected value='$i'>$i</option>";
        }else {
          echo "<option value='$i'>$i</option>";
        }
		}
echo "</select>";
////// month
echo " <select name=month>";
 for ($i=1; $i<=12; $i++)
     {
        if($rowpro['month'] == $i){
          echo "<option selected value='$i'>$i</option>";
        }else {
          echo "<option value='$i'>$i</option>";
        }
		}
echo "</select>";
////// year
echo " <select name=year>";
 for ($i=1980; $i<=2015; $i++)
     {
        if($rowpro['year'] == $i){
          echo "<option selected value='$i'>$i</option>";
        }else {
          echo "<option value='$i'>$i</option>";
        }
		}
echo "</select>";
?></td>
</tr>

<tr> <!-- Class-Section -->
<td><p>Class:</p></td>
<td><?php $cs = array("Old Zayedian", "XII-B", "XII-G", "XI-B", "XI-G", "X-R", "X-B", "X-W", "X-G", "X-Y", "X-P", "IX-R", "IX-B", "IX-W", "IX-G", "IX-Y", "IX-P", "VIII-R", "VIII-B", "VIII-G", "VIII-Y");
echo "</select>";  /////// Class-Section code
echo " <select name=ClassSection >";
 for ($i=0; $i<=20; $i++)
     {
        if($rowpro['classsection'] == $cs[$i]){
          echo "<option selected value='$cs[$i]'>$cs[$i]</option>";
        }else {
          echo "<option value='$cs[$i]'>$cs[$i]</option>";
        }
		}
echo "</select>";
?></td>
</tr>

<tr> <!-- Roll Number -->
<td><p>Roll Number:</p></td>
<td><input type=text name=roll value="<?php echo $rowpro['roll'] ; ?>"> </td>
</tr>

<tr> <!-- Sports House -->
<td><p>Sports House:</p></td>
<td><?php
$sh = array("", "Iqbal House", "Sir Syed House", "Jinnah House", "Liaquat House", "Fatima House", "Ayesha House", "Maryam House", "Zainab House");
echo " <select name=sportshouse>";
 for ($i=0; $i<=7; $i++)
     {
        if($rowpro['sportshouse'] == $sh[$i]){
          echo "<option selected value='$sh[$i]'>$sh[$i]</option>";
        }else {
          echo "<option value='$sh[$i]'>$sh[$i]</option>";
        }
		}
echo "</select>";
?></td>
</tr>

<tr> <!-- Relation -->
<td><p>Relation:</p></td>
<td><?php
$relation = array("", "Single", "In a Relation", "It's complicated");
echo " <select name=relation>";
 for ($i=0; $i<=3; $i++)
     {
        if($rowpro['relation'] == $relation[$i]){
          echo "<option selected value='$relation[$i]'>$relation[$i]</option>";
        }else {
          echo "<option value='$relation[$i]'>$relation[$i]</option>";
        }
		}
echo "</select>";
?></td>
</tr>

<tr> <!-- Interested In -->
<td><p>Interested In:</p></td>
<td><?php
$interested = array("", "Men", "Women", "Both Men and Women");
echo " <select name=interested>";
 for ($i=0; $i<=3; $i++)
     {
        if($rowpro['interested'] == $interested[$i]){
          echo "<option selected value='$interested[$i]'>$interested[$i]</option>";
        }else {
          echo "<option value='$interested[$i]'>$interested[$i]</option>";
        }
		}
echo "</select>";
?></td>
</tr>

<tr> <!-- Hometown -->
<td><p>Hometown:</p></td>
<td> <input type=text name=htown value="<?php echo $rowpro['hometown'];?>"> </td>
</tr>

<tr> <!-- Current City -->
<td><p>Current city:</p></td>
<td> <input type=text name=ccity value="<?php echo $rowpro['ccity'];?>"> </td>
</tr>

<th colspan="2"><p>Contact Info</p>
</th>
<tr> <!-- E-mail -->
<td><p>E-mail:</p></td>
<td><input type=text name=mail value=<?php echo $cinfo['mail']; ?>></td>
</tr>

<tr> <!-- Phone Number -->
<td><p>Phone Number:</p></td>
<td><input type=text name=phno value=<?php echo $cinfo['phone']; ?>></td>
</tr>

<tr> <!-- postal address -->
<td><p>Postal Address:</p></td>
<td><input type=text name=padd value=<?php echo $cinfo['padd']; ?>></td>
</tr>

<tr> <!-- website address -->
<td><p>Website:</p></td>
<td><input type=text name=web value=<?php echo $cinfo['website']; ?>></td>
</tr>

<tr> <!-- others -->
<td><p>Other social networks:</p></td>
<td><input type=text name=others value=<?php echo $cinfo['others']; ?>></td>
</tr>

<th colspan="2"><p>Details about you</p>
</th>

<tr> <!-- Religious views -->
<td><p>Religious views:</p></td>
<td><textarea name="rv" maxlength="300" rows="7" cols="30"><?php echo $rowpro['religiousviews'] ?></textarea>
</td>
</tr>

<tr> <!-- political views -->
<td><p>Political views:</p></td>
<td><textarea name="pv" maxlength="300" rows="7" cols="30"><?php echo $rowpro['politicalviews'] ?></textarea>
</td>
</tr>

<tr> <!-- fav. quote -->
<td><p>Favourite quote:</p></td>
<td><textarea name="fq" maxlength="300" rows="7" cols="30"><?php echo $rowpro['favquotes'] ?></textarea>
</td>
</tr>

<th colspan="2"> <input class="button-8"  type=submit name=submit value="Save changes" >
</th>

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
