<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "sendjapa_amazon", "hayashir", "sendjapa_amazon");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Escape user inputs for security
$seller_id = mysqli_real_escape_string($link, $_REQUEST['seller_id']);
$token = mysqli_real_escape_string($link, $_REQUEST['token']);
$marketplace_id = mysqli_real_escape_string($link, $_REQUEST['marketplace_id']);
$marketplace_name = mysqli_real_escape_string($link, $_REQUEST['marketplace_name']);
$custom_name = mysqli_real_escape_string($link, $_REQUEST['custom_name']);

// attempt insert query execution
$sql = "INSERT INTO mws_auth (seller_id, token, marketplace_id, marketplace_name, custom_name) VALUES ('$seller_id', '$token', '$marketplace_id', '$marketplace_name', '$custom_name')";
if(mysqli_query($link, $sql)){
    header("location: index.php");
exit;
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// close connection
mysqli_close($link);
?>
