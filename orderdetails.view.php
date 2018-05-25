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
// $orderdetails = $query->selectOrderDetails('order_details', $orderiddetail);


  ?>

  <h1>Order Details:</h1>

  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Order ID</th>
        <th scope="col">Asin</th>
        <th scope="col">SKU</th>
        <th scope="col">Title</th>
        <th scope="col">Quantity Ordered</th>
        <th scope="col">Quantity Shipped</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td scope="col"><?php echo $selectorderdetails[0]->amazonorderid; ?></td>
        <td scope="col"><?php echo $selectorderdetails[0]->asins; ?></td>
        <td scope="col"><?php echo $selectorderdetails[0]->sellersku; ?></td>
        <td scope="col"><?php echo $selectorderdetails[0]->title; ?></td>
        <td scope="col"><?php echo $selectorderdetails[0]->quantityordered; ?></td>
        <td scope="col"><?php echo $selectorderdetails[0]->quantityshipped; ?></td>
      </tr>
    </tbody>
  </table>
