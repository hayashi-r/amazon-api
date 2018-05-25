<?php

 require("mwscredentials.php");

$allorders = $query->selectAll('amazon_orders');

// $orderiddetail = $_GET['orderid'];
foreach ($allorders as $orders){

$orderiddetail = $orders->amazonorderid;
// SET Paramater for API request

require("amazonListOrderItems.php");

// Loop through XML result

$quantityordered = (int)$orders['ListOrderItemsResult']['OrderItems']['OrderItem']['QuantityOrdered'];
$quanityshipped = (int)$orders['ListOrderItemsResult']['OrderItems']['OrderItem']['QuantityShipped'];
$title = $orders['ListOrderItemsResult']['OrderItems']['OrderItem']['Title'];
if($title === NULL){
  $title = "";
}
$sellersku = $orders['ListOrderItemsResult']['OrderItems']['OrderItem']['SellerSKU'];
if($sellersku === NULL){
  $sellersku = "";
}
$asins = $orders['ListOrderItemsResult']['OrderItems']['OrderItem']['ASIN'];
if($asins === NULL){
  $asins = "";
}

// INSERT
try {
      $statement = $pdo->prepare("INSERT INTO order_details(amazonorderid, asins, sellersku, title, quantityordered, quantityshipped)
        VALUES (:orderiddetail, :asins, :sellersku, :title, :quantityordered, :quantityshipped)");
         $statement->bindValue(':orderiddetail', $orderiddetail, PDO::PARAM_STR);
         $statement->bindValue(':asins', $asins, PDO::PARAM_STR);
         $statement->bindValue(':sellersku', $sellersku, PDO::PARAM_STR);
         $statement->bindValue(':title', $title, PDO::PARAM_STR);
         $statement->bindValue(':quantityordered', $quantityordered, PDO::PARAM_INT);
         $statement->bindValue(':quantityshipped', $quanityshipped, PDO::PARAM_INT);
         $statement->execute();
    } catch (PDOException $e) {
    if ($e->errorInfo[1] == 1062) {
       $statement = $pdo->prepare("UPDATE order_details SET asins=:asins, sellersku=:sellersku, title=:title, quantityordered=:quantityordered, quantityshipped=:quantityshipped WHERE amazonorderid = :orderiddetail");
       $statement->bindValue(':orderiddetail', $orderiddetail, PDO::PARAM_STR);
       $statement->bindValue(':asins', $asins, PDO::PARAM_STR);
       $statement->bindValue(':sellersku', $sellersku, PDO::PARAM_STR);
       $statement->bindValue(':title', $title, PDO::PARAM_STR);
       $statement->bindValue(':quantityordered', $quantityordered, PDO::PARAM_INT);
       $statement->bindValue(':quantityshipped', $quanityshipped, PDO::PARAM_INT);
       $statement->execute();
    } else {
echo $e;
break;
}
}
// INSERT  END

};
// END of foreach
