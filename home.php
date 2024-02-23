<?php
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

	include("header.php");

	if (@!$_SESSION['username']) {
		header('location:login.php');
	}

	$dbError = mysqli_connect_errno();
	if ($dbError){
		echo "Error: " . $dbError;
	} else {
		$query = "SELECT ItemID, ProductName, Description, DateAcquired, DateExpiration, VendorName, Quantity, Price FROM items;";

		$result = $db->query($query);
		$resultCount = $result->num_rows;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script type="text/javascript">
		window.onload = function () {
			var element = document.getElementById("home");
			element.classList.add("active");
			var chart = new CanvasJS.Chart("chartContainer", {
				theme: "light2",
				title:{
					text: "Current Inventory"
				},
				data: [              
				{
					// Change type to "doughnut", "line", "splineArea", etc.
					type: "column",
					dataPoints: [
					<?php
						if (@$resultCount != 0) { 
						for ($i = 0 ; $i < $resultCount ; $i++) { 
						$row = $result->fetch_assoc();
					?>
						{ label: <?php echo '"'.$row['ProductName'].'"'; ?>,  y: <?php echo $row['Quantity']; ?>  },
							
					<?php }} else { ?>No data. <?php } ?>
					]}
				]	
			});
			chart.render();
		}
	</script>

	<title>HOME</title>
</head>
<body class="text-center">
<div class="container-fluid">
	<div class="row title-bar">
		<div class="col-10">
			<h1>PENG'S COCINA</h1>
		</div>	
	</div>
</div>

<?php include('topnav.php'); ?>

<div class="container-fluid"><br><br>
	<div id="chartContainer" style="height: 300px; width: 100%;"></div>
</div>
	<?php include("footer.php"); ?>	
</body>
</html>