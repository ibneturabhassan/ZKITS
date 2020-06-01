<?php
function dateDiff($date)
{
  date_default_timezone_set("Asia/Karachi");
  $mydate= date("Y-m-d H:i:s");
  $theDiff="";
  //echo $mydate;//2014-06-06 21:35:55
  $datetime1 = date_create($date);
  $datetime2 = date_create($mydate);
  $interval = date_diff($datetime1, $datetime2);
  //echo $interval->format('%s Seconds %i Minutes %h Hours %d days %m Months %y Year    Ago')."<br>";
  $min=$interval->format('%i');
  $sec=$interval->format('%s');
  $hour=$interval->format('%h');
  $mon=$interval->format('%m');
  $day=$interval->format('%d');
  $year=$interval->format('%y');
  if($interval->format('%i%h%d%m%y')=="00000")
  {
    if ($day == 1) {return $sec." Second ago";} else {
    return $sec." Seconds ago";}

  } 

else if($interval->format('%h%d%m%y')=="0000"){
if ($day == 1) {return $min." Minute ago";} else {
   return $min." Minutes ago";}
   }


else if($interval->format('%d%m%y')=="000"){
if ($day == 1) {return $hour." Hours ago";} else {
   return $hour." Hours ago";}
   }


else if($interval->format('%m%y')=="00"){
     if ($day == 1) {return $day." Day ago";} 
else {
   return $day." Days ago";}  
 }

else if($interval->format('%y')=="0"){
if ($day == 1) {return $mon." Months ago";} else {
   return $mon." Months ago";}
   }

else{
if ($day == 1) {return $year." Years ago";} else {
   return $year." Years ago";}
   }

}

?>