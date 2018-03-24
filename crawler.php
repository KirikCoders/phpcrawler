<?php
echo "hello Saahith";
require_once('simple_html_dom.php');
$cookie="cookie.txt";
$fp = fopen(dirname(__FILE__).'/errorlog.txt', 'w');
$ch = curl_init();

$Result_url ='http://results.vtu.ac.in/vitaviresultcbcs/resultpage.php';
$headers = array(
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
    'Accept-Encoding: gzip, deflate',
    'Accept-Language: en-US,en;q=0.5',
    'Cache-Control: no-cache',
    'Connection: keep-alive',
    'Content-Type: application/x-www-form-urlencoded',
    'Host: results.vtu.ac.in',
    'Pragma: no-cache',
    'Origin: http://results.vtu.ac.in',
    'Upgrade-Insecure-Requests: 1',
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0',
    'Cookie: PHPSESSID=qap39e2gi0q4mk8hfkecii2ek3'
     ); 
$fi='lsn=1bi15cs134';
curl_setopt($ch, CURLOPT_URL,$Result_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_POSTFIELDS,$fi);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_VERBOSE, true);
curl_setopt($ch, CURLOPT_COOKIESESSION, true);
curl_setopt($ch, CURLOPT_REFERER,"http://results.vtu.ac.in/vitaviresultcbcs/index.php");
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie-name');  //could be empty, but cause problems on some hosts
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
curl_setopt($ch, CURLOPT_STDERR, $fp);
$response = curl_exec($ch);
curl_close ($ch);
echo $response;
?>