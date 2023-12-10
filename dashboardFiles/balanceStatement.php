<?php include 'dashboardNav.php'; ?>

<?php
session_start();
include_once "../db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'submit_payment_') !== false) {
            $paymentID = substr($key, strlen('submit_payment_'));

            // Retrieve the actual paymentID associated with this form submission
            $actualPaymentID = $_POST['paymentID'];
        }
    }
}

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; // Retrieve the username from the session variable
    $role = $_SESSION['role'];
    $userID = $_SESSION['userID'];
    // Use the $username variable as needed in the dashboard
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userID = $row['userID'];
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
    }

    $sql = "SELECT * FROM balance WHERE userID='$userID'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $total = $row['total'];
        $balanceID = $row['balanceID'];
    }
}

if (isset($_POST['submit_payment_' . $actualPaymentID])) {
    $sql = "SELECT * FROM requestPayment WHERE paymentID='$actualPaymentID'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $amountPayment = $row['amountPayment'];
        $paymentMethod = $row['paymentMethod'];
        $paymentDate = $row['paymentDate'];
    }
?>
    <h2>You just received your salary as a <?php echo $role; ?> </h2>

    <h2>Amount you received is: <?php echo $amountPayment; ?> on <?php echo $paymentDate; ?></h2>
<?php
    $total = $total + $amountPayment;
    $updateSql = "UPDATE balance SET total='$total' WHERE balanceID='$balanceID'";
    if (mysqli_query($conn, $updateSql)) {
        echo "<script>alert('Balance updated');</script>";
    } else {
        echo "Error updating total: " . mysqli_error($conn);
    }

    $deleteSql = "DELETE FROM requestPayment WHERE paymentID='$actualPaymentID'";
    if (mysqli_query($conn, $deleteSql)) {
        echo "<script>alert('Salary Received');</script>";
    } else {
        echo "Error deleting row: " . mysqli_error($conn);
    }
}
?>

<h2>Your current balance is now: <?php echo $total; ?></h2>