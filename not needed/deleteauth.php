<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "sendjapa_amazon", "hayashir", "sendjapa_amazon");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


//echo $_POST['deleteaddress'];

$id = $_POST['deleteauth'];

// attempt insert query execution
$sql = "DELETE FROM mws_auth
WHERE ID = $id";
if(mysqli_query($link, $sql)){
    header("location: index.php");
exit;
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// close connection
mysqli_close($link);
?>
