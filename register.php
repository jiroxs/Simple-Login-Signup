<?php
session_start();
if (isset($_SESSION['username'])) {
	header("Location: dashboard.php");
	exit();
}

$dbusername = "root";
$dbpassword = "";
$database = "school";
$host = "localhost";

$conn = mysqli_connect($host, $dbusername, $dbpassword, $database);

if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $sql = "SELECT * FROM students WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Username already exists. Please choose a different username.');</script>";
    } else {
        $sql = "INSERT INTO students (username, password, email, address) VALUES ('$username', '$password', '$email', '$address')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Registration successful! You can now log in.'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    }

}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Signup</title>
	<link rel="stylesheet" href="./assets/css/main.css">
</head>
<body>
	<div class="Signup-Form">
		<form method="POST">
			<h1>Sign Up</h1>
			<label for="username">Username:</label>
			<input type="text" name="username" placeholder="Enter Your Username" required>

			<label for="password">Password:</label>
			<input type="password" name="password" placeholder="Enter Your Password" required>

            <label for="email">Email:</label>
			<input type="email" name="email" placeholder="Enter Your Email" required>

			<label for="address">Address:</label>
			<input type="text" name="address" placeholder="Enter Your Address" required>

			<button type="submit" name="signup">Sign Up</button>

			<hr>

			<p>Already have an account? <a href="login.php">Login here</a></p>
		</form>
	</div>
</body>
</html>