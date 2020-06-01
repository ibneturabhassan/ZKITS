<?php
$uid=$_COOKIE['User_id_ZKITS'] ;
include("conn.php");
$userid= $friend;

$follow_check="select * from follow_user WHERE uid_fk='$uid' and user_id='$userid' ";
$user_sql=mysqli_query($conn,$follow_check);
$count=mysqli_num_rows($user_sql);
?>

	<head>
        <script type="text/javascript" src="jquery.min.js"></script>
        <script type="text/javascript" src="follow.js"></script>
        <link rel="stylesheet" type="text/css" href="css\style4.css" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<style>

             .second_button::before {
	            content:"<?php echo $count; ?>";
            }			
	    </style>
	</head>
    <body>
        <div class="container">
            <section>
                    <p>
<?php					
if($count==0)
{ ?>
<div id='follow<?php echo $userid;?>'><a href='' class="follow a_demo_three second_button" id='<?php echo $userid;?>'>Follow</a></div>
<div id='remove<?php echo $userid;?>' style='display:none'><a href='' class="remove a_demo_three second_button" id='<?php echo $userid;?>'>Following</a></div>
<?php } 
else
{ ?>
<div id='follow<?php echo$userid;?>' style='display:none'><a href='' class="follow a_demo_three second_button" id='<?php echo $userid;?>'>Follow</a></div>
<div id='remove<?php echo$userid;?>'><a href='' class="remove a_demo_three second_button" id='<?php echo $userid;?>'>Following</a></div>
<?php } ?>
                    </p>
			</section>
        </div>
    </body>