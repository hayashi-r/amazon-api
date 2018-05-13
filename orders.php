<?php
require_once("header.php");
require_once("db.php");
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>

<body>
<?php
include('nav.php');



 	// Attempt select query execution
 $sql = "SELECT * FROM amazon_orders ORDER BY purchasedate DESC";
 if($result = mysqli_query($link, $sql)){
     if(mysqli_num_rows($result) > 0){

  ?>
  <h1><?php
  $countrows = mysqli_query($link, "SELECT COUNT(*) as total FROM amazon_orders");
   echo $rows['total']; ?> Orders</h1>


 <table class="table table-striped">
   <thead>
     <tr>
       <th scope="col">Order ID</th>
       <th scope="col">Order Date</th>
       <th scope="col">Order Status</th>
       <th scope="col">Fulfillment By</th>
 	     <th scope="col">SalesChannel</th>
 	     <th scope="col">Buyer Email</th>
       <th scope="col">Buyer Name</th>
       <th scope="col">Order Type</th>
       <th scope="col">Ship By</th>
       <th scope="col">Business Order</th>
       <th scope="col">Prime Order</th>
       <th scope="col">Premium Order</th>
     </tr>
   </thead>
   <tbody>

   <?php
 	while($row = mysqli_fetch_array($result)){
     ?>

     <tr>
       <th scope="row"><?php echo $row['amazonorderid']; ?></th>
       <td><?php
       $datetochange = $row['purchasedate'];
       $converted = date("d.m.Y H:i:s", strtotime('+9 hours', strtotime($datetochange)));
       echo $converted; ?></td>
       <td><?php
      if($row['orderstatus'] == "Unshipped") {
        ?><span class="badge badge-danger">Unshipped</span><?php
      } elseif ($row['orderstatus'] == "Shipped") {
        ?><span class="badge badge-success">Shipped</span><?php
      } elseif ($row['orderstatus'] == "Canceled") {
        ?><span class="badge badge-light">Canceled</span><?php
      } else {
         ?><span class="badge badge-secondary">Pending</span><?php }
         ?></td>
       <td><?php
            if($row['fulfillmentchannel'] === "AFN"){
              echo '<img src="/amazon/pic/amazon.png" width="25px">';
            } else {
        echo $row['fulfillmentchannel']; } ?></td>
       <td><?php echo $row['saleschannel']; ?></td>
       <td><?php echo $row['buyeremail']; ?></td>
       <td><?php echo $row['buyername']; ?></td>
       <td><?php echo $row['ordertype']; ?></td>
       <td><?php
       $shipdatetochange = $row['latestshipdate'];
       $shipdateconverted = date("d.m.Y H:i:s", strtotime('+9 hours', strtotime($shipdatetochange)));
      echo $shipdateconverted; ?></td>
       <td><?php echo $row['isbusinessorder']; ?></td>
       <td><?php echo $row['isprime']; ?></td>
       <td><?php echo $row['ispremiumorder']; ?></td>
 	  </tr>

 	<?php
         }
     ?>

   </tbody>
 </table>

 <?php
         // Free result set
         mysqli_free_result($result);
     } else{
         echo "No records matching your query were found.";
     }
 } else{
     echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
 }

 // Close connection
 mysqli_close($link);
 ?>

     <!-- Optional JavaScript -->
     <!-- jQuery first, then Popper.js, then Bootstrap JS -->
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   </body>
 </html>
