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
$svar = $_POST['key'];
$search = mysqli_query($conn,"SELECT user_id, username, firstname, lastname, gender, profile_image FROM users WHERE username LIKE '%$svar%' OR firstname LIKE '%$svar%' OR lastname LIKE '%$svar%' ");
if (mysqli_num_rows($search) <= 0) {
 die("Sorry, we couldn't find any results for this search.");
}
include '_inc/header.php'; 
include '_inc/left.php';
?> <td rowspan="2" valign=top width=50%>
<?php
while($row = mysqli_fetch_assoc($search)) { 
?>

<a href=profile.php?id=<?php echo $row['user_id'];?> ><TABLE border=0 width=95% style="margin: 10px; background-color: #9ec9ff;">
<TR valign=middle>
<TD rowspan=2 style="width:150px; height;150px">
<div><img src=uploads\<?php echo $row['profile_image']; ?> style="width:150px;height:150px"></div>
</TD>
<TD>
<div style="font-size: 30px;"><?php echo $row['firstname']."&nbsp;".$row['lastname']; ?>   </br><b><?php echo $row['username']; ?></b></div>
</TD>
</TR>
<TR valign=top>
<TD colspan=2>
<div><?php echo $row['gender']."&nbsp"; ?>

<?php
$name = $row['user_id'];
$getelement = mysqli_query($conn,"SELECT classsection, sportshouse FROM profile WHERE user_id = '$name'");
 
 while ($row4 = mysqli_fetch_assoc($getelement)){
 echo "&nbsp".$row4['classsection']."&nbsp&nbsp".$row4['sportshouse'];
 }
?>

</div>
</TD>
</TR>
</TABLE></a>


<?php
}
?></td></center><?php
include '_inc/right.php';
}else{	
// layout elements
include '_inc/header.php'; 
include '_inc/left.php';
?>
<html>
<td rowspan="2" valign=top width=50%>
<center>

<style>

#abt-search-box {
    background: none repeat scroll 0 0 #EEEEEE;
    border: 0 none;
    padding: 10px;
    width: 400px;
}
</style>
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

<form name='search' method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<input id="abt-search-box" type=text name=key placeholder="   Search...">
<input class="button-8" type=submit name=submit value=Search>
</form>

</center>



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