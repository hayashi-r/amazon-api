
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders</title>

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


 <button type="button" class="btn btn-primary" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Updating..." onclick="window.location.href='/amazon/reports/orderReport.php'">Update Orderlist</button>

 <table class="table table-striped">
   <thead>
     <tr>
       <th scope="col">Order ID</th>
       <th scope="col">Order Date</th>
       <th scope="col">Marketplace</th>
       <th scope="col">SKU</th>
       <th scope="col">Product Name</th>
       <th scope="col">Quantity</th>
       <th scope="col">Ship to</th>
       <th scope="col">Shipping</th>
       <th scope="col">Ship by</th>



     </tr>
   </thead>
   <tbody>

   <?php
 	foreach ($allorders as $orders) : ?>

     <tr>
       <th scope="row"><a href="orderDetails.php?orderid=<?php echo $orders->orderid; ?>"><?php echo $orders->orderid; ?></a></th>
       <td><?php
       $datetochange = $orders->purchasedate;
       $converted = date("d.m.Y H:i:s", strtotime('+9 hours', strtotime($datetochange)));
       echo $converted; ?></td>
       <td><?php echo $orders->marketplace; ?></td>
       <td><?php echo $orders->sku; ?></td>
       <td><?php echo $orders->productname; ?></td>
       <td><?php echo $orders->qtypurchased; ?></td>
       <td><?php echo $orders->recipient; ?><br>
           <?php echo $orders->address1; ?><br>
           <?php  if (!empty($orders->address2)) {
             echo $orders->address2; ?><br>
           <?php };
             if (!empty($orders->address3)) {
               echo $orders->address3; ?><br>
             <?php };
             echo $orders->postalcode; ?>, <?php echo $orders->city; ?><br>
             <?php echo $orders->country; ?>
      </td>
    <td><?php echo $orders->shiplevel; ?></td>
    <td><?php
    $datetochange = $orders->shipby;
    $converted = date("d.m.Y H:i:s", strtotime('+9 hours', strtotime($datetochange)));
    echo $converted; ?></td>

 	  </tr>

 	<?php
endforeach;
     ?>

   </tbody>
 </table>


     <!-- Optional JavaScript -->
     <!-- jQuery first, then Popper.js, then Bootstrap JS -->
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
     <script src="amazon/js/loading.js">
   </body>
 </html>
