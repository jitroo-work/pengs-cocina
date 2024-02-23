<?php
	include("header.php");

	if (@$_SESSION['username']) {
		header('location:home.php');
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$username = isset($_POST['username']) ? $_POST['username'] : null;
		$password = isset($_POST['password']) ? $_POST['password'] : null;

		$dbError = mysqli_connect_errno();
		if ($dbError){ echo "Error: " . $dbError;}
		else { $message = login($db, $username, $password);}
	}

	function login($db, $username, $password) {
		$password = hash('sha512', $password);
		$query = "SELECT userid, username, password FROM users WHERE username='" . $username . "' AND password='" . $password . "';";

		$result = $db->query($query);
		$resultCount = $result->num_rows;

		if ($resultCount == 0) {
			$message = "Please enter the correct credentials.";
		} else {
			$result = $result->fetch_assoc();
			$_SESSION['username'] = $result['username'];
			loginWrite($username);
			header('location:home.php');
		}
		return $message;
	}


	function loginWrite($username) {
		$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];

		$file = fopen($DOCUMENT_ROOT."/pengs-cocina/logs.txt", "ab") or die("Unable to read file.");

		if ($file != null) {
			$date = new DateTime("now", new DateTimeZone('Asia/Manila'));
			$outputString = $username . "\n - logged in " .  $date->format('l jS \of F Y h:i:s a') . "\n";

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
			var element = document.getElementById("login");
			element.classList.add("active");
		}
	</script>

	<title>Login</title>
</head>
<body onload="onLoad()" class="text-center">
<div class="container-fluid">
	<div class="row title-bar">
		<div class="col-10">
			<h1>PENG'S COCINA</h1>
		</div>
	</div>
</div>

<?php include('topnav.php'); ?>
<div class="container-fluid">
	<div class="row login">
		<div class="col-8 coverphoto"></div>
		<div class="col-4 gradient">
			<h2 class="text-white"><center>LOG-IN</center></h2>
			<?php
				if (!empty($message)){
					echo "<div class='alert alert-primary' role='alert'>" . $message . "</div>";
				}
			?>
			<form action="login.php" method="post">
			<div class="form-group">
				<div class="form-floating">
					<input type="text" name="username" class="form-control" placeholder="username" required>
					<label for="floatingInput">Username</label>
				</div>
			</div>
			<br>
			<div class="form-group">
				<div class="form-floating">
					<input type="password" name="password" class="form-control" placeholder="password" required>
					<label for="floatingInput">Password</label>
				</div>
				<br>
				<button type="submit" class="btn-round btn-orange">Login</button>
			</form>
			</div>
		</div>
	</div>
</div>
<?php include("footer.php"); ?>
</body>
</html>
