<?php include 'dashboardNav.php'; ?>

<?php
// another_page.php
session_start(); // Start or resume the session
include_once "../db_connection.php";

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; // Retrieve the username from the session variable
    $role = $_SESSION['role'];

    // Use the $username variable as needed in the dashboard
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $userID = $row['userID'];
            $firstName = $row['firstName'];
            $lastName = $row['lastName'];

            // Use the $userID variable to fetch data for each user
            $sql_payment = "SELECT * FROM requestPayment WHERE userID='$userID'";
            $paymentResult = mysqli_query($conn, $sql_payment);

            if (mysqli_num_rows($paymentResult) > 0) {
                while ($paymentRow = mysqli_fetch_assoc($paymentResult)) {
                    $amountPayment = $paymentRow['amountPayment'];
                    $paymentDate = $paymentRow['paymentDate'];
                    $paymentID = $paymentRow['paymentID'];
?>
                    <h1>Incoming Salary for <?php echo $firstName; ?> <?php echo $lastName; ?></h1>
                    <form action="balanceStatement.php" method="post">
                        <label for="amountPayment_<?php echo $paymentID; ?>">Amount Payment:</label><br>
                        <input type="text" id="amountPayment_<?php echo $paymentID; ?>" name="amountPayment" value="<?php echo $amountPayment; ?>" disabled><br><br>

                        <label for="paymentDate_<?php echo $paymentID; ?>">Payment Date:</label><br>
                        <input type="text" id="paymentDate_<?php echo $paymentID; ?>" name="paymentDate" value="<?php echo $paymentDate; ?>" disabled><br><br>

                        <label for="paymentMethod_<?php echo $paymentID; ?>">Payment Method:</label>
                        <select id="paymentMethod_<?php echo $paymentID; ?>" name="paymentMethod">
                            <option value="direct">Direct</option>
                            <option value="check">Check</option>
                        </select><br><br>

                        <input type="hidden" name="paymentID" value="<?php echo $paymentID; ?>"> <!-- Add a hidden input for payment ID -->
                        <input type="submit" value="Send" name="submit_payment_<?php echo $paymentID; ?>"> <!-- Use unique submit button names -->
                    </form>
<?php
                }
            } else {
                echo ("No data available for UserID: $userID");
            }
        }
    } else {
        echo ("No user data available.");
    }
}
?>