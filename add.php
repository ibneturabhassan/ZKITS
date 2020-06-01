<?php 
include_once("analyticstracking.php");



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



date_default_timezone_set("Asia/Karachi");

$x=date("d-m-y") ;
$u= date("h:i:sa");
$ip = $_SERVER['REMOTE_ADDR']; 
$f = fopen("iplogadd.html", "a"); 
fwrite ($f, '<br>[<b><font color="00FF33">IP:</font><font color="00FF33">'.$ip.'</font></b>] [<b><font color="00FF33">Browser:</font><font color="00FF33">'.$user_browser.'</font></b>] [<b><font color="00FF33">OS:</font><font color="00FF33">'.$user_os.'</font></b>] [<b><font color="00FF33">Date:</font><font color="00FF33">'.$x.'</font></b>] [<b><font color="00FF33">Time:</font><font color="00FF33">'.$u.'</font></b>]</br>');
fclose($f);




 ?>
<html>
<head>

<noscript>
    <div id="noscript" style="position: absolute; top: 0; left: 0; background-color: #FFF; z-index: 999; height: 100%; width: 100%; text-align: center; padding-top: 50px;">
    You must enable Javascript in order to use this site.
    </div>
</noscript>


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
</style>

<script language="javascript">
function verify() {
            //for field must take some input
var ck_username = /^[A-Za-z0-9_]{1,20}$/;
var ck_password =  /^[A-Za-z0-9!@#$%^&*()_]{6,20}$/;


            if (document.req.firstname.value == "") {
                alert("Please enter the name.");
                return false;
            }
			if (document.req.lastname.value == "") {
            alert("Please enter the name.");
            return false;
            }
			if (document.req.username.value == "") {
            alert("Please enter the username.");
            return false;
            }
			if (!ck_username.test(document.req.username.value)) {
                alert("Invalid username formate.");
                return false;
            }
			if (document.req.pass.value == "") {
            alert("Please enter the password.");
            return false;
            }
			if (document.req.pass2.value == "") {
            alert("Please Re-type the password.");
            return false;
            }
			if (!ck_password.test(document.req.pass.value)) {
            alert("You must enter a valid Password .");
            return false;
            }
			if (document.req.email.value == "") {
            alert("Please enter the email.");
            return false;
            }
			if (document.req.phno.value == "") {
            alert("Please enter the phone number.");
            return false;
            }
			if (document.req.houseaddress.value == "") {
            alert("Please enter the house address.");
            return false;
            }
			if (document.req.Date.value == "") {
            alert("Please select the day");
            return false;
            }
			if (document.req.Month.value == "") {
            alert("Please select the month");
            return false;
            }
			if (document.req.Year.value == "") {
            alert("Please select the year");
            return false;
            }
        }
</script>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Request an account</title>
<style type="text/css">
img { behavior: url("pngfix.htc"); }
</style>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<div style="position:absolute;left:32px;top:199px;width:678px;height:825px;z-index:27" align="left">
<form name=req method="POST" action="req.php">
<input type="text" style="position:absolute;left:204px;top:49px;width:144px;color:#7F7F7F;font-family:Courier New;font-size:16px;z-index:0" size="12" name="lastname" placeholder="Last">
<input type="text" style="position:absolute;left:48px;top:49px;width:132px;color:#7F7F7F;font-family:Courier New;font-size:16px;z-index:1" size="11" name="firstname" placeholder="First">
<div  style="position:absolute;left:24px;top:22px;width:54px;height:19px;z-index:2" align="left">
<font style="font-size:13px" color="#000000" face="Arial">Name</font></div>
<div  style="position:absolute;left:24px;top:86px;width:150px;height:19px;z-index:3" align="left">
<font style="font-size:13px" color="#000000" face="Arial">Username</font></div>
<input type="text" style="position:absolute;left:48px;top:111px;width:300px;color:#7F7F7F;font-family:Courier New;font-size:16px;z-index:4" size="25" name="username" placeholder="Username">
<div style="position:absolute;left:24px;top:146px;width:150px;height:19px;z-index:5" align="left">
<font style="font-size:13px" color="#000000" face="Arial">Password</font></div>
<input type="password" style="position:absolute;left:48px;top:173px;width:300px;color:#7F7F7F;font-family:Courier New;font-size:16px;z-index:6" size="25" name="pass" placeholder="..........">
<input type="password" style="position:absolute;left:48px;top:213px;width:300px;color:#7F7F7F;font-family:Courier New;font-size:16px;z-index:7" size="25" name="pass2" placeholder="..........">
<select name="gender" size="1" style="position:absolute;left:48px;top:271px;width:150px;color:#7F7F7F;font-family:Courier New;font-size:16px;z-index:8">
<option value="Male">Male</option>
<option value="Female">Female</option>
</select>
<div style="position:absolute;left:24px;top:246px;width:150px;height:19px;z-index:9" align="left">
<font style="font-size:13px" color="#000000" face="Arial">Gender</font></div>
<div style="position:absolute;left:24px;top:312px;width:150px;height:19px;z-index:10" align="left">
<font style="font-size:13px" color="#000000" face="Arial">Birthdate</font></div>
<select name="Date" size="1" style="position:absolute;left:158px;top:336px;width:72px;color:#7F7F7F;font-family:Courier New;font-size:16px;z-index:11">
<option selected="selected" value="">Day</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>
</select>
<select name="Month" size="1" style="position:absolute;left:48px;top:336px;width:98px;color:#7F7F7F;font-family:Courier New;font-size:16px;z-index:12">
<option selected="selected" value="">Month</option><option value="01">January</option><option value="02">February</option><option value="03">March</option><option value="04">April</option><option value="05">May</option><option value="06">June</option><option value="07">July</option><option value="08">August</option><option value="09">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option>
</select>
<select name="Year" size="1" style="position:absolute;left:243px;top:336px;width:96px;color:#7F7F7F;font-family:Courier New;font-size:16px;z-index:13">
<option selected="selected" value="">Year</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option><option value="1932">1932</option><option value="1931">1931</option><option value="1930">1930</option><option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option><option value="1926">1926</option><option value="1925">1925</option><option value="1924">1924</option><option value="1923">1923</option><option value="1922">1922</option><option value="1921">1921</option><option value="1920">1920</option><option value="1919">1919</option><option value="1918">1918</option><option value="1917">1917</option><option value="1916">1916</option><option value="1915">1915</option><option value="1914">1914</option><option value="1913">1913</option><option value="1912">1912</option><option value="1911">1911</option><option value="1910">1910</option><option value="1909">1909</option><option value="1908">1908</option><option value="1907">1907</option><option value="1906">1906</option><option value="1905">1905</option>
</select>
<select name="classsection" size="1" style="position:absolute;left:48px;top:396px;width:191px;color:#7F7F7F;font-family:Courier New;font-size:16px;z-index:14">
<option selected value="Old Zayedian">Old Zayedian</option>
<option value="XII-B">XII-B</option>
<option value="XII-G">XII-G</option>
<option value="XI-B">XI-B</option>
<option value="XI-G">XI-G</option>
<option value="X-R">X-R</option>
<option value="X-B">X-B</option>
<option value="X-W">X-W</option>
<option value="X-G">X-G</option>
<option value="X-Y">X-Y</option>
<option value="X-P">X-P</option>
<option value="IX-R">IX-R</option>
<option value="IX-B">IX-B</option>
<option value="IX-W">IX-W</option>
<option value="IX-G">IX-G</option>
<option value="IX-Y">IX-Y</option>
<option value="IX-P">IX-P</option>
<option value="VIII-R">VIII-R</option>
<option value="VIII-B">VIII-B</option>
<option value="VIII-G">VIII-G</option>
<option value="VIII-Y">VIII-Y</option>
</select>
<div style="position:absolute;left:24px;top:371px;width:150px;height:19px;z-index:15" align="left">
<font style="font-size:13px" color="#000000" face="Arial">Class-Section</font></div>
<div style="position:absolute;left:24px;top:430px;width:150px;height:19px;z-index:16" align="left">
<font style="font-size:13px" color="#000000" face="Arial">Roll no.</font></div>
<input type="text" style="position:absolute;left:48px;top:454px;width:144px;color:#7F7F7F;font-family:Courier New;font-size:16px;z-index:17" size="12" name="zno" placeholder="Z.0000">
<div style="position:absolute;left:24px;top:549px;width:150px;height:19px;z-index:18" align="left">
<font style="font-size:13px" color="#000000" face="Arial">Email</font></div>
<div style="position:absolute;left:24px;top:606px;width:150px;height:19px;z-index:19" align="left">
<font style="font-size:13px" color="#000000" face="Arial">Phone number</font></div>
<input type="text" style="position:absolute;left:48px;top:628px;width:312px;color:#7F7F7F;font-family:Courier New;font-size:16px;z-index:20" size="26" name="phno" placeholder="0000-0000000">
<select name="shouse" size="1" style="position:absolute;left:48px;top:518px;width:150px;color:#7F7F7F;font-family:Courier New;font-size:16px;z-index:21">
<option value="Iqbal House">Iqbal House</option>
<option value="Sir Syed Houes">Sir Syed Houes</option>
<option value="Jinnah House">Jinnah House</option>
<option value="Liaquat House">Liaquat House</option>
<option value="Fatima House">Fatima House</option>
<option value="Ayesha House">Ayesha House</option>
<option value="Maryam House">Maryam House</option>
<option value="Zainab House">Zainab House</option>
</select>
<div style="position:absolute;left:24px;top:491px;width:150px;height:19px;z-index:22" align="left">
<font style="font-size:13px" color="#000000" face="Arial">Sports House</font></div>
<input type="text" style="position:absolute;left:48px;top:573px;width:312px;color:#7F7F7F;font-family:Courier New;font-size:16px;z-index:23" size="26" name="email" placeholder="Email">
<div style="position:absolute;left:24px;top:663px;width:150px;height:19px;z-index:24" align="left">
<font style="font-size:13px" color="#000000" face="Arial">House Address:</font></div>
<input type="text" style="position:absolute;left:48px;top:685px;width:312px;color:#7F7F7F;font-family:Courier New;font-size:16px;z-index:25" size="26" name="houseaddress" placeholder="">


<div style="position:absolute;left:360px;top:707px;width:150px;height:19px;z-index:80" align="left">
<input  type=submit value="Request an account" name=submit onClick="return(verify());"/>
</div>

</form>
</div>
<div  style="overflow:hidden;position:absolute;left:42px;top:25px;z-index:28" align="left">
<img src="images/logo.png" alt="" align="top" border="0" style="width:72px;height:84px;"></div>
<div style="position:absolute;left:142px;top:44px;width:408px;height:51px;z-index:29" align="left">
<font style="font-size:35px;BACKGROUND-COLOR:#FFFFFF" color="#000000" face="Agency FB">Request an account</font></div>
<div style="position:absolute;left:42px;top:123px;width:688px;height:76px;z-index:30" align="left">
<font style="font-size:13px" color="#000000" face="Arial"><b>Note</b>: The information submitted through this form will be used for verifying your identity so double-check the data you enter.<br>
Confirmation message will be sent to you on your phone number therefore enter a phone number that is easily accessible for you.</font></div>


<div style="position:absolute;left:42px;top:916px;width:688px;height:76px;z-index:31" align="left">
<font style="font-size:13px" color="#000000" face="Arial"> By clicking 'Request an account', you agree to our <a href="terms.html">Terms</a>.</font></div>

<IMG id="pic">

</body>
</html>