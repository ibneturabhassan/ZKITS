<?php
	include 'conn.php';
	
	extract($_POST);
	$cookie_name='User_id_ZKITS';
	$user_ip = $_COOKIE[$cookie_name];

	// check if the user has already clicked on the unlike (rate = 2) or the like (rate = 1)
		$dislike_sql = mysqli_query($conn,'SELECT COUNT(*) FROM  wcd_yt_rate WHERE ip = "'.$user_ip.'" and id_item = "'.$pageID.'" and rate = 2 ');
		$dislike_count = mysqli_result($dislike_sql, 0); 

		$like_sql = mysqli_query($conn,'SELECT COUNT(*) FROM  wcd_yt_rate WHERE ip = "'.$user_ip.'" and id_item = "'.$pageID.'" and rate = 1 ');
		$like_count = mysqli_result($like_sql, 0); 

	if($act == 'like'): //if the user click on "like"
		if(($like_count == 0) && ($dislike_count == 0)){
			mysqli_query($conn,'INSERT INTO wcd_yt_rate (id_item, ip, rate )VALUES("'.$pageID.'", "'.$user_ip.'", "1")');
		}
		if($dislike_count == 1){
			mysqli_query($conn,'UPDATE wcd_yt_rate SET rate = 1 WHERE id_item = '.$pageID.' and ip ="'.$user_ip.'"');
		}

	endif;
	if($act == 'dislike'): //if the user click on "like"
		if(($like_count == 0) && ($dislike_count == 0)){
			mysqli_query($conn,'INSERT INTO wcd_yt_rate (id_item, ip, rate )VALUES("'.$pageID.'", "'.$user_ip.'", "2")');
		}
		if($like_count == 1){
			mysqli_query($conn,'UPDATE wcd_yt_rate SET rate = 2 WHERE id_item = '.$pageID.' and ip ="'.$user_ip.'"');
		}

	endif;
?>