<?php
	include("header.php");
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$dbError = mysqli_connect_errno();

	$ItemID = isset($_POST['id']) ? $_POST['id'] : $_GET['ItemID'];
	$name = isset($_POST['newName']) ? $_POST['newName'] : null;
	$desc = isset($_POST['newDesc']) ? $_POST['newDesc'] : null;
	$qty = isset($_POST['newQty']) ? $_POST['newQty'] : null;
	$price = isset($_POST['newPrice']) ? $_POST['newPrice'] : null;

	if($name != null && $qty != null && $price != null){
		$message = updateRecord($db, $ItemID, $name, $desc, $qty, $price);
	}

	function viewRecord($db, $ItemID){
		$dbError = mysqli_connect_errno();

		if ($dbError){
			echo "Error: " . $dbError;
		} else {
			$query = "SELECT ProductName, Description, Quantity, Price FROM items WHERE ItemID =" . $ItemID . ";";

			$result = $db->query($query);
			@$row = $result->fetch_assoc();
			return $row;
		}
	}

	function updateRecord($db, $ItemID, $name, $desc, $qty, $price){
		$dbError = mysqli_connect_errno();

		if ($dbError){
		echo "Error: " . $dbError;
		} else {
			$query = "UPDATE Items SET ProductName='" . $name . "', Description='" . $desc . "', Quantity='" . $qty . "', Price='" . $price. "' WHERE ItemID=" . $ItemID . ";";

			$result = $db->query($query);
			$message = "Successfully Updated!";

		} return $message;
	}	$row = viewRecord($db, $ItemID);
?>

<!DOCTYPE html>
<html>
<head>
	<title>EDIT ITEM</title>
</head>
<body>
<div class="container-fluid">
	<div class="row title-bar">
		<div class="row">
			<div class="col-auto">
				<button type="button" class="btn btn-secondary back" onclick="window.location.href='inventory.php'">Back</button>
			</div>
			<div class="col-auto"><h1>PENG'S COCINA</h1></div>
		</div>
	</div>
</div>
<div class="container">
	<?php
		if (!empty($message)){
			echo "<div class='alert alert-success' role='alert'>" . $message . "</div>";
		}
	?>
	<div class="card">
		<div class="card-header"><b><center>Edit Product</center></b></div>
		<div class="card-body">
			<form action="edit.php?ItemID=<?php echo $ItemID; ?>" method="post">
				<input type="hidden" name="ItemID" value="<?php echo $ItemID;?>">
				<div class="form-group">
					<div class="form-floating">
						<input type="text" name="newName" value="<?php echo $row['ProductName']; ?>" class="form-control" placeholder="name" required>
						<label for="floatingInput">Product</label>
					</div>
				</div>
				<br>
				<div class="form-group">
					<div class="form-floating">
						<input type="text" name="newDesc" value="<?php echo $row['Description']; ?>" class="form-control" placeholder="name" required>
						<label for="floatingInput">Description</label>
					</div>
				</div>
				<br>
				<div class="form-group">
					<div class="form-floating">
						<input type="text" name="newQty" value="<?php echo $row['Quantity']; ?>" class="form-control" placeholder="name" required>
						<label for="floatingInput">Quantity</label>
					</div>
				</div>
				<br>
				<div class="form-group">
					<div class="form-floating">
						<input type="text" name="newPrice" value="<?php echo $row['Price']; ?>" class="form-control" placeholder="name" required>
						<label for="floatingInput">Price</label>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<button type="submit" class="btn btn-primary right">Submit</button>
			</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>
