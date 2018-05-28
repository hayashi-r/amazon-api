<?php

$param = array();
$param['AWSAccessKeyId']   = $AWSAccessKeyId;
$param['Action']           = 'GetReport';
$param['ReportId']           = $generatedReportId;
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


 $csv = array_map(function($v){return str_getcsv($v, "\t");}, file($link));
     array_walk($csv, function(&$a) use ($csv) {
       $a = array_combine($csv[0], $a);
     });
     array_shift($csv); # remove column header

//  echo '<pre>' , var_dump($csv) , '</pre>';

        foreach($csv as $data => $orderdata){
          $orderid = $orderdata['order-id'];
          $purchasedate = $orderdata['purchase-date'];
          $shipby = $orderdata['promise-date'];
          $buyeremail = $orderdata['buyer-email'];
          $buyername = $orderdata['buyer-name'];
          $buyerphone = $orderdata['buyer-phone-number'];
          $sku = $orderdata['sku'];
          $productname = $orderdata['product-name'];
          $qtypurchased = (INT)$orderdata['quantity-purchased'];
          $shiplevel = $orderdata['ship-service-level'];
          $recipient = $orderdata['recipient-name'];
          $address1 = $orderdata['ship-address-1'];
          $address2 = $orderdata['ship-address-2'];
          $address3 = $orderdata['ship-address-3'];
          $city = $orderdata['ship-city'];
          $state = $orderdata['ship-state'];
          $postalcode = $orderdata['ship-postal-code'];
          $country = $orderdata['ship-country'];
          $businessorder = $orderdata['is-business-order'];
          $marketplace = "Amazon.com";

// echo $orderid . ": " . $promisedate;
          // INSERT
try {
      $statement = $pdo->prepare("INSERT INTO amazon_orders(orderid, purchasedate, shipby, buyeremail, buyername, buyerphone, sku,
      productname, qtypurchased, shiplevel, recipient, address1, address2, address3, city, state, postalcode, country, businessorder, marketplace)
        VALUES (:orderid, :purchasedate, :shipby, :buyeremail, :buyername, :buyerphone, :sku,
        :productname, :qtypurchased, :shiplevel, :recipient, :address1, :address2, :address3, :city, :state, :postalcode, :country, :businessorder, :marketplace)");
         $statement->bindValue(':orderid', $orderid, PDO::PARAM_STR);
         $statement->bindValue(':purchasedate', $purchasedate, PDO::PARAM_STR);
         $statement->bindValue(':shipby', $shipby, PDO::PARAM_STR);
         $statement->bindValue(':buyeremail', $buyeremail, PDO::PARAM_STR);
         $statement->bindValue(':buyername', $buyername, PDO::PARAM_STR);
         $statement->bindValue(':buyerphone', $buyerphone, PDO::PARAM_STR);
         $statement->bindValue(':sku', $sku, PDO::PARAM_STR);
         $statement->bindValue(':productname', $productname, PDO::PARAM_STR);
         $statement->bindValue(':qtypurchased', $qtypurchased, PDO::PARAM_INT);
         $statement->bindValue(':shiplevel', $shiplevel, PDO::PARAM_STR);
         $statement->bindValue(':recipient', $recipient, PDO::PARAM_STR);
         $statement->bindValue(':address1', $address1, PDO::PARAM_STR);
         $statement->bindValue(':address2', $address2, PDO::PARAM_STR);
         $statement->bindValue(':address3', $address3, PDO::PARAM_STR);
         $statement->bindValue(':city', $city, PDO::PARAM_STR);
         $statement->bindValue(':state', $state, PDO::PARAM_STR);
         $statement->bindValue(':postalcode', $postalcode, PDO::PARAM_STR);
         $statement->bindValue(':country', $country, PDO::PARAM_STR);
         $statement->bindValue(':businessorder', $businessorder, PDO::PARAM_BOOL);
         $statement->bindValue(':marketplace', $marketplace, PDO::PARAM_STR);
      $statement->execute();
    } catch (PDOException $e) {
    if ($e->errorInfo[1] == 1062) {
       $result = "Double entry";
    } else {
echo $e;
break;
}
}
// INSERT  END

};
// END of foreach
