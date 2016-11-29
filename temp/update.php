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
		$qtyError = null;
		$priceError = null;
		
		// keep track post values
		$name = $_POST['name'];
		$qty = $_POST['qty'];
		$price = $_POST['price'];
		
		// validate input
		$valid = true;
		if (empty($name)) {
			$nameError = 'Please enter Name';
			$valid = false;
		}
		
		if (empty($qty)) {
			$qtyError = 'Please enter Quantity';
			$valid = false;
		}
				
		if (empty($price)) {
			$priceError = 'Please enter Price';
			$valid = false;
		}
		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE Product  set name = ?, qty = ?, price =? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$qty,$price,$id));
			Database::disconnect();
			header("Location: index.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM Product where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$name = $data['name'];
		$qty = $data['qty'];
		$price = $data['price'];
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
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Update a Product</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
					  <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
					    <label class="control-label">Name</label>
					    <div class="controls">
					      	<input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
					      	<?php if (!empty($nameError)): ?>
					      		<span class="help-inline"><?php echo $nameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($qtyError)?'error':'';?>">
					    <label class="control-label">Quantity</label>
					    <div class="controls">
					      	<input name="qty" type="number" placeholder="Quantity" value="<?php echo !empty($qty)?$qty:'';?>">
					      	<?php if (!empty($qtyError)): ?>
					      		<span class="help-inline"><?php echo $qtyError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($priceError)?'error':'';?>">
					    <label class="control-label">Price</label>
					    <div class="controls">
					      	<input name="price" type="number" step="0.01"  placeholder="Price" value="<?php echo !empty($price)?$price:'';?>">
					      	<?php if (!empty($priceError)): ?>
					      		<span class="help-inline"><?php echo $priceError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Update</button>
						  <a class="btn" href="index.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>