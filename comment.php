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


include 'flib.php';
include("conn.php");
include '_inc/header.php'; 
include '_inc/left.php';
?><td rowspan="2" valign=top width=50%><?php
error_reporting(E_ERROR | E_PARSE);
$pid = $_GET['post'];
//// check value of pid
$sql1=mysqli_query($conn,"SELECT `post` FROM `posts` where pid ='$pid' ");
$row1=mysqli_num_rows($sql1);
if ($row1 == 0) { echo "<h1>The page you requested was not found</h1><br><p>You may have clicked an expired link or mistyped the address</p>" ; exit;}

///// checking permission
$sql1=mysqli_query($conn,"SELECT location FROM `posts` where pid ='$pid' ");
$row1=mysqli_fetch_array($sql1);
$location = $row1['location'];
$sql1=mysqli_query("SELECT * FROM `groups` where group_name ='$location' ");

if ( mysqli_num_rows($sql1) != 0 ) {
$sql1=mysqli_query($conn,"SELECT type FROM `groups` where group_name ='$location' ");
$row1=mysqli_fetch_array($sql1);

$user = $_COOKIE['ID_my_site'];
$sql = mysqli_query($conn,"select gender from users where username = '$user'");
$row=mysqli_fetch_array($sql); 

if ( $row1['type'] != 'All') {
if ( $row1['type'] != $row['gender']){ echo "<center><h1>Access Denied...!!</h1></center>"; include '_inc/right.php'; exit; }

}

} 



////// displaying post
$sql = mysqli_query($conn,"SELECT user_id, location, post, date FROM `posts` WHERE `pid` = $pid LIMIT 0, 30 ");
$row=mysqli_fetch_array($sql);

$name = $row['user_id'];
$location = $row['location'];
$post = $row['post'];
$date = $row['date'];

$getelement = mysqli_query($conn,"SELECT firstname, lastname, username, profile_image FROM users WHERE user_id = '$name'");
$getelement2 = mysqli_query($conn,"SELECT classsection FROM profile WHERE user_id = '$name'");
$row3 = mysqli_fetch_array($getelement);
$row4 = mysqli_fetch_assoc($getelement2);



?>

<table width=98% border=0 style="margin: 10px; background-color: #9ec9ff;" >
<tr>
<td rowspan=2 width=85px><img src=<?php if ($location == "confession") {echo'./images/confession.png';} else {echo'./uploads/'.$row3['profile_image'];} ?>  style="width:75px; height:75px;"></td>
<td valign=bottom>
<?php 
if ( $location == "confession") {
$getelement4 = mysqli_query($conn,"SELECT gender FROM users WHERE user_id = '$name'");
$row4 = mysqli_fetch_assoc($getelement4);
if ($row4['gender'] == 'Male' ) { echo "#Boy<br>";} else {echo "#Girl<br>";}
} else {

echo $row3['firstname']."&nbsp".$row3['lastname']."&nbsp&nbsp<b>".$row3['username'];
}

?>
</td>
</tr>
<tr>
<td valign=top><?php echo dateDiff($date);?> </td>
</tr>
<tr>
<td colspan=2 style="padding:10px"><?php echo nl2br(preg_replace('/<[^<]+?>/', ' ', $post) ) ;?></td>
</tr>
</table>

<?php
////// like bar
include 'like.php';

//// displaying comments
$sql=mysqli_query($conn,"SELECT `name`, `comment`, `datetime` FROM `comment` where pid ='$pid' ");

while ( $row=mysqli_fetch_assoc($sql) ) {
$userid = $row['name'] ;
$sql1=mysqli_query($conn,"SELECT `firstname`, `profile_image` FROM `users` where user_id ='$userid' ");
$row1=mysqli_fetch_assoc($sql1);?>

<table width=98% border=0 style="margin: 10px; background-color: #9ec9ff;">
<tr>
<td width="50px"><img src=uploads\<?php echo $row1['profile_image']; ?> style="width:50px;height:50px"></td>
<td valign=top><a href="./profile.php?id=<?php echo $userid; ?>"><?php echo $row1['firstname']; ?></a>
<?php echo nl2br(preg_replace('/<[^<]+?>/', ' ', $row['comment']) ) ;?></td>
</tr>
<tr>
<td colspan=2><?php echo dateDiff($row['datetime']);?></td>
</tr>
</table>
<?php
}


?>
<html>
<head>
</head>
<script src="jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">

function get()
{

if (document.frm.cmt.value == "") {
                alert("You cannot post empty comments");
                return false;
            }
    var input= $('#cmt').val();
	var pid= <?php echo $pid ;?>;
	$.post('add_cmt.php',{comment:input,postid:pid},function(output){
	$('#an').slideDown('slow').prepend(output+'<br />').hide().fadeIn('slow')});
};


</script>

<style>
body {
    background-color: #b3d1f2;
}
#abt-search-btn {
    background: none repeat scroll 0 0 #00bfff;
    border: 1;
    border-radius: 0 0 0 0;
    color: #FFFFFF;
    font-weight: 700;
    padding: 10px 20px;
}
#cmt {
    background: none repeat scroll 0 0 #EEEEEE;
    border-color: #bfbfbf;
    border-style: solid;
    border-width: 1px;
    padding: 10px;
    width: 400px;
}
</style>

<body>

<div id="an" style="width;98%">

</div>
<br>
<form name="frm">
   <input type="text" name="cmt" id="cmt"  onKeydown="Javascript: if (event.keyCode==13) get();">
   
   <button id="abt-search-btn" type="button" onClick="get()">Comment</button>
</form>
</body>
</html>
</td>
<?php include '_inc/right.php';




 			} 

 		} 

 		} 

 else 

 

 //if the cookie does not exist, they are taken to the login screen 

 {			 

 header("Location: login.php"); 

 } 

 ?> 