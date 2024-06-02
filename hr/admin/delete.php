<?php
session_start();
require_once('../includes/db.php');
require_once('../includes/functions.php');

// Check if the admin is logged in; if not, redirect to the login page
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Check if the employee id is provided as a parameter
if (isset($_GET['id'])) {
    $employeeId = $_GET['id'];

    // Delete the employee from the database
    deleteEmployee($pdo, $employeeId);

    // Redirect to the employee list page or display a success message
    header("Location: admin.php");
    exit();
} else {
    // If no employee id is provided, redirect to the employee list page or display an error message
    header("Location: admin.php");
    exit();
}