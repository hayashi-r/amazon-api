<?php
$config = require("config.php");

require("credentials.php");
require("database/connection.php");
require("database/QueryBuilder.php");

$pdo = Connection::make($config['database']);

$query = new QueryBuilder($pdo);

$mwscredentials = $query->getCredentials('mws_auth');

foreach($mwscredentials as $auth){
  $SellerId = $auth->seller_id;
  $MarketplaceId = $auth->marketplace_id;
  $MWSAuthToken = $auth->token;
}

$AWSAccessKeyId = 'AKIAJ3W2Y6O7ZIKID3DA';
// $SellerId = $seller_id;
// $MarketplaceId = $marketplace_id;
// $MWSAuthToken = $token;
$secret = '7y0iZ3mF42K7HmFA42if2BFpYt7WQHyoXCcO2M6S';



 ?>
