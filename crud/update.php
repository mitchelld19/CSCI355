<?php 
	
	require 'database.php';

	if (!empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	else{
		header("Location: index.php");
	}
	
	if ( !empty($_POST)) {
		// keep track validation errors
		$nameError = null;
		$usernameError = null;
		$passwordError = null;
		
		// keep track post values
		$name = $_POST['name'];
		$gender = $_POST['gender'];
		$pokedollars = $_POST['pokedollars'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$regionName = $_POST['regionName'];
		
		// validate input
		$valid = true;
		if (empty($name)) {
			$nameError = 'Please enter your Name';
			$valid = false;
		}

		if (empty($username)) {
			$usernameError = 'Please enter your Username';
			$valid = false;
		}
		
		if (empty($password)) {
			$usernameError = 'Please enter your Password';
			$valid = false;
		}
		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE Trainer set name = ?, gender = ?, pokedollars = ?, username = ?, password = ?, regionName = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($name, $gender, $pokedollars, $username, $password, $regionName, $id));
			Database::disconnect();
			header("Location: index.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM Trainer where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$name = $data['name'];
		$gender = $data['gender'];
		$pokedollars = $data['pokedollars'];
		$username = $data['username'];
		$password = $data['password'];
		$regionName = $data['regionName'];
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
			<h3>Update a Trainer</h3>
		</div>
		<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
		  <div class="control-group">
		    <label class="control-label">Name</label>
		    <div class="controls">
		      	<input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
		      	<?php if (!empty($nameError)): ?>
		      		<span class="help-inline"><?php echo $nameError;?></span>
		      	<?php endif; ?>
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label">Gender</label>
		    <div class="controls">
		      	<input type="radio" name="gender" value="M" checked="checked"> M<br>
				<input type="radio" name="gender" value="F"> F<br>
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label">Pokedollars</label>
		    <div class="controls">
		      	<input name="pokedollars" type="number"  placeholder="Pokedollars" value="<?php echo !empty($pokedollars)?$pokedollars:'';?>">
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label">Username</label>
		    <div class="controls">
		      	<input name="username" type="text" placeholder="Username" value="<?php echo !empty($username)?$username:'';?>">
		      	<?php if (!empty($usernameError)): ?>
		      		<span class="help-inline"><?php echo $usernameError;?></span>
		      	<?php endif;?>
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label">Password</label>
		    <div class="controls">
		      	<input name="password" type="text" placeholder="Password" value="<?php echo !empty($password)?$password:'';?>">
		      	<?php if (!empty($passwordError)): ?>
		      		<span class="help-inline"><?php echo $passwordError;?></span>
		      	<?php endif;?>
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label">Region Name</label>
		    <div class="controls">
			    <?php
	            	$pdo = Database::connect();
                    $sql = $pdo->prepare('SELECT * FROM Region');
				   	$sql->execute();
				    $data = $sql->fetchAll();
				?>
                <select name="regionName" id="regionName">
					<?php foreach ($data as $row): ?>
				    	<option value="<?=$row["id"]?>"><?=$row["name"]?></option>
				    <?php endforeach; 
				    Database::disconnect(); ?>
				</select>
			</div>
		  </div>
		  <div class="offset2">
			  <button type="submit" class="btn btn-success">Update</button>
			  <a class="btn btn-default" href="index.php">Back</a>
			</div>
		</form>		
    </div>
  </body>
</html>