<?php
session_start();
if (isset($_SESSION['username'])) {
	header("Location: dashboard.php");
	exit();
}
$username = "root";
$dbpassword = "";
$dbdatabase = "school";
$host = "localhost";

$conn = mysqli_connect($host, $username, $dbpassword, $dbdatabase);

if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM students WHERE username='$username'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) == 1) {
		$row = mysqli_fetch_assoc($result);
		if ($row['password'] == $password) {
			$_SESSION['username'] = $username;
			header("Location: dashboard.php");
			exit();
		} else {
			echo "<script>alert('Invalid password. Please try again.');</script>";
		}
	} else {
		echo "<script>alert('Invalid username. Please try again.');</script>";
	}
}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" href="./assets/css/main.css">
</head>
<body>
	<div class="Login-Form">
		<form method="POST">
			<h1>Login</h1>
			<label for="username">Username:</label>
			<input type="text" name="username" placeholder="Enter Your Username" required>

			<label for="password">Password:</label>
			<input type="password" name="password" placeholder="Enter Your Password" required>

			<button type="submit" name="login">Login</button>

			<hr>

			<p>Don't have an account? <a href="register.php">Register here</a></p>
		</form>
	</div>

</script>
</body>
</html>