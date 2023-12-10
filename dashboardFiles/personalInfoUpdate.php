<?php include 'dashboardNav.php'; ?>

<?php
session_start(); // Start or resume the session
include_once "../db_connection.php"; // Include the database connection file

// Check if the username is set in the session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; // Retrieve the username from the session variable
    $role = $_SESSION['role'];
}

// Use the $username variable as needed in the dashboard
$sql = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $userID = $row['userID'];
    $firstName = $row['firstName'];
    $lastName = $row['lastName'];
    $dob = $row['dob'];
    $gender = $row['gender'];
    $username = $row['username'];
    $phone = $row['phone'];
} else {
    echo ("No data available for this.");
}

// Close the database connection
mysqli_close($conn);
?>

<form action="personalInfo.php" method="post">
    <label for="firstName">First name:</label><br>
    <input type="text" id="firstName" name="firstName" value="<?php echo $firstName; ?>"> <br><br>

    <label for="lastName">Last name:</label><br>
    <input type="text" id="lastName" name="lastName" value="<?php echo $lastName; ?>"> <br><br>


    <label for="dob">Date of Birth:</label><br>
    <input type="date" id="dob" name="dob" value="<?php echo $dob; ?>"> <br><br>

    <label for="gender">Gender:</label><br>
    <input type="radio" id="male" name="gender" value="male" <?php echo ($gender === 'Male') ? 'checked' : ''; ?>>
    <label for="male">Male</label>
    <input type="radio" id="female" name="gender" value="female" <?php echo ($gender === 'Female') ? 'checked' : ''; ?>>
    <label for="female">Female</label><br><br>


    <label for="phone">Phone Number:</label><br>
    <input type="tel" id="phone" name="phone" value="<?php echo $phone; ?>"> <br><br>

    <input type="button" id="editBtn" value="Cancel" onclick="redirectToEditPage()">
    <input type="submit" id="editBtn" value="Update">
</form>

<a href="dashboard.php" class="back-button">Back</a>


<script>
    function redirectToEditPage() {
        // Replace 'personalInfoUpdate.php' with the desired edit page URL
        window.location.href = 'personalInfo.php';
    }
</script>