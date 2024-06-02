<?php
function getAllEmployees($pdo) {
    $query = "SELECT * FROM employees";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getEmployeeById($pdo, $employeeId) {
    $query = "SELECT * FROM employees WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $employeeId);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getEmployeeByEmail($pdo, $email) {
    $query = "SELECT * FROM employees WHERE
    email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function loginEmployee($pdo, $email, $password) {
    $query = "SELECT * FROM employees WHERE email = :email AND password = :password";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addEmployee($pdo, $name, $address, $phone, $position, $email, $password, $picturePath) {
    $query = "INSERT INTO employees (name, address, phone, position, email, password, picture) 
              VALUES (:name, :address, :phone, :position, :email, :password, :picture)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':position', $position);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':picture', $picturePath);
    $stmt->execute();
    return $pdo->lastInsertId();
}




function updateEmployee($pdo, $employeeId, $updatedName, $updatedAddress, $updatedPhone, $updatedPosition, $updatedEmail) {
    $sql = "UPDATE employees SET name = :name, address = :address, phone = :phone, position = :position, email = :email WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $updatedName);
    $stmt->bindParam(':address', $updatedAddress);
    $stmt->bindParam(':phone', $updatedPhone);
    $stmt->bindParam(':position', $updatedPosition);
    $stmt->bindParam(':email', $updatedEmail);
    $stmt->bindParam(':id', $employeeId);
    $stmt->execute();
}

// includes/functions.php

function deleteEmployee($pdo, $employeeId) {
    $sql = "DELETE FROM employees WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $employeeId);
    $stmt->execute();
}


//Leave

// includes/functions.php

// Function to save leave request in the database
function saveLeaveRequest($pdo, $employeeId, $subject, $description, $date) {
    $sql = "INSERT INTO leave_requests (employee_id, subject, description, date, status) VALUES (?, ?, ?, ?, 'Pending')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$employeeId, $subject, $description, $date]);
}



// Function to get all pending leave requests with employee names
function getPendingLeaveRequests($pdo) {
    $sql = "SELECT leave_requests.*, employees.name 
            FROM leave_requests 
            INNER JOIN employees ON leave_requests.employee_id = employees.id
            WHERE leave_requests.status = 'Pending'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to update the status of a leave request
function updateLeaveRequestStatus($pdo, $leaveRequestId, $status) {
    $sql = "UPDATE leave_requests SET status = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$status, $leaveRequestId]);
}

// Function to get all leave requests for the admin
function getAllLeaveRequests($pdo) {
    $sql = "SELECT leave_requests.*, employees.name FROM leave_requests INNER JOIN employees ON leave_requests.employee_id = employees.id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to get leave requests of a specific employee
function getEmployeeLeaveRequests($pdo, $employeeId) {
    $sql = "SELECT * FROM leave_requests WHERE employee_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$employeeId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Other relevant functions can be added as needed

?>