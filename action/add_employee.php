<?php
session_start();
$jsonData = file_get_contents("php://input");

$employeeData = json_decode($jsonData, true);
// Validate user session or any other authentication logic if needed
$conn = mysqli_connect("localhost", "root", "", "inventory_database");

if (!$conn) {
    die("Error preparing statement: " . mysqli_error($conn));
}

error_log("Received data: " . print_r($_POST, true));

    $insertQuery = "INSERT INTO employee (emp_id, emp_fname, emp_mname, emp_lname, emp_suffix, emp_age, emp_gender, emp_type, emp_status) " .
        "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insertQuery);
    mysqli_stmt_bind_param($stmt, 'sssssssss', $employeeData['emp_id'], $employeeData['emp_fname'], $employeeData['emp_mname'], $employeeData['emp_lname'], $employeeData['emp_suffix'], $employeeData['emp_age'], $employeeData['emp_gender'], $employeeData['emp_type'], $employeeData['emp_status']);
    $result = mysqli_stmt_execute($stmt);
    if ($result) {
        echo "success";
    } else {
        echo "Error executing statement: " .  mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);


mysqli_close($conn);
?>


