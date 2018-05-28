<?php

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password)
$link = mysqli_connect("localhost", "sendjapa_amazon", "hayashir", "sendjapa_amazon");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
} */

try {
$pdo = new PDO('mysql:host=localhost;dbname=sendjapa_amazon', 'hayashir', 'sendjapa_amazon');
} catch (PDOException $e) {
  die('Could not connect.');
}

 ?>
