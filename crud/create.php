<?php 
	
	require 'database.php';

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
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO Trainer (name, gender, pokedollars, username, password, regionName) values(?, ?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($name, $gender, $pokedollars, $username, $password, $regionName));
			Database::disconnect();
			header("Location: index.php");
		}
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
			<h3>Create a Trainer</h3>
		</div>
		<form class="form-horizontal" action="create.php" method="post">
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
			  <button type="submit" class="btn btn-success">Create</button>
			  <a class="btn btn-default" href="index.php">Back</a>
			</div>
		</form>
    </div> 
  </body>
</html>