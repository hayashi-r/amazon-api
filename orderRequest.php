<?php

// Receive customer MWS credentials

require("mwscredentials.php");

// SET Paramater for API request

require("amazonListOrders.php");


// Loop through XML result

foreach($orders as $results) {
// Receive Next token
 if($results['NextToken']){
  $nexttoken = $results['NextToken'];
}
// END of receive Next $token

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

// GET OrderTotal

if(isset($finaldata['OrderTotal'])){

    $currencycode = $finaldata['OrderTotal']['CurrencyCode'];
    $amount = $finaldata['OrderTotal']['Amount'];

}

// END of GET OrderTotal

// GET Shipping address

if(isset($finaldata['ShippingAddress'])){

    $city = $finaldata['ShippingAddress']['City'];
    $postalcode = $finaldata['ShippingAddress']['PostalCode'];
    $state = $finaldata['ShippingAddress']['StateOrRegion'];
    $country = $finaldata['ShippingAddress']['CountryCode'];
    $customername = $finaldata['ShippingAddress']['Name'];
    $address1 = $finaldata['ShippingAddress']['AddressLine1'];
    $address2 = $finaldata['ShippingAddress']['AddressLine2'];
    $address3 = $finaldata['ShippingAddress']['AddressLine3'];

}

// End of Shipping address

// INSERT first 100 results or Update
  try {
       $statement = $pdo->prepare("INSERT INTO amazon_orders(amazonorderid, purchasedate, orderstatus, fulfillmentchannel,
          saleschannel, buyeremail, buyername, ordertype, latestshipdate, isbusinessorder, isprime, ispremiumorder, currencycode, amount,
          city, postalcode, state, country, customername, address1, address2, address3)
        VALUES (:orderid, :purchasedate, :orderstatus, :fulfillmentchannel,
           :saleschannel, :buyeremail, :buyername, :ordertype, :latestshipdate, :isbusinessorder, :isprime, :ispremiumorder, :currencycode, :amount,
           :city, :postalcode, :state, :country, :customername, :address1, :address2, :address3)");
           $statement->bindValue(':orderid', $orderid, PDO::PARAM_STR);
           $statement->bindValue(':purchasedate', $purchasedate, PDO::PARAM_STR);
           $statement->bindValue(':orderstatus', $orderstatus, PDO::PARAM_STR);
           $statement->bindValue(':fulfillmentchannel', $fulfillmentchannel, PDO::PARAM_STR);
           $statement->bindValue(':saleschannel', $saleschannel, PDO::PARAM_STR);
           if($buyeremail === null){ $buyeremail = ""; }
           $statement->bindValue(':buyeremail', $buyeremail, PDO::PARAM_STR);
           if($buyername === null){ $buyername = ""; }
           $statement->bindValue(':buyername', $buyername, PDO::PARAM_STR);
           $statement->bindValue(':ordertype', $ordertype, PDO::PARAM_STR);
           $statement->bindValue(':latestshipdate', $latestshipdate, PDO::PARAM_STR);
           $statement->bindValue(':isbusinessorder', $isbusinessorder, PDO::PARAM_INT);
           $statement->bindValue(':isprime', $isprime, PDO::PARAM_INT);
           $statement->bindValue(':ispremiumorder', $ispremiumorder, PDO::PARAM_INT);
           $statement->bindValue(':currencycode', $currencycode, PDO::PARAM_STR);
           $statement->bindValue(':amount', $amount, PDO::PARAM_STR);
           $statement->bindValue(':city', $city, PDO::PARAM_STR);
           $statement->bindValue(':postalcode', $postalcode, PDO::PARAM_STR);
           if($state === null){ $state = ""; }
           $statement->bindValue(':state', $state, PDO::PARAM_STR);
           $statement->bindValue(':country', $country, PDO::PARAM_STR);
           if($customername === null){ $customername = ""; }
           $statement->bindValue(':customername', $customername, PDO::PARAM_STR);
           $statement->bindValue(':address1', $address1, PDO::PARAM_STR);
            if($address2 === null){ $address2 = ""; }
           $statement->bindValue(':address2', $address2, PDO::PARAM_STR);
           if($address3 === null){ $address3 = ""; }
           $statement->bindValue(':address3', $address3, PDO::PARAM_STR);
           $statement->execute();
    echo "New insert for ID $orderid with Amount $currencycode $amount"; ?><br> <?php
    } catch (PDOException $e) {
    if ($e->errorInfo[1] == 1062) {

     $statement = $pdo->prepare("UPDATE amazon_orders SET orderstatus=:orderstatus WHERE amazonorderid = :orderid");
     $statement->bindValue(':orderstatus', $orderstatus, PDO::PARAM_STR);
     $statement->bindValue(':orderid', $orderid, PDO::PARAM_STR);
     $statement->execute();
    /* echo "Double entry for ID $orderid"; ?><br> <?php
    */
    } else {
       echo $e;
     }
   }
// INSERT  END

          }

        }
      }
    }

    if(isset($nexttoken)){
      echo "There are more orders to load";
    } else {
      echo "No more orders left";
    }

    require("orderDetailsRequest.php");
