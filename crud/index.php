<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    		<div class="row">
    			<h3>PHP CRUD Grid</h3>
    		</div>
			<div class="row">
				<p>
					<a href="create.php" class="btn btn-default">Create</a>
				</p>
				
				<table class="table-bordered table">
		              <thead>
		                <tr>
		                  <th>Id</th>
		                  <th>Name</th>
		                  <th>Gender</th>
		                  <th>Pokedollars</th>
		                  <th>Username</th>
		                  <th>Password</th>
		                  <th>Region Name</th>
		                  <th>Action</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
					   include 'database.php';
					   $pdo = Database::connect();
					   $sql = 'SELECT Trainer.id, Trainer.name, Trainer.gender, Trainer.pokedollars, Trainer.username, Trainer.password, Region.name as regionName FROM Trainer JOIN Region ON Trainer.regionName = Region.id';
	 				   foreach ($pdo->query($sql) as $row) {
						   		echo '<tr>';
						   		echo '<td>'. $row['id'] . '</td>';
							   	echo '<td>'. $row['name'] . '</td>';
							   	echo '<td>'. $row['gender'] . '</td>';
							   	echo '<td>'. $row['pokedollars'] . '</td>';
								echo '<td>'. $row['username'] . '</td>';
								echo '<td>'. $row['password'] . '</td>';
								echo '<td>'. $row['regionName'] . '</td>';
							   	echo '<td width=250>';
							   	echo '<a class="btn btn-info" href="read.php?id='.$row['id'].'">Read</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Update</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Delete</a>';
							   	echo '</td>';
							   	echo '</tr>';
					   }
					   Database::disconnect();
					  ?>
				      </tbody>
	            </table>
    	</div>
    </div> <!-- /container -->
  </body>
</html>