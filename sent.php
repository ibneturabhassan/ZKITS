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
			
			


	
// layout elements
include 'flib.php';
include '_inc/header.php'; 
include '_inc/msgleft.php';

?>

<td rowspan="2" valign=top width=50%>
<?php
$user = $_COOKIE['User_id_ZKITS'];
$sql=mysqli_query($conn,"SELECT * FROM `msg` where sender_id ='$user' AND del_sender = 'not' ");
while ( $row = mysqli_fetch_assoc($sql)){

$rec = $row['rec_id'];

$sql1=mysqli_query($conn,"SELECT `firstname`, `lastname`, `username`, `profile_image` FROM `users` where user_id ='$rec' ");
$row1=mysqli_fetch_assoc($sql1);


?>
<script src="jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">

function sent(x)
{
var id = x;
	$.post('del_sent.php',{msg_id:id});
	window.location.href = 'sent.php';
};


</script>



<table width=98% style="margin: 10px; background-color: #9ec9ff;">
<TR valign=bottom>

<TD rowspan=2 width=75px><a href="wallpost.php"><img src="uploads/<?php echo $row1['profile_image'];?>" style="width:75px;height:75px;border:0"></a></TD>

<TD><font style="font-size:25px"><b><?php echo $row1['username'];?></b> <?php echo $row1['firstname']." ".$row1['lastname'];?></font></TD>
</TR>


<TR valign=top>
<TD>
<font style="font-size:14px" color="#808080">
<?php echo dateDiff($row['dated']); if ( $row['status'] != 'unseen' ){
echo ' - Seen';
} ?></font></TD>
</TR>

<TR valign=top>
<TD colspan=2><font style="font-size:18px"><?php echo $row['msg']; ?></font></TD>
</TR>

<TR valign=top>
<TD colspan=2><a href="#" onClick="sent(<?php echo $row['msg_id']?>)">Delete</a></TD>
</TR>

</table>
<?php
}
?>


</td>
</html>
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
