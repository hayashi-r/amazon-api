<?php
require_once("db.php");

$sql = "SELECT * FROM mws_auth";
$result = mysqli_query($link, $sql);
$rs = mysqli_fetch_array($result);

$AWSAccessKeyId = 'AKIAJ3W2Y6O7ZIKID3DA';
$SellerId = $rs['seller_id'];
$MarketplaceId = $rs['marketplace_id'];
$MWSAuthToken = $rs['token'];
$secret = '7y0iZ3mF42K7HmFA42if2BFpYt7WQHyoXCcO2M6S';


 ?>
