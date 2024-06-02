<?php
session_start();
require_once('../includes/db.php');
require_once('../includes/functions.php');

// Check if the employee is logged in; if not, redirect to the login page
if (!isset($_SESSION['employee'])) {
    header("Location: login.php");
    exit();
}

// Fetch the employee's details from the database
$employeeId = $_SESSION['employee'];
$employee = getEmployeeById($pdo, $employeeId);
?>





<!DOCTYPE html>
<html>
<head>
    <title>Employee Panel</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Your custom CSS file -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <br>
    <div class="container">
        <h1>Welcome to the Employee Panel</h1>
        <!-- Logout button -->
        <a href="logout.php" class="btn btn-danger">Logout</a>
<hr>
        <h2>Your Details</h2>
        <div class="row">
            <div class="col-md-3">
                <img src="../hr/<?= $employee['picture'] ?>" alt="Employee Picture" class="img-fluid">
            </div>
            <div class="col-md-9">
                <table class="table">
                    <tr>
                        <td>Name:</td>
                        <td><?= $employee['name'] ?></td>
                    </tr>
                    <tr>
                        <td>Address:</td>
                        <td><?= $employee['address'] ?></td>
                    </tr>
                    <tr>
                        <td>Phone:</td>
                        <td><?= $employee['phone'] ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <h1>Leave Request!</h1>
        <ul class="list-group">
            <li class="list-group-item"><a href="leave-request.php" class="btn btn-primary">Request Leave</a></li>
            <li class="list-group-item"><a href="leave-status.php" class="btn btn-info">Leave Status</a></li>
        </ul>
    </div>

    <!-- Bootstrap JS (optional, if you need JavaScript features) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


<!-- <!DOCTYPE html>
<html>
<head>
    <title>Employee Panel</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <h1>Welcome to the Employee Panel</h1>
     
      <a href="logout.php">Logout</a>

    <h2>Your Details</h2>
    <table>
        <tr>
        <td rowspan="4">
    <img src="../hr/<?= $employee['picture'] ?>" alt="Employee Picture" height="200" width="200">
</td>        <tr>
            <td>Name:</td>
            <td><?= $employee['name'] ?></td>
        </tr>
        <tr>
            <td>Address:</td>
            <td><?= $employee['address'] ?></td>
        </tr>
        <tr>
            <td>Phone:</td>
            <td><?= $employee['phone'] ?></td>
        </tr>
    </table>


    <h1>Leave Request!</h1>

<ul>
    <li><a href="leave-request.php">Request Leave</a></li>
    <li><a href="leave-status.php">Leave Status</a></li>
</ul>
</body>
</html> -->