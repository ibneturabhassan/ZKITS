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
////// insert and refresh
$gname = $_POST['gname'];
$type = $_POST['type'];



$checkstr = strlen($gname) ;
if ( $checkstr == 0 ) {
echo "<script> alert('Please fill out the field');
window.location.href = 'cgroup.php'; </script>";
exit;}


// Create connection





include 'conn.php';

// Check connection
// new end
$sql = "INSERT INTO groups (group_name, type)
VALUES ('$gname', '$type')";

if (mysqli_query($conn,$sql)) {
    echo "<script> alert('Status updated on your wall successfully');
	window.location.href = 'cgroup.php'; </script>";
}

mysqli_close($conn);


} else {
	
// layout elements
include '_inc/header.php'; 
include '_inc/left.php';
include 'loadbar.php';
?>
<td rowspan="2" valign=top width=50%>
<title>Create group</title>


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


#abt-search-box {
    background: none repeat scroll 0 0 #EEEEEE;
    border: 0 none;
    padding: 10px;
    width: 400px;
}              
</style>




<form method=post action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
<table width=100% border=0>
<tr>
<td colspan=2>
<input id="abt-search-box" type="text" name="gname" placeholder="Group Name" required >

</td>

<tr>
<td>
<select id="abt-search-box" name="type" required>
<option value="All">All</option>
<?php
$user = $_COOKIE['ID_my_site'];
$sql = mysqli_query($conn,"select gender from users where username = '$user'");
$row=mysqli_fetch_array($sql);
$type = $row['gender'];

if ($type == 'Male') { echo "<option value='Male'>Boys only</option>"; }
if ($type == 'Female') { echo "<option value='Female'>Girls only</option>"; }

?>
</select>
</td>
</tr>


</tr>

<tr>

<td style="text-align: right;"><input class="button-8" type=submit name=submit value="Create">
</td>
</tr>

</table>
</form>







</td>
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
