<?php
	include('header.php');

	$ItemID = isset($_GET['ItemID']) ? $_GET['ItemID'] : 0;

	$dbError = mysqli_connect_errno();

	if ($dbError){
		echo "Error: " . $dbError;
	} else {
		if($ItemID !=0){
			$query = "DELETE FROM items WHERE ItemID=". $ItemID . ";";
			$db->query($query);
		}
	}
	header('location: inventory.php')
?>