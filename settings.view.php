<?php
require_once("header.php");
require_once("db.php");
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Settings</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>

<body>
  <?php include('nav.php'); ?>
  <div class="jumbotron float-left" style="width: 100%;">
	<h2 style="text-align:left;">Authorize Amazon Marketplace Access:</h2>

	<form action="amazonauth.php" method="post">
    <div class="form-group" style="text-align:left;">
        <label for="seller_id">Seller ID:</label>
        <input type="text" class="form-control" name="seller_id" id="seller_id" placeholder="Enter Seller ID" style="width:25%;">
    </div>
    <div class="form-group" style="text-align:left;">
        <label for="token">MWS Auth Token:</label>
        <input type="text" class="form-control" name="token" id="token" placeholder="Enter MWS Auth Token" style="width:25%;">
    </div>

      <div class="form-group" style="text-align:left;">
        <label for="marketplace_name">Amazon Marketplace:</label>
        <select class="form-control" name="marketplace_name" id="marketplace_name" style="width:25%;">
          <option value="Amazon.com">Amazon.com</option>
          <option value="Amazon.co.uk">Amazon.co.uk</option>
        </select>
</div>


    <div class="form-group" style="text-align:left;">
        <label for="marketplace_id">Marketplace ID:</label>
        <input type="text" class="form-control" name="marketplace_id" id="marketplace_id" placeholder="Marketplace ID" style="width:25%;">
</div>

<div class="form-group" style="text-align:left;">
        <label for="custom_name">Name of your Marketplace:</label>
         <input type="text" class="form-control" name="custom_name" id="custom_name" placeholder="Marketplace Name" style="width:25%;">
</div>
    <button type="submit" value="Submit" class="btn btn-secondary">Submit</button>
</form>
</div>

</body>
</html>
