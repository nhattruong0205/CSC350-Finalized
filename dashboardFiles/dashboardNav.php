<!-- landingNav.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Navigation Bar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        li {
            float: left;
        }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover {
            background-color: #111;
        }
    </style>
</head>

<body>
    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="personalInfo.php">Personal Information</a></li>
        <li><a href="calPayRoll.php">Calculate Payroll</a></li>
        <li><a href="incomingSalary.php">Incoming salary</a></li>
        <li><a href="balanceStatement.php">Balance Statement</a></li>
        <li><a href="../landingFiles/landing.php">Log out</a></li>
    </ul>
</body>

</html>