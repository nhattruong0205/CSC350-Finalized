<?php include 'landingNav.php'; ?>

<?php
session_start(); // Start or resume a session
include_once "db_connection.php"; // Include the database connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstName = $_POST["firstName"];
  $lastName = $_POST["lastName"];
  $dob = $_POST["dob"];
  $gender = $_POST["gender"];
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"]; // Note: Consider encrypting passwords for security
  $phone = $_POST["phone"];
  $role = $_POST["role"];

  // Initilize error
  $errors = [];

  // Check if the username already exists
  $checkUsernameQuery = "SELECT * FROM users WHERE username = '$username'";
  $resultUsername = mysqli_query($conn, $checkUsernameQuery);

  if (mysqli_num_rows($resultUsername) > 0) {
    $errors[] = "Username already exists. Please choose a different username.";
  }

  $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
  $resultEmail = mysqli_query($conn, $checkEmailQuery);

  if (mysqli_num_rows($resultEmail) > 0) {
    $errors[] = "Email already used. Please choose a different email.";
  }

  $checkPhoneQuery = "SELECT * FROM users WHERE phone = '$phone'";
  $resultPhone = mysqli_query($conn, $checkPhoneQuery);

  if (mysqli_num_rows($resultPhone) > 0) {
    $errors[] = "This phone number is already used. Please choose a different phone number.";
  }

  if (!empty($errors)) {
    foreach ($errors as $error) {
      echo $error . "<br>";
    }
  } else {
    $sql = "INSERT INTO 
        users (firstName, lastName, dob, gender, username, email, password, phone, role) 
        VALUES ('$firstName', '$lastName', '$dob', '$gender', '$username', '$email', '$password', '$phone', '$role')";

    if (mysqli_query($conn, $sql)) {
      echo 'New record created successfully';
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }
}
// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
  <title>User Signup</title>
  <link rel="stylesheet" href="css/login-register.css"> <!-- Link to your external CSS file -->
</head>

<body>
  <div class="header">
    <img src="image/kenjonha-logo.png" alt="logo" style="width:50%;">
  </div>
  <h2>Sign Up</h2>
  <form action="register.php" method="post">
    <label for="firstName">First name:</label>
    <input type="text" id="firstName" name="firstName"><br><br>

    <form action="register.php" method="post">
      <label for="lastName">Last name:</label>
      <input type="text" id="lastName" name="lastName"><br><br>

      <label for="dob">Date of Birth:</label>
      <input type="date" id="dob" name="dob"><br><br>

      <label for="gender">Gender:</label>
      <input type="radio" id="male" name="gender" value="male">
      <label for="male">Male</label>
      <input type="radio" id="female" name="gender" value="female">
      <label for="female">Female</label><br>

      <label for="username">Username:</label>
      <input type="text" id="username" name="username"><br><br>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email"><br><br>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password"><br><br>

      <label for="phone">Phone Number:</label>
      <input type="tel" id="phone" name="phone"><br><br>

      <label for="role">Role of Job:</label>
      <select id="role" name="role">
        <option value="engineer">Engineer</option>
        <option value="designer">Designer</option>
        <option value="manager">Manager</option>
      </select><br><br>

      <input type="submit" value="Sign Up"><br>

      <a href="landingFiles/landing.php" class="back-button">Back</a>
    </form>
</body>

</html>