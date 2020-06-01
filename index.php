<?php


$user_agent     =   $_SERVER['HTTP_USER_AGENT'];

function getOS() {

global $user_agent;

$os_platform    =   "Unknown OS Platform";

$os_array       =   array(
                        '/windows nt 6.2/i'     =>  'Windows 8',
                        '/windows nt 6.1/i'     =>  'Windows 7',
                        '/windows nt 6.0/i'     =>  'Windows Vista',
                        '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                        '/windows nt 5.1/i'     =>  'Windows XP',
                        '/windows xp/i'         =>  'Windows XP',
                        '/windows nt 5.0/i'     =>  'Windows 2000',
                        '/windows me/i'         =>  'Windows ME',
                        '/win98/i'              =>  'Windows 98',
                        '/win95/i'              =>  'Windows 95',
                        '/win16/i'              =>  'Windows 3.11',
                        '/macintosh|mac os x/i' =>  'Mac OS X',
                        '/mac_powerpc/i'        =>  'Mac OS 9',
                        '/linux/i'              =>  'Linux',
                        '/ubuntu/i'             =>  'Ubuntu',
                        '/iphone/i'             =>  'iPhone',
                        '/ipod/i'               =>  'iPod',
                        '/ipad/i'               =>  'iPad',
                        '/android/i'            =>  'Android',
                        '/blackberry/i'         =>  'BlackBerry',
                        '/webos/i'              =>  'Mobile'
                     );

foreach ($os_array as $regex => $value) {

 if (preg_match($regex, $user_agent)) {
    $os_platform    =   $value;
 }

}

return $os_platform;

}

function getBrowser() {

global $user_agent;

$browser        =   "Unknown Browser";

$browser_array  =   array(
                         '/msie/i'       =>  'Internet Explorer',
                         '/firefox/i'    =>  'Firefox',
                         '/safari/i'     =>  'Safari',
                         '/chrome/i'     =>  'Chrome',
                         '/opera/i'      =>  'Opera',
                         '/netscape/i'   =>  'Netscape',
                         '/maxthon/i'    =>  'Maxthon',
                         '/konqueror/i'  =>  'Konqueror',
                         '/mobile/i'     =>  'Handheld Browser'
                   );

foreach ($browser_array as $regex => $value) {

  if (preg_match($regex, $user_agent)) {
     $browser    =   $value;
  }

}

return $browser;

}

$user_os        =   getOS();
$user_browser   =   getBrowser();


$device_details =   "<strong>Browser: </strong>".$user_browser."<br /><strong>Operating System: </strong>".$user_os."";

print_r($device_details);

date_default_timezone_set("Asia/Karachi");

$x=date("d-m-y") ;
$u= date("h:i:sa");
$ip = $_SERVER['REMOTE_ADDR']; 
$f = fopen("iplog.html", "a"); 
fwrite ($f, '<br>[<b><font color="00FF33">IP:</font><font color="00FF33">'.$ip.'</font></b>] [<b><font color="00FF33">Browser:</font><font color="00FF33">'.$user_browser.'</font></b>] [<b><font color="00FF33">OS:</font><font color="00FF33">'.$user_os.'</font></b>] [<b><font color="00FF33">Date:</font><font color="00FF33">'.$x.'</font></b>] [<b><font color="00FF33">Time:</font><font color="00FF33">'.$u.'</font></b>]</br>');
fclose($f);

header("Location: login.php"); 
?>