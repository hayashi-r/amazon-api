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
<?php include('nav.php'); ?>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>. Welcome to our site.</h1>
<a href="/test/plan/plan.php">Plans</a>
    </div>
	<div class="wrapper">

<?php
	// Attempt select query execution
$sql = "SELECT * FROM mws_auth";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
		?>
			<h2>Your registered address:</h2>
			<form action="deleteauth.php" method="post">
			<?php

        while($row = mysqli_fetch_array($result)){
            	?>
				<div class="card float-left" style="width: 18rem; height: 200px;">
				<div class="card-body">

				<div class="form-check">
  <input class="form-check-input" type="radio" name="deleteauth" id="deleteauth" value="<?php echo $row['id']; ?>">
  <label class="form-check-label2" for="deleteauth">
    <h5 class="card-title"><?php echo $row['custom_name']; ?></h5>
  </label>
</div>

                <p class="card-text"><?php echo "Seller ID: " . $row['seller_id']; ?></br>

			<?php	echo "MWS Auth Token: " . $row['token']; ?></br><?php

				echo "Marketplace ID: " . $row['marketplace_id']; ?></br>
        <?php echo "Marketplace: " . $row['marketplace_name']; ?>

				</div>
				</div>
            <?php
        }
        ?>
		<input type="submit" class="btn btn-primary" value="Delete">
		</form><?php
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


</body>
</html>
