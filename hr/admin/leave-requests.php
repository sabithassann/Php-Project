<?php
session_start();
require_once('../includes/db.php');
require_once('../includes/functions.php');

// Check if the admin is logged in; if not, redirect to the login page
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Fetch all leave requests
$leaveRequests = getAllLeaveRequests($pdo);

?>




<!DOCTYPE html>
<html>
<head>
    <title>All Leave Requests</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Your custom CSS file -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>All Leave Requests</h1>

        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leaveRequests as $request): ?>
                    <tr>
                        <td><?= $request['name'] ?></td>
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
                                ?>">
                                <?= $request['status'] ?>
                            </span>
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
    <title>All Leave Requests</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <h1>All Leave Requests</h1>

    <ul>
        <?php foreach ($leaveRequests as $request): ?>
            <li>
                <strong>Name:</strong> <?= $request['name'] ?><br>
                <strong>Subject:</strong> <?= $request['subject'] ?><br>
                <strong>Description:</strong> <?= $request['description'] ?><br>
                <strong>Date:</strong> <?= $request['date'] ?><br>
                <strong>Status:</strong> <?= $request['status'] ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html> -->