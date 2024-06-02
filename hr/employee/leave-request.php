<?php
session_start();
require_once('../includes/db.php');
require_once('../includes/functions.php');

// Check if the employee is logged in; if not, redirect to the login page
if (!isset($_SESSION['employee'])) {
    header("Location: login.php");
    exit();
}

// Handle form submission for leave request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject = $_POST['subject'];
    $description = $_POST['description'];
    $date = $_POST['date'];

    // Save the leave request in the database
    saveLeaveRequest($pdo, $_SESSION['employee'], $subject, $description, $date);

    // Redirect to the leave status page or display a success message
    header("Location: leave-status.php");
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Leave Request</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Your custom CSS file -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Leave Request</h1>

        <form action="leave-request.php" method="POST">
            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" class="form-control" name="subject" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" name="description" rows="5" required></textarea>
            </div>

            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" class="form-control" name="date" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit Request</button>
        </form>
    </div>

    <!-- Bootstrap JS (optional, if you need JavaScript features) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


<!-- <!DOCTYPE html>
<html>
<head>
    <title>Leave Request</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <h1>Leave Request</h1>

    <form action="leave-request.php" method="POST">
        <label for="subject">Subject:</label>
        <input type="text" name="subject" required><br>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea><br>

        <label for="date">Date:</label>
        <input type="date" name="date" required><br>

        <input type="submit" value="Submit Request">
    </form>
</body>
</html> -->