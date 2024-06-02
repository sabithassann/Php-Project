<?php
session_start();
require_once('../includes/db.php');
require_once('../includes/functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $position = $_POST['position'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $picture = $_FILES['picture'];

    // Check if the email is already registered
    $existingEmployee = getEmployeeByEmail($pdo, $email);

    if ($existingEmployee) {
        $error = "Email already registered";
    } else {
        // Upload the employee's picture
        $picturePath = '../images/' . basename($picture['name']);
        move_uploaded_file($picture['tmp_name'], $picturePath);

        // Insert the employee's details into the database
        $employeeId = addEmployee($pdo, $name, $address, $phone, $position, $email, $password, $picturePath);

        $_SESSION['employee'] = $employeeId;
        header("Location: employee.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Employee Registration</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Employee Registration</h1>

        <form action="" method="POST" enctype="multipart/form-data">
            <?php if (isset($error)) { ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php } ?>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" required>
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" name="address" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" name="phone" required>
            </div>

            <div class="form-group">
                <label for="position">Position:</label>
                <input type="text" class="form-control" name="position" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <div class="form-group">
                <label for="picture">Picture:</label>
                <input type="file" class="form-control-file" name="picture" required>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/js/bootstrap.min.js"></script>
</body>

</html>