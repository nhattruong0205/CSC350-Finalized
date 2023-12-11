<?php include 'landingNav.php'; ?>

<?php
session_start(); // Start or resume a session
include_once "db_connection.php"; // Include the database connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate login (In a real scenario, you'd hash passwords and check against a database)
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Correct username and password
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $username; // Store username in session variable
        $_SESSION['role'] = $row['role']; // Store role in session variable
        header("Location: dashboardFiles/dashboard.php");
        exit();
    } else {
        // Invalid username or password
        echo "Invalid username or password. Please try again.";
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/button.css"> <!-- Link to your external CSS file -->
    <link rel="stylesheet" href="css/styles.css"> <!-- Link to your external CSS file -->
</head>

<body>
    <div class="fade-in-image" style="text-align: center;">
        <img src="image/kenjonha-logo.png" alt="logo" style="width:50%;">
    </div>
    <div style="text-align: center;">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username"><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password"><br><br>

            <input type="submit" class="login" value="Login"><br>
            <a href="landingFiles/landing.php" class="back-button">Back</a>

    </div>

    </div>
</body>

</html>

<br><br>