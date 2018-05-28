<?php
require("database/connection.php");
require("database/QueryBuilder.php");

$statement = $pdo->prepare("INSERT INTO copy_amazon_orders (amazonorderid, orderstatus) VALUES (?, ?)");
$statement->execute(array("12343434", "Unshipped"));
