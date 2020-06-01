<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />

        <link type="text/css" rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="jquery.min.js"></script>


    </head>
 
    <body>
        

    <?php
    include 'config.php';
	$cookie_name='User_id_ZKITS';
    $user_ip = $_COOKIE[$cookie_name];
    $pageID = $_GET['post']; // The ID of the page, the article or the video ...

    //function to calculate the percent
    function percent($num_amount, $num_total) {
        $count1 = $num_amount / $num_total;
        $count2 = $count1 * 100;
        $count = number_format($count2, 0);
        return $count;
    }

    // check if the user has already clicked on the unlike (rate = 2) or the like (rate = 1)
        $dislike_sql = mysqli_query($conn,'SELECT COUNT(*) FROM  wcd_yt_rate WHERE ip = "'.$user_ip.'" and id_item = "'.$pageID.'" and rate = 2 ');
        $dislike_count = mysql_result($dislike_sql, 0); 

        $like_sql = mysqli_query($conn,'SELECT COUNT(*) FROM  wcd_yt_rate WHERE ip = "'.$user_ip.'" and id_item = "'.$pageID.'" and rate = 1 ');
        $like_count = mysql_result($like_sql, 0);  

        // count all the rate 
        $rate_all_count = mysqli_query($conn,'SELECT COUNT(*) FROM  wcd_yt_rate WHERE id_item = "'.$pageID.'"');
        $rate_all_count = mysql_result($rate_all_count, 0);  

        $rate_like_count = mysqli_query($conn,'SELECT COUNT(*) FROM  wcd_yt_rate WHERE id_item = "'.$pageID.'" and rate = 1');
        $rate_like_count = mysql_result($rate_like_count, 0);  
        $rate_like_percent = percent($rate_like_count, $rate_all_count);

        $rate_dislike_count = mysqli_query($conn,'SELECT COUNT(*) FROM  wcd_yt_rate WHERE id_item = "'.$pageID.'" and rate = 2');
        $rate_dislike_count = mysql_result($rate_dislike_count, 0);  
        $rate_dislike_percent = percent($rate_dislike_count, $rate_all_count);
?>

<script>
    $(function(){ 
        var pageID = <?php echo $pageID;  ?>; 

        $('.like-btn').click(function(){
            $('.dislike-btn').removeClass('dislike-h');    
            $(this).addClass('like-h');
            $.ajax({
                type:"POST",
                url:"ajax.php",
                data:'act=like&pageID='+pageID,
                success: function(){
                }
            });
        });
        $('.dislike-btn').click(function(){
            $('.like-btn').removeClass('like-h');
            $(this).addClass('dislike-h');
            $.ajax({
                type:"POST",
                url:"ajax.php",
                data:'act=dislike&pageID='+pageID,
                success: function(){
                }
            });
        });
        $('.share-btn').click(function(){
            $('.share-cnt').toggle();
        });
    });
</script>



    <div class="tab-cnt">
        
        <div class="tab-tr" id="t1">
            <div class="like-btn <?php if($like_count == 1){ echo 'like-h';} ?>">Like</div>
            <div class="dislike-btn <?php if($dislike_count == 1){ echo 'dislike-h';} ?>"></div>



            <div class="stat-cnt">
                <div class="rate-count"><?php echo $rate_all_count; ?></div>
                <div class="stat-bar">
                    <div class="bg-green" style="width:<?php echo $rate_like_percent; ?>%;"></div>
                    <div class="bg-red" style="width:<?php echo $rate_dislike_percent; ?>%"></div>
                </div><!-- stat-bar -->
                <div class="dislike-count"><?php echo $rate_dislike_count; ?></div>
                <div class="like-count"><?php echo $rate_like_count; ?></div>
            </div><!-- /stat-cnt -->
        </div><!-- /tab-tr -->
        <div class="share-cnt">

            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style ">
            <a class="addthis_button_linkedin_counter"></a>
            <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
            <a class="addthis_button_tweet"></a>
            <a class="addthis_button_google_plusone" g:plusone:size="medium"></a> 
            <a class="addthis_button_pinterest_pinit"></a>
            <a class="addthis_counter addthis_pill_style"></a>
            </div>
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5174d2b853d85895"></script>
            <!-- AddThis Button END -->

        </div><!-- /share-cnt -->


    </div><!-- /tuto-cnt -->


     


</body>
</html>