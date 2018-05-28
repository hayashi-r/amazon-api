<?php
$config = require("config.php");

require("credentials.php");
require("database/connection.php");
require("database/QueryBuilder.php");

$pdo = Connection::make($config['database']);

$query = new QueryBuilder($pdo);


$allorders = $query->selectAll('amazon_orders');
// $orderunshipped = $query->selectAllUnshippedDesc('amazon_orders');
// $orderpending = $query->selectAllPendingDesc('amazon_orders');
// $ordershipped = $query->selectAllShippedDesc('amazon_orders');
// $ordercanceled = $query->selectAllCanceledDesc('amazon_orders');

require("views/allorders.view.php");
