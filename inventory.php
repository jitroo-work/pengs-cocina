<?php
	include('header.php');

	$dbError = mysqli_connect_errno();
	if ($dbError){
		echo "Error: " . $dbError;
	} else {
		$query = "SELECT ItemID, ProductName, DateAcquired, DateExpiration, VendorName, Quantity, Price FROM items;";

		$result = $db->query($query);
		$resultCount = $result->num_rows;
	}
?>
<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript">
		function onLoad() {
			var element = document.getElementById("inventory");
			element.classList.add("active");
		}

		// Base code source taken from w3schools (https://www.w3schools.com/howto/howto_js_filter_table.asp)
		function searchInventory(){
			var input, filter, table, tr, td, i, txtValue;
		  	input = document.getElementById("searchInventoryText");
		 	filter = input.value.toUpperCase();
		  	table = document.getElementById("inventory-table");
		  	tr = table.getElementsByTagName("tr");

		  	// Loop through all table rows, and hide those who don't match the search query
		  	for (i = 0; i < tr.length; i++) {
		    	td = tr[i].getElementsByTagName("td")[1];
		    	if (td) {
		      		txtValue = td.textContent || td.innerText;
		      		if (txtValue.toUpperCase().indexOf(filter) > -1) {
		        		tr[i].style.display = "";
		      		} else {
		        		tr[i].style.display = "none";
		      		}
		    	}
		  	}
		}

		// Base code source taken from w3schools (https://www.w3schools.com/howto/howto_js_sort_table.asp)
		function sortTable(n) {
		  	var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
		  	table = document.getElementById("inventory-table");
		  	switching = true;
		  	dir = "asc";
		  	while (switching) {
		    	switching = false;
		    	rows = table.rows;
		    	for (i = 1; i < (rows.length - 1); i++) {
		      		shouldSwitch = false;
		      		x = rows[i].getElementsByTagName("TD")[n];
		      		y = rows[i + 1].getElementsByTagName("TD")[n];
		      		if (dir == "asc") {
						if (n != 0 && n != 5 && n != 6) {
							if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
			          			shouldSwitch = true;
			          			break;
			        		}
						} else {
							if (Number(x.innerHTML) > Number(y.innerHTML)) {
			          			shouldSwitch = true;
			          			break;
			        		}
						}
		      		} else if (dir == "desc") {
						if (n != 0 && n != 5 && n != 6) {
							if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
			          			shouldSwitch = true;
			          			break;
			        		}
						} else {
							if (Number(x.innerHTML) < Number(y.innerHTML)) {
			          		shouldSwitch = true;
			          		break;
			        		}
						}
		      		}
		    	}	

			    if (shouldSwitch) {
			      	rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
			      	switching = true;
			      	switchcount ++;
			    } else {
			    	if (switchcount == 0 && dir == "asc") {
			        	dir = "desc";
			        	switching = true;
			      	}
			    }
		  	}
		}
	</script>
	
	<title>INVENTORY</title>
</head>
<body onload="onLoad()">
<div class="container-fluid">
	<div class="row title-bar">
		<div class="col-10">
			<h1>INVENTORY</h1>
		</div>
	</div>
</div>

<?php include('topnav.php'); ?>
<div class="container-fluid"><br>
	<div class="input-group mb-3">
		<span class="input-group-text" id="search">Search</span>
		<input type="text" class="form-control" id="searchInventoryText" placeholder="Enter Product Name" aria-describedby="search" onkeyup="searchInventory()">
	</div>
	<table id="inventory-table" class="table table-hover ">
		<thead>
		    <tr class="table-primary">
			    <th scope="col" onclick="sortTable(0)"></th>
			    <th scope="col" onclick="sortTable(1)"><center>Product Name</center></th>
			    <th scope="col" onclick="sortTable(2)"><center>Date Acquired</center></th>
			    <th scope="col" onclick="sortTable(3)"><center>Date Expiration</center></th>
			    <th scope="col" onclick="sortTable(4)"><center>Vendor</center></th>
			    <th scope="col" onclick="sortTable(5)"><center>Quantity</center></th>
			    <th scope="col" onclick="sortTable(6)"><center>Price (₱)</center></th>
			    <th scope="col"><center>Actions</center></th>
		    </tr>
		</thead>
		<?php
			if (@$resultCount != 0) {
			for ($i = 0 ; $i < $resultCount ; $i++) {
			$row = $result->fetch_assoc();
		?>
		<tbody class="inventory-table">
			<tr>
		    	<td scope="row"><?php echo ($i + 1) ?></th>
		      <td align="center"><?php echo $row['ProductName']; ?></td>
		      <td align="center">
						<?php
							$dateAcquired=date_create($row['DateAcquired']);
							echo date_format($dateAcquired,"m/d/Y");
						?>
					</td>
		     	<td align="center">
						<?php
							if($row['DateExpiration'] == "0000-00-00")
							{
								echo "-";
							}
							else
							{
								$dateExpiration=date_create($row['DateExpiration']);
								echo date_format($dateExpiration,"m/d/Y");
							}
						?>
					</td>
		      <td align="center"><?php echo $row['VendorName']; ?></td>
		      <td align="center"><?php echo $row['Quantity']; ?></td>
		     	<td align="center"><?php echo $row['Price']; ?></td>
		     	<td align="center">
		     		<a href="delete.php?ItemID=<?php echo $row['ItemID']; ?>"><button class="btn btn-danger">Delete</button></a>
		     		<a href="edit.php?ItemID=<?php echo $row['ItemID']; ?>"><button class="btn btn-primary">Edit</button></a>
		     	</td>
		    </tr>
		<?php } }else { ?>
			<tr><td colspan='8'><center>No data.</center></td></tr>
		<?php } ?>
		</tbody>
	</table>
</div><br><br><br>
<?php include("footer.php"); ?>
</body>
</html>
