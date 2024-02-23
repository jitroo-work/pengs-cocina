<?php
	include('header.php');

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$prod_name = isset($_POST['ProductName']) ? $_POST['ProductName'] : null;
		$desc = isset($_POST['Description']) ? $_POST['Description'] : null;
		$date_Exp = isset($_POST['DateExpiration']) ? $_POST['DateExpiration'] : null;
		$vend_name = isset($_POST['VendorName']) ? $_POST['VendorName'] : null;
		$qty = isset($_POST['Quantity']) ? $_POST['Quantity'] : null;
		$price = isset($_POST['Price']) ? $_POST['Price'] : null;

		$dbError = mysqli_connect_errno();
		if ($dbError){
			echo "Error: " . $dbError;
		} else {
			if (!empty($prod_name)){
				$message = addItem($db, $prod_name, $desc, $date_Exp, $vend_name, $qty, $price);
			}
		}
	}

	function addItem($db, $prod_name, $desc, $date_Exp, $vend_name, $qty, $price) {
		$query = "INSERT INTO items(ProductName, Description, DateExpiration, VendorName, Quantity, Price) VALUES ('" . $prod_name . "','" . $desc . "','" . $date_Exp . "','" . $vend_name . "','" . $qty . "','" . $price . "');";

		$result = $db->query($query);

		if (@empty($result)) {
			$message = "Already in Inventory";
		} else {
			successAdd($prod_name);
			$message = "Successfully Added to Inventory";
		}
		return $message;
	}

	function successAdd($prod_name) {
		$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];

		$file = fopen($DOCUMENT_ROOT."/pengs-cocina/logs.txt", "ab") or die("Unable to read file.");

		if ($file != null) {
			$date = new DateTime("now", new DateTimeZone('Asia/Manila'));
			$outputString = " - ". $prod_name . " added this " .  $date->format('l jS \of F Y h:i:s a') .  "\n";

			fwrite($file, $outputString, strlen($outputString));
		}
		fclose($file);
	}
?>
<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript">
		function onLoad() {
			var element = document.getElementById("add");
			element.classList.add("active");
			document.getElementById('itemForm').reset();
		}

		function displayQuestion(answer){
	      if (answer.value == "Yes") {
	        document.getElementById('yesQuestion').style.display = 'block';
	      }else{
	        document.getElementById('yesQuestion').style.display = 'none';
	      }
	    }
	</script>

	<title>FORM</title>
</head>
<body onload="onLoad()">
<div class="container-fluid">
	<div class="row title-bar">
		<div class="row">
			<div class="col-auto"><h1>PENG'S COCINA</h1></div>
		</div>
	</div>
</div>

<?php include('topnav.php'); ?>
<div class="container">
	<?php
		if (!empty($message)){
			echo "<div class='alert alert-primary' role='alert'>" . $message . "</div>";
		}
	?>
	<div class="card">
	<center><h4 class="card-header bg-dark text-white">Product Information</h4></center>
		<div class="card-body">
			<form id="itemForm" action="form.php" method="POST">
				<div class="form-group">
					<div class="form-floating">
						<input type="text" name="ProductName" class="form-control" placeholder="name" required>
						<label for="floatingInput">Product</label>
					</div>
				</div>
				<br>
				<div class="form-group">
					<div class="form-floating">
						<input type="text" name="Description" class="form-control" placeholder="name" required>
						<label for="floatingInput">Description</label>
					</div>
				</div>
				<br>
				<div class="form-group btn-group">
				  	<label class="col-lg-12 col-form-label text-dark" style="margin-right: 20px;"> Perishable </label>
			        <div class="col-sm-5">
			          <select id="isPerish" name="isPerish" class="btn btn-light dropdown-toggle" onchange="displayQuestion(this)" style="padding: 0px, 20px, 0px, 20px;">
			          		<option value="" selected disabled hidden> Yes or No </option>
			              	<option value="Yes">Yes</option>
			              	<option value="No">No</option>
			          </select><br>
			        </div>
				</div>
				<br>
				<div id="yesQuestion" class="form-group" style="display: none;">
					<br>
					<div class="form-floating">
						<input type="date" name="DateExpiration" class="form-control" placeholder="name">
						<label for="floatingInput">Expiration</label>
					</div>
				</div>
				<br>
				<div class="form-group">
					<div class="form-floating">
						<input type="text" name="VendorName" class="form-control" placeholder="name" required>
						<label for="floatingInput">Vendor</label>
					</div>
				</div>
				<br>
				<div class="form-group">
					<div class="form-floating">
						<input type="number" name="Quantity" class="form-control" placeholder="name" min="1" required>
						<label for="floatingInput">Quantity</label>
					</div>
				</div>
				<br>
				<div class="form-group">
					<div class="form-floating">
						<input type="number" name="Price" class="form-control" placeholder="name" min="1" required>
						<label for="floatingInput">Price (Php)</label>
					</div>
				</div>
		</div>
		<div class="card-footer">
			<button type="submit" class="btn btn-primary right">Submit</button>
			<button type="reset" class="btn btn-secondary">Reset</button>
			</form>
		</div>
	</div><br>
</div>
<?php include("footer.php"); ?>
</body>
</html>
