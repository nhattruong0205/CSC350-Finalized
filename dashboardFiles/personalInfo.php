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
    $email = $row['email'];
    $password = $row['password'];
    $phone = $row['phone'];
    $role = $row['role'];
} else {
    echo ("No data available for this.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the updated form data
    $newFirstName = $_POST['firstName'];
    $newLastName = $_POST['lastName'];
    $newDob = $_POST['dob'];
    $newGender = $_POST['gender'];
    $newPhone = $_POST['phone'];
    $olduserID = $userID;

    // Update the database with the new information
    $sqlUpdate = "UPDATE users
                        SET firstName = '$newFirstName',
                        lastName = '$newLastName',
                        dob = '$newDob',
                        gender = '$newGender',
                        phone = '$newPhone'
                  WHERE userID = '$olduserID'";

    // Execute the query
    if (mysqli_query($conn, $sqlUpdate)) {
        // If the update was successful, redirect to a success page or reload the current page
        echo ("Modified successfully!");
    } else {
        // If there was an error with the query
        echo "Error updating record: " . mysqli_error($conn);
    }
}
// Close the database connection
mysqli_close($conn);
?>

<form action="personalInfo.php" method="post">
    <label for="firstName">First name:</label><br>
    <input type="text" id="firstName" name="firstName" value="<?php echo $firstName; ?>" disabled><br><br>

    <label for="lastName">Last name:</label><br>
    <input type="text" id="lastName" name="lastName" value="<?php echo $lastName; ?>" disabled><br><br>


    <label for="dob">Date of Birth:</label><br>
    <input type="date" id="dob" name="dob" value="<?php echo $dob; ?>" disabled><br><br>

    <label for="gender">Gender:</label><br>
    <input type="radio" id="male" name="gender" value="male" <?php echo ($gender === 'Male') ? 'checked disabled' : 'disabled'; ?>>
    <label for="male">Male</label>
    <input type="radio" id="female" name="gender" value="female" <?php echo ($gender === 'Female') ? 'checked disabled' : 'disabled'; ?>>
    <label for="female">Female</label><br><br>

    <label for="phone">Phone Number:</label><br>
    <input type="tel" id="phone" name="phone" value="<?php echo $phone; ?>" disabled><br><br>

    <input type="button" id="editBtn" value="Edit" onclick="toggleEdit()">
    <input type="submit" value="Update" style="display: none;">
</form>

<a href="dashboard.php" class="back-button">Back</a>


<script>
    function toggleEdit() {
        const editBtn = document.getElementById('editBtn');
        const textInputs = document.querySelectorAll('input[type="text"], input[type="date"]');
        const genderInputs = document.querySelectorAll('input[type="radio"]');
        const submitBtn = document.querySelector('input[type="submit"]');

        if (editBtn.value === 'Edit') {
            editBtn.value = 'Cancel';
            submitBtn.style.display = 'inline';
            textInputs.forEach(input => input.removeAttribute('disabled'));
            genderInputs.forEach(input => input.removeAttribute('disabled'));
        } else {
            editBtn.value = 'Edit';
            submitBtn.style.display = 'none';
            textInputs.forEach(input => input.setAttribute('disabled', 'true'));
            genderInputs.forEach(input => input.setAttribute('disabled', 'true'));
        }
    }
</script>