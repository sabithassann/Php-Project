<?php
session_start();
require_once('../includes/db.php');
require_once('../includes/functions.php');

// Check if the employee is logged in; if not, redirect to the login page
if (!isset($_SESSION['employee'])) {
    header("Location: login.php");
    exit();
}

// Fetch the leave requests of the current employee
$leaveRequests = getEmployeeLeaveRequests($pdo,
$_SESSION['employee']);

?>



<!DOCTYPE html>
<html>
<head>
    <title>Leave Status</title>
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <div class="container">
        <br>
    <a href="employee.php" class="btn btn-primary">Employee page</a>

        <h1>Leave Status</h1>

        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Subject</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leaveRequests as $request): ?>
                    <tr>
                        <td><?= $request['subject'] ?></td>
                        <td><?= $request['description'] ?></td>
                        <td><?= $request['date'] ?></td>
                        <td>
                        <span style="color: black; padding: 3px 6px; border-radius: 3px; 
    <?php 
        if ($request['status'] === 'deny') {
            echo 'background-color: red;';
        } elseif ($request['status'] === 'grant') {
            echo 'background-color: green;';
        } elseif ($request['status'] === 'Pending') {
            echo 'background-color: yellow;';
        } 
    ?>"><?php echo $request['status']; ?></span>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS (optional, if you need JavaScript features) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>




<!-- <!DOCTYPE html>
<html>
<head>
    <title>Leave Status</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <h1>Leave Status</h1>

    <table>
        <tr>
            <th>Subject</th>
            <th>Description</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
        <?php foreach ($leaveRequests as $request): ?>
            <tr>
                <td><?= $request['subject'] ?></td>
                <td><?= $request['description'] ?></td>
                <td><?= $request['date'] ?></td>
                <td><?= $request['status'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html> -->