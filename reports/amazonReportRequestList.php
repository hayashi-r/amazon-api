<?php

$param = array();
$param['AWSAccessKeyId']   = $AWSAccessKeyId;
$param['Action']           = 'GetReportRequestList';
$param['ReportRequestIdList.Id.1']           = $requestId;
$param['SellerId']         = $SellerId;
$param['MarketplaceIdList.Id.1'] = $MarketplaceId;
$param['MWSAuthToken'] = $MWSAuthToken;
$param['SignatureMethod']  = 'HmacSHA256';
$param['SignatureVersion'] = '2';
$param['Timestamp']        = gmdate("Y-m-d\TH:i:s.\\0\\0\\0\\Z", time());
$param['Version']          = '2009-01-01';

$url = array();
foreach ($param as $key => $val) {

    $key = str_replace("%7E", "~", rawurlencode($key));
    $val = str_replace("%7E", "~", rawurlencode($val));
    $url[] = "{$key}={$val}";
}

sort($url);

$arr   = implode('&', $url);

$sign  = 'GET' . "\n";
$sign .= 'mws.amazonservices.com' . "\n";
$sign .= '/' . "\n";
$sign .= $arr;

$signature = hash_hmac("sha256", $sign, $secret, true);
$signature = urlencode(base64_encode($signature));

$link  = "https://mws.amazonservices.com/?";
$link .= $arr . "&Signature=" . $signature;
// echo($link); //for debugging - you can paste this into a browser and see if it loads.

$ch = curl_init($link);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/xml'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
$response = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);

$xml = (array)simplexml_load_string($response);

$json = json_encode($xml);
$reportDetails = json_decode($json,TRUE);
