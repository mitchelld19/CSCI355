<?php 
	require 'database.php';
	if (!empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	if(empty($_GET['id'])) {
		header("Location: index.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT Trainer.id, Trainer.name, Trainer.gender, Trainer.pokedollars, Trainer.username, Trainer.password, Region.name as regionName FROM Trainer JOIN Region ON Trainer.regionName = Region.id where Trainer.id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
	}
?>

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
			<h3>Read a Trainer</h3>
		</div>		
		<div class="form-horizontal" >
		  <div class="control-group">
		    <label class="control-label">Id</label>
		    <div class="controls">
			    <label class="checkbox">
			     	<?php echo $data['id'];?>
			    </label>
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label">Name</label>
		    <div class="controls">
		      	<label class="checkbox">
			     	<?php echo $data['name'];?>
			    </label>
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label">Gender</label>
		    <div class="controls">
		      	<label class="checkbox">
			     	<?php echo $data['gender'];?>
			    </label>
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label">Pokedollars</label>
		    <div class="controls">
		      	<label class="checkbox">
			     	<?php echo $data['pokedollars'];?>
			    </label>
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label">Username</label>
		    <div class="controls">
		      	<label class="checkbox">
			     	<?php echo $data['username'];?>
			    </label>
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label">Password</label>
		    <div class="controls">
		      	<label class="checkbox">
			     	<?php echo $data['password'];?>
			    </label>
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label">Region Name</label>
		    <div class="controls">
		      	<label class="checkbox">
			     	<?php echo $data['regionName'];?>
			    </label>
		    </div>
		  </div>
		    <div class="offset2">
			  <a class="btn" href="index.php">Back</a>
		   </div>
		</div>
	</div>	
  </body>
</html>