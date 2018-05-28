<?php
require_once("header.php");
require_once("db.php");
 ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Shipping Plan</title>
  </head>
  <body>
<?php include('nav.php'); ?>
 <div class="jumbotron">
	<form action="create.php" method="post">
		<div class="form-group">
			<label for="name">Shipping plan</label>
			<input type="text" class="form-control" name="name" id="name" aria-describedby="nameHelp" placeholder="Name of your plan">
		</div>
			<button type="submit" class="btn btn-primary">Create Plan</button>
	</form>
</div>

<?php
	// Attempt select query execution
$sql = "SELECT * FROM plan";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
		?>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Plan #</th>
      <th scope="col">Name</th>
      <th scope="col">Created</th>
      <th scope="col">Status</th>
	  <th scope="col"></th>
	  <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>

  <?php
	while($row = mysqli_fetch_array($result)){
    ?>

    <tr>
      <th scope="row"><?php echo $row['id']; ?></th>
      <td><?php echo $row['name']; ?></td>
      <td><?php echo $row['date']; ?></td>
      <td><?php echo $row['status']; ?></td>
	  <td>
		<div class="dropdown">
			<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Change status
			</button>
			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<a class="dropdown-item" href="#">Action</a>
				<a class="dropdown-item" href="#">Another action</a>
				<a class="dropdown-item" href="#">Something else here</a>
			</div>
		</div>
	  </td>

	  <form action="deleteplan.php" method="post">
	  <td>

			<button type="submit" class="btn btn-link" name="delete" value="<?php echo $row['id']; ?>">Delete</button>

	  </td>
	  </form>

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
