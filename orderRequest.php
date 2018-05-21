<?php

 require("mwscredentials.php");

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
$param['CreatedAfter']    = gmdate("Y-m-d\TH:i:s.\\0\\0\\0\\Z", time() - 864000);


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


  try {
       $statement = $pdo->prepare("INSERT INTO amazon_orders(amazonorderid, purchasedate, orderstatus, fulfillmentchannel, saleschannel, buyeremail, buyername, ordertype, latestshipdate, isbusinessorder, isprime, ispremiumorder)
        VALUES ('$orderid', '$purchasedate', '$orderstatus', '$fulfillmentchannel', '$saleschannel', '$buyeremail', '$buyername', '$ordertype', '$latestshipdate', '$isbusinessorder', '$isprime', '$ispremiumorder')");
       $statement->execute();
     } catch (PDOException $e) {
    if ($e->errorInfo[1] == 1062) {
      $statement = $pdo->prepare("UPDATE amazon_orders SET orderstatus = '$orderstatus' WHERE amazonorderid = '$orderid'");
      $statement->execute();
    } else {
       echo $e;
     }
   }


          }
        }
      }
    }
