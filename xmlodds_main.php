<?php /* Template Name: FEED ODDS MAIN */?>


<?php

$feedUrl = 'https://api.pinnaclesports.com/v1/fixtures?sportid=12';
$credentials = base64_encode("AFF4626:M1l1c0s@");
$header[] = 'Content-length: 0';
$header[] = 'Content-type: application/json';
$header[] = 'Authorization: Basic ' . $credentials;
$httpChannel = curl_init();
curl_setopt($httpChannel, CURLOPT_URL, $feedUrl);
curl_setopt($httpChannel, CURLOPT_RETURNTRANSFER, true);
curl_setopt($httpChannel, CURLOPT_HTTPHEADER, $header);
curl_setopt($httpChannel, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)' );
curl_setopt($httpChannel, CURLOPT_SSL_VERIFYPEER, false);
$initialFeed = curl_exec($httpChannel);

echo $initialFeed;

$xmlDocument = simplexml_load_string($initialFeed);
$feedTime = $xmlDocument->rsp->fd[0]->fdTime;

echo $fdTime;

$feedUrl = 'https://api.pinnaclesports.com/v1/fixtures?sportid=12' . $fdTime;

$updates = curl_exec($httpChannel);


echo $xmlDocument->asXML();	


?>