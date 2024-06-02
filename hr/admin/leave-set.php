<?php
session_start();
require_once('../includes/db.php');
require_once('../includes/functions.php');

// Check if the admin is logged in; if not, redirect to the login page
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}



// Fetch all pending leave requests
$leaveRequests = getPendingLeaveRequests($pdo);

?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <div class="container">
    <a href="admin.php" class="btn btn-primary">Admin</a>

        <h2>Welcome Admin!</h2>
        <h2>Leave Requests</h2>
        <ul class="list-group">
            <?php foreach ($leaveRequests as $request): ?>
                <li class="list-group-item">
                <strong>Name:</strong> <?= $request['name'] ?><br>
                    <strong>Subject:</strong> <?= $request['subject'] ?><br>
                    <strong>Description:</strong> <?= $request['description'] ?><br>
                    <strong>Date:</strong> <?= $request['date'] ?><br>
                    <a href="process-leave.php?id=<?= $request['id'] ?>&status=grant" class="btn btn-success">Grant</a>
                    <a href="process-leave.php?id=<?= $request['id'] ?>&status=deny" class="btn btn-danger">Deny</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
