<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/animate.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="jquery-1.6.1.min.js" type="text/javascript"></script>

<script type="text/javascript" >
$(document).ready(function()
{
$("#notificationLink").click(function()
{
$("#notificationContainer").fadeToggle(300);
$("#notification_count").fadeOut("slow");
return false;
});

//Document Click
$(document).click(function()
{
$("#notificationContainer").hide();
});
//Popup Click
$("#notificationContainer").click(function()
{
return false
});

});

function mark(){
var input = 1;
$.post('mark.php',{value:input})

}


</script>
<style>

#nav{list-style:none;margin: 0px;
padding: 0px;}
#nav li {
float: left;
margin-right: 20px;
font-size: 14px;
font-weight:bold;
}
#nav li a{color:#333333;text-decoration:none}
#nav li a:hover{color:#006699;text-decoration:none}
#notification_li{position:relative}
#notificationContainer {
background-color: #fff;
border: 1px solid rgba(100, 100, 100, .4);
-webkit-box-shadow: 0 3px 8px rgba(0, 0, 0, .25);
overflow: visible;
position: absolute;
top: 30px;
margin-left: -170px;
width: 400px;
z-index: -1;
display: none;
}
#notificationContainer:before {
content: '';
display: block;
position: absolute;
width: 0;
height: 0;
color: transparent;
border: 10px solid black;
border-color: transparent transparent white;
margin-top: -20px;
margin-left: 188px;
}
#notificationTitle {
z-index: 1000;
font-weight: bold;
padding: 8px;
font-size: 13px;
background-color: #ffffff;
width: 384px;
border-bottom: 1px solid #dddddd;
}
#notificationsBody {
padding: 33px 0px 0px 0px !important;
min-height:50px;
}
#notificationFooter {
background-color: #e9eaed;
text-align: center;
font-weight: bold;
padding: 8px;
font-size: 12px;
border-top: 1px solid #dddddd;
}
#notification_count {
padding: 3px 7px 3px 7px;
background: #cc0000;
color: #ffffff;
font-weight: bold;
margin-left: 77px;
border-radius: 9px;
position: absolute;
margin-top: -11px;
font-size: 11px;
}

</style>
</head>


<div style="width:900px margin:0 auto; width:900px; position:absolute; left:200px; top:120px; z-index:34">
<ul id="nav">
<li id="notification_li">

<?php
include 'conn.php';

$username = $_COOKIE['User_id_ZKITS'];
$sql1=mysqli_query($conn,"SELECT id FROM `notifications` where subject_id ='$username' and status = 'unseen' ");
$row = mysqli_num_rows($sql1);
if ($row != 0 ) {
?>


<span id="notification_count">
<?php
echo $row;
?>
</span><?php } ?>
<a href="#" id="notificationLink" onClick="mark()">Notifications</a>
<div id="notificationContainer">
<div id="notificationTitle">Notifications</div>
<div id="notificationsBody" class="notifications">
<?php
$sql2=mysqli_query($conn,"SELECT `actor_id`, `object_id`, `type_id`, `created_date` FROM `notifications` where subject_id ='$username' ORDER BY created_date DESC LIMIT 0, 15");
while($row1 = mysqli_fetch_assoc($sql2)) { 
$actor = $row1['actor_id'];

$sql1=mysqli_query($conn,"SELECT `username` FROM `users` where user_id ='$actor' ");
$element = mysqli_fetch_assoc($sql1);
?>
<a onClick="window.location.href = 'comment.php?post=<?php echo $row1['object_id'];?>';"><?php echo $element['username']." ";if ( $row1['type_id'] == 1 ) {echo 'commented on your post';} ?></a><br><br>
<?php

}
?>
</div>
</div>

</li>
</ul>

</div>

</html>
