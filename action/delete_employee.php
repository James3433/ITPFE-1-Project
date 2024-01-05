<?php
session_start();

// Validate user session or any other authentication logic if needed

$conn = mysqli_connect("localhost", "root", "", "inventory_database");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['emp_id'])) {
    $empId = $_GET['emp_id'];

    $deleteQuery = "DELETE FROM employee WHERE emp_id = ?";
    $stmt = mysqli_prepare($conn, $deleteQuery);
    
    // Bind parameters
    mysqli_stmt_bind_param($stmt, 's', $empId);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo 'success';
    } else {
        echo 'Error: ' . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
