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

    // Retrieve the employee details from the database
    $employee = getEmployeeById($pdo, $employeeId);

    // Handle form submission for updating the employee details
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the updated employee details from the form
        $updatedName = $_POST['name'];
        $updatedAddress = $_POST['address'];
        $updatedPhone = $_POST['phone'];
        $updatedPosition = $_POST['position'];
        $updatedEmail = $_POST['email'];

        // Update the employee details in the database
        updateEmployee($pdo, $employeeId, $updatedName, $updatedAddress, $updatedPhone, $updatedPosition, $updatedEmail);
        
        // Redirect to the employee list page or display a success message
        header("Location: admin.php");
        exit();
    }
} else {
    // If no employee id is provided, redirect to the employee list page or display an error message
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Employee</h1>

        <form action="edit.php?id=<?= $employeeId ?>" method="POST">
            <!-- Display the employee details in an editable form -->
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" value="<?= $employee['name'] ?>" required>
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" name="address" value="<?= $employee['address'] ?>" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" name="phone" value="<?= $employee['phone'] ?>" required>
            </div>

            <div class="form-group">
                <label for="position">Position:</label>
                <input type="text" class="form-control" name="position" value="<?= $employee['position'] ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" value="<?= $employee['email'] ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Employee</button>
        </form>
    </div>

    <!-- Bootstrap JS (optional, if you need JavaScript features) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
