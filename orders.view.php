
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
  ?>

  <h1><?php echo $count; ?>Orders</h1>

  <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="unshipped-tab" data-toggle="tab" href="#unshipped" role="tab" aria-controls="unshipped" aria-selected="true">Unshipped</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="false">Pending</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="shipped-tab" data-toggle="tab" href="#shipped" role="tab" aria-controls="shipped" aria-selected="false">Shipped</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="canceled-tab" data-toggle="tab" href="#canceled" role="tab" aria-controls="canceled" aria-selected="false">Canceled</a>
  </li>
</ul>

<div class="tab-content" id="myTabContent">

<!-- UNSHIPPED ORDERS -->

  <div class="tab-pane fade show active" id="unshipped" role="tabpanel" aria-labelledby="unshipped-tab">
 <table class="table table-striped">
   <thead>
     <tr>
       <th scope="col">Order ID</th>
       <th scope="col">Order Date</th>
       <th scope="col">Order Status</th>
       <th scope="col">Fulfillment By</th>
 	     <th scope="col">SalesChannel</th>

       <th scope="col">Buyer Name</th>

       <th scope="col">Ship By</th>

     </tr>
   </thead>
   <tbody>

   <?php
 	foreach ($orderunshipped as $orders) : ?>

     <tr>
       <th scope="row"><?php echo $orders->amazonorderid; ?></th>
       <td><?php
       $datetochange = $orders->purchasedate;
       $converted = date("d.m.Y H:i:s", strtotime('+9 hours', strtotime($datetochange)));
       echo $converted; ?></td>
       <td><?php
      if($orders->orderstatus == "Unshipped") {
        ?><span class="badge badge-danger">Unshipped</span><?php
      } elseif ($orders->orderstatus == "Shipped") {
        ?><span class="badge badge-success">Shipped</span><?php
      } elseif ($orders->orderstatus == "Canceled") {
        ?><span class="badge badge-light">Canceled</span><?php
      } else {
         ?><span class="badge badge-secondary">Pending</span><?php }
         ?></td>
       <td><?php
            if($orders->fulfillmentchannel === "AFN"){
              echo '<img src="/amazon/pic/amazon.png" width="25px">';
            } else {
        echo $orders->fulfillmentchannel; } ?></td>
       <td><?php echo $orders->saleschannel; ?></td>

       <td><?php echo $orders->buyername; ?></td>

       <td><?php
       $shipdatetochange = $orders->latestshipdate;
       $shipdateconverted = date("d.m.Y H:i:s", strtotime('+9 hours', strtotime($shipdatetochange)));
      echo $shipdateconverted; ?></td>

 	  </tr>

 	<?php
endforeach;
     ?>

   </tbody>
 </table>
</div>

<!--  PENDING ORDERS -->

<div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
<table class="table table-striped">
 <thead>
   <tr>
     <th scope="col">Order ID</th>
     <th scope="col">Order Date</th>
     <th scope="col">Order Status</th>
     <th scope="col">Fulfillment By</th>
     <th scope="col">SalesChannel</th>

     <th scope="col">Buyer Name</th>

  <!--   <th scope="col">Ship By</th> -->

   </tr>
 </thead>
 <tbody>

 <?php
foreach ($orderpending as $orders) : ?>

   <tr>
     <th scope="row"><?php echo $orders->amazonorderid; ?></th>
     <td><?php
     $datetochange = $orders->purchasedate;
     $converted = date("d.m.Y H:i:s", strtotime('+9 hours', strtotime($datetochange)));
     echo $converted; ?></td>
     <td><?php
    if($orders->orderstatus == "Unshipped") {
      ?><span class="badge badge-danger">Unshipped</span><?php
    } elseif ($orders->orderstatus == "Shipped") {
      ?><span class="badge badge-success">Shipped</span><?php
    } elseif ($orders->orderstatus == "Canceled") {
      ?><span class="badge badge-light">Canceled</span><?php
    } else {
       ?><span class="badge badge-secondary">Pending</span><?php }
       ?></td>
     <td><?php
          if($orders->fulfillmentchannel === "AFN"){
            echo '<img src="/amazon/pic/amazon.png" width="25px">';
          } else {
      echo $orders->fulfillmentchannel; } ?></td>
     <td><?php echo $orders->saleschannel; ?></td>

     <td><?php echo $orders->buyername; ?></td>



  </tr>

<?php
endforeach;
   ?>

 </tbody>
</table>
</div>


<!--  SHIPPED ORDERS -->

<div class="tab-pane fade" id="shipped" role="tabpanel" aria-labelledby="shipped-tab">
<table class="table table-striped">
 <thead>
   <tr>
     <th scope="col">Order ID</th>
     <th scope="col">Order Date</th>
     <th scope="col">Order Status</th>
     <th scope="col">Fulfillment By</th>
     <th scope="col">SalesChannel</th>

     <th scope="col">Buyer Name</th>

  <!--   <th scope="col">Ship By</th> -->

   </tr>
 </thead>
 <tbody>

 <?php
foreach ($ordershipped as $orders) : ?>

   <tr>
     <th scope="row"><?php echo $orders->amazonorderid; ?></th>
     <td><?php
     $datetochange = $orders->purchasedate;
     $converted = date("d.m.Y H:i:s", strtotime('+9 hours', strtotime($datetochange)));
     echo $converted; ?></td>
     <td><?php
    if($orders->orderstatus == "Unshipped") {
      ?><span class="badge badge-danger">Unshipped</span><?php
    } elseif ($orders->orderstatus == "Shipped") {
      ?><span class="badge badge-success">Shipped</span><?php
    } elseif ($orders->orderstatus == "Canceled") {
      ?><span class="badge badge-light">Canceled</span><?php
    } else {
       ?><span class="badge badge-secondary">Pending</span><?php }
       ?></td>
     <td><?php
          if($orders->fulfillmentchannel === "AFN"){
            echo '<img src="/amazon/pic/amazon.png" width="25px">';
          } else {
      echo $orders->fulfillmentchannel; } ?></td>
     <td><?php echo $orders->saleschannel; ?></td>

     <td><?php echo $orders->buyername; ?></td>



  </tr>

<?php
endforeach;
   ?>

 </tbody>
</table>
</div>

<!--  CANCELED ORDERS -->

<div class="tab-pane fade" id="canceled" role="tabpanel" aria-labelledby="canceled-tab">
<table class="table table-striped">
 <thead>
   <tr>
     <th scope="col">Order ID</th>
     <th scope="col">Order Date</th>
     <th scope="col">Order Status</th>
     <th scope="col">Fulfillment By</th>
     <th scope="col">SalesChannel</th>

     <th scope="col">Buyer Name</th>

<!--     <th scope="col">Ship By</th> -->

   </tr>
 </thead>
 <tbody>

 <?php
foreach ($ordercanceled as $orders) : ?>

   <tr>
     <th scope="row"><?php echo $orders->amazonorderid; ?></th>
     <td><?php
     $datetochange = $orders->purchasedate;
     $converted = date("d.m.Y H:i:s", strtotime('+9 hours', strtotime($datetochange)));
     echo $converted; ?></td>
     <td><?php
    if($orders->orderstatus == "Unshipped") {
      ?><span class="badge badge-danger">Unshipped</span><?php
    } elseif ($orders->orderstatus == "Shipped") {
      ?><span class="badge badge-success">Shipped</span><?php
    } elseif ($orders->orderstatus == "Canceled") {
      ?><span class="badge badge-light">Canceled</span><?php
    } else {
       ?><span class="badge badge-secondary">Pending</span><?php }
       ?></td>
     <td><?php
          if($orders->fulfillmentchannel === "AFN"){
            echo '<img src="/amazon/pic/amazon.png" width="25px">';
          } else {
      echo $orders->fulfillmentchannel; } ?></td>
     <td><?php echo $orders->saleschannel; ?></td>

     <td><?php echo $orders->buyername; ?></td>



  </tr>

<?php
endforeach;
   ?>

 </tbody>
</table>
</div>

</div>
     <!-- Optional JavaScript -->
     <!-- jQuery first, then Popper.js, then Bootstrap JS -->
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   </body>
 </html>
