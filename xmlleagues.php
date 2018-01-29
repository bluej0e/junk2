<?php  /* Template Name: FEED LEAGUE */

header('Content-Type: text/xml');

$feedUrl = 'https://api.pinnaclesports.com/v1/leagues?sportid=12';
$credentials = base64_encode("AFF4626:M1l1c0s@");
$header[] = 'Content-length: 0';
$header[] = 'Content-type: application/xml';
$header[] = 'Authorization: Basic ' . $credentials;
$httpChannel = curl_init();
curl_setopt($httpChannel, CURLOPT_URL, $feedUrl);
curl_setopt($httpChannel, CURLOPT_RETURNTRANSFER, true);
curl_setopt($httpChannel, CURLOPT_HTTPHEADER, $header);
curl_setopt($httpChannel, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)' );
curl_setopt($httpChannel, CURLOPT_SSL_VERIFYPEER, false);
$initialFeed = curl_exec($httpChannel);
$xmlDocument = simplexml_load_string($initialFeed) or die("Error: Cannot create object");
// Simple XML has now build an array of arrays or a dictionary of values, you may access this information by index or name.
$feedTime = $xmlDocument->rsp->fd[0]->fdTime;				
$feedUrl = 'https://api.pinnaclesports.com/v1/leagues?sportid=12' . $fdTime;
$updates = curl_exec($httpChannel);
// Build an XML document from simple XML to read your data as an object again.
echo $xmlDocument->asXML();		

?>