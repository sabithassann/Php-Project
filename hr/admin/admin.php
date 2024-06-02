<?php
session_start();
require_once('../includes/db.php');
require_once('../includes/functions.php');

// Check if the admin is logged in; if not, redirect to the login page
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Fetch all employees' details from the database
$employees = getAllEmployees($pdo);


// Fetch all pending leave requests
$leaveRequests = getPendingLeaveRequests($pdo);

// Count the number of pending leave requests
$pendingLeaveCount = count($leaveRequests);
?>




<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Your custom CSS file -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to the Admin Panel</h1>
        <a href="logout.php" class="btn btn-danger">Logout</a>
        <a href="leave-requests.php" class="btn btn-primary">Leave Status</a>
        <a href="leave-set.php" class="btn btn-primary">Pending Leave<?php if ($pendingLeaveCount > 0) { echo " ($pendingLeaveCount)"; } ?></a>
        <h2>Employee List</h2>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Position</th>
                    <th>Email</th>
                    <th>Photo</th>
                    <th>Action</th>
                    
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $employee) { ?>
                    <tr>
                        <td><?= $employee['name'] ?></td>
                        <td><?= $employee['address'] ?></td>
                        <td><?= $employee['phone'] ?></td>
                        <td><?= $employee['position'] ?></td>
                        <td><?= $employee['email'] ?></td>
                        <td> <img src="<?= $employee['picture'] ?>" alt="<?= $employee['name'] ?>" width="50" height="50"> <!-- Display employee picture --></td>

                        <td>
           
            <a href="edit.php?id=<?= $employee['id'] ?>" class="btn btn-primary">Edit</a>
            <a href="delete.php?id=<?= $employee['id'] ?>" class="btn btn-danger">Delete</a>
        </td>
                    </tr>
                <?php } ?>
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
    <title>Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <h1>Welcome to the Admin Panel</h1>
      
      <a href="logout.php">Logout</a>
      <a href="leave-requests.php">Leave Status</a>

    <h2>Employee List</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Position</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php foreach ($employees as $employee) { ?>
            <tr>
                <td><?= $employee['name'] ?></td>
                <td><?= $employee['address'] ?></td>
                <td><?= $employee['phone'] ?></td>
                <td><?= $employee['position'] ?></td>
                <td><?= $employee['email'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $employee['id'] ?>">Edit</a>
                    <a href="delete.php?id=<?= $employee['id'] ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <h2>Add New Employee</h2>
    <form action="add.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="address">Address:</label>
        <input type="text" name="address" required><br>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" required><br>

        <label for="position">Position:</label>
        <input type="text" name="position" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <label for="picture">Picture:</label>
        <input type="file" name="picture" required><br>

        <input type="submit" value="Add Employee">
    </form>



    <h1>Welcome Admin!</h1>

<h2>Leave Requests</h2>
<ul>
    <?php foreach ($leaveRequests as $request): ?>
        <li>
            <strong>Subject:</strong> <?= $request['subject'] ?><br>
            <strong>Description:</strong> <?= $request['description'] ?><br>
            <strong>Date:</strong> <?= $request['date'] ?><br>
            <a href="process-leave.php?id=<?= $request['id'] ?>&status=grant">Grant</a>
            <a href="process-leave.php?id=<?= $request['id'] ?>&status=deny">Deny</a>
        </li>
    <?php endforeach; ?>
</ul>
</body>


</body>
</html> -->