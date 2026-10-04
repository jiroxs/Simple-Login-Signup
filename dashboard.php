<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = "root";
$dbpassword = "";
$dbdatabase = "school";
$host = "localhost";

$conn = mysqli_connect($host, $username, $dbpassword, $dbdatabase);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./assets/css/index.css">
</head>
<body>
    <div class="header">
        <div class="navbar-item">
            <a href="dashboard.php">Dashboard</a>
            <a href="profile.php">Profile</a>
            <a href="settings.php">Settings</a>
            <a href="about.php">About</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <main>
        <div class="main-content">
            <h1>Welcome to the Dashboard</h1>
            <p>Good Evening! <?php echo $_SESSION['username']; ?>.</p>
            <div class="user-info">
                <h2>User Information</h2>
                <table border="1">
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Address</th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM students";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['username'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['address'] . "</td>";
                                echo "</tr>";
                            }
                    } else {
                        echo "<tr><td colspan='3'>No users found.</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2026 Your Company. All rights reserved.</p>
    </footer>
</body>
</html>