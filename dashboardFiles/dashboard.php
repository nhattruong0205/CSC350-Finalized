<?php include 'dashboardNav.php'; ?>

<?php
session_start();
include_once "../db_connection.php";

if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
  $role = $_SESSION['role'];

  // Fetch additional user details from the database based on the session
  // (such as wage, gender, userID) and store them in variables

  // Display the dashboard content
  include 'landingNav.php'; // Include the navigation bar
?>
  <!-- Content for the Dashboard section -->
  <h2>Welcome, <?php echo $username; ?>!</h2>
  <h2>Your role is: <?php echo $role; ?></h2>

  <!-- Display other user details here -->
<?php
} else {
  header("Location: landingFiles/landing.php");
  exit();
}
?>