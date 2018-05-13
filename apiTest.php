<?php
$param = array();
$param['AWSAccessKeyId']   = 'AKIAJ3W2Y6O7ZIKID3DA';
$param['Action']           = 'GetProductCategoriesForASIN';
$param['SellerId']         = 'A1G4PRG75E40ML';
$param['SignatureMethod']  = 'HmacSHA256';
$param['SignatureVersion'] = '2';
$param['Timestamp']        = gmdate("Y-m-d\TH:i:s.\\0\\0\\0\\Z", time());
$param['Version']          = '2011-10-01';
$param['MarketplaceId']    = 'ATVPDKIKX0DER';
$param['ItemCondition']    = 'new';
$param['ASIN']  = 'B00C5XBAOA';
$secret = '7y0iZ3mF42K7HmFA42if2BFpYt7WQHyoXCcO2M6S';

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
$sign .= '/Products/2011-10-01' . "\n";
$sign .= $arr;

$signature = hash_hmac("sha256", $sign, $secret, true);
$signature = urlencode(base64_encode($signature));

$link  = "https://mws.amazonservices.com/Products/2011-10-01?";
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
$array = json_decode($json,TRUE);
print_r($array);
