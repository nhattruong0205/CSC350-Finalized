<?php include 'dashboardNav.php'; ?>

<?php
// another_page.php
session_start(); // Start or resume the session
include_once "../db_connection.php";

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; // Retrieve the username from the session variable
    $role = $_SESSION['role'];

    // Use the $username variable as needed in the dashboard
    $sql = "SELECT * FROM jobs WHERE jobName='$role'";
    $result = mysqli_query($conn, $sql);

    $wage = "";
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $wage = $row['wages'];
    } else {
        $wage = "No wage data available for this role.";
    }
}
?>

<!-- Content for the Calculate Payroll section -->
<h1>Calculate Payroll</h1>
<label for="hours">Hours Worked:</label><br>
<input type="number" id="hours" min="0"><br><br>

<button onclick="calculateWage(<?php echo $wage; ?>)">Calculate</button> <!-- Pass the wage as an argument -->

<p id="result"></p>

<!-- Include the JavaScript file -->
<script src="../js/wageCalculator.js"></script>