<?php

require_once("mwscredentials.php");
require_once("db.php");

$param = array();
$param['AWSAccessKeyId']   = $AWSAccessKeyId;
$param['Action']           = 'ListOrders';
$param['SellerId']         = $SellerId;
$param['MarketplaceId.Id.1'] = $MarketplaceId;
$param['MWSAuthToken'] = $MWSAuthToken;
$param['SignatureMethod']  = 'HmacSHA256';
$param['SignatureVersion'] = '2';
$param['Timestamp']        = gmdate("Y-m-d\TH:i:s.\\0\\0\\0\\Z", time());
$param['Version']          = '2013-09-01';
$param['CreatedAfter']    = gmdate("Y-m-d\TH:i:s.\\0\\0\\0\\Z", time() - 432000);


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
$sign .= '/Orders/2013-09-01' . "\n";
$sign .= $arr;

$signature = hash_hmac("sha256", $sign, $secret, true);
$signature = urlencode(base64_encode($signature));

$link  = "https://mws.amazonservices.com/Orders/2013-09-01?";
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
$orders = json_decode($json,TRUE);

$orderdata = array();

foreach($orders as $results) {
  foreach($results as $amaorders) {
    foreach($amaorders as $numbers){
      foreach($numbers as $data => $finaldata){

$orderid = $finaldata['AmazonOrderId'];
$purchasedate = $finaldata['PurchaseDate'];
$orderstatus = $finaldata['OrderStatus'];
$fulfillmentchannel = $finaldata['FulfillmentChannel'];
$saleschannel = $finaldata['SalesChannel'];
$buyeremail = $finaldata['BuyerEmail'];
$buyername = $finaldata['BuyerName'];
$ordertype = $finaldata['OrderType'];
$latestshipdate = $finaldata['LatestShipDate'];
$isbusinessorder = (int)$finaldata['IsBusinessOrder'];
$isprime = (int)$finaldata['IsPrime'];
$ispremiumorder = (int)$finaldata['IsPremiumOrder'];

$orderdata[] = "('$orderid','$purchasedate','$orderstatus','$fulfillmentchannel','$saleschannel','$buyeremail','$buyername','$ordertype','$latestshipdate','$isbusinessorder','$isprime','$ispremiumorder')";
          }
        }
      }
    }

$imploded = implode(',', $orderdata);

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "sendjapa_amazon", "hayashir", "sendjapa_amazon");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
var_dump($orderdata);
$checkentry = mysqli_query($link, "SELECT * FROM amazon_orders WHERE amazonorderid='$orderid'");

if(mysqli_num_rows($checkentry) == 0) {
$result = mysqli_query($link, "INSERT into amazon_orders (amazonorderid, purchasedate, orderstatus, fulfillmentchannel, saleschannel, buyeremail, buyername, ordertype, latestshipdate, isbusinessorder, isprime, ispremiumorder) VALUES $imploded") or die(mysqli_error($link));
 }
