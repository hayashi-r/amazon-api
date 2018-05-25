<?php
$config = require("config.php");

require("credentials.php");
require("database/connection.php");
require("database/QueryBuilder.php");

$pdo = Connection::make($config['database']);

$query = new QueryBuilder($pdo);


$orderiddetail = $_GET['orderid'];
$selectorderdetails = $query->selectOrderDetails('order_details', $orderiddetail);

require("views/orderdetails.view.php");
