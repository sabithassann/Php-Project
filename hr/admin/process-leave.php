<?php
session_start();
require_once('../includes/db.php');
require_once('../includes/functions.php');

// Check if the admin is logged in; if not, redirect to the login page
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Check if the leave request id and status are provided as parameters
if (isset($_GET['id']) && isset($_GET['status'])) {
    $leaveRequestId = $_GET['id'];
    $status = $_GET['status'];

    // Update the leave request status in the database
    updateLeaveRequestStatus($pdo, $leaveRequestId, $status);

    // Redirect to the leave requests page or display a success message
    header("Location: leave-requests.php");
    exit();
} else {
    // If no leave request id and status are provided, redirect to the leave requests page or display an error message
    header("Location: leave-requests.php");
    exit();
}