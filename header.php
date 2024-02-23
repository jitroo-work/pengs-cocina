<?php
	session_start();
	require('connection/properties.php');
	$db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

	function addWrite() {
	$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];

	$file = fopen($DOCUMENT_ROOT."/SYSINARC/logs.txt", "ab") or die("Unable to read file.");

	if ($file != null) {
		$date = new DateTime("now", new DateTimeZone('Asia/Manila'));
		$outputString = " - added an item to cart on " .  $date->format('l jS \of F Y h:i:s A') . " at " . $_SERVER['REMOTE_ADDR'] . "\n";

		fwrite($file, $outputString, strlen($outputString));
		}
	}

	function outFunction() {
		$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];

		$file = fopen($DOCUMENT_ROOT."/pengs-cocina/logs.txt", "ab") or die("Unable to read file.");

		if ($file != null) {
			$date->set_timezone(new timezone_open('Asia/Manila'));
			$outputString = " - logged out " .  $date->format('l jS \of F Y h:i:s A') . "\n\n";

			fwrite($file, $outputString, strlen($outputString));
		}
		fclose($file);
	}
?>

<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="css/style.css">

<!-- Bootstrap CSS & JS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
	<link href="/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<!-- Bootstrap icons -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/montserrat.css">
	<link rel="icon" href="img/logo.png" type="images/icon">

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
