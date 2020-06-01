<?php include_once("analyticstracking.php") ?>


<?php 

 $past = time() - 100; 

 //this makes the time in the past to destroy the cookie 

 setcookie(ID_my_site, gone, $past); 

 setcookie(Key_my_site, gone, $past); 
 
 setcookie(User_id_ZKITS, gone, $past); 

 header("Location: login.php"); 

 ?> 
