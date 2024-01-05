<?php
// Retrieve the JSON data sent in the POST request
$jsonData = file_get_contents("php://input");

// Decode the JSON data
$employeeData = json_decode($jsonData, true);

// Connect to the database (replace these parameters with your actual database credentials)
$conn = mysqli_connect("localhost", "root", "", "inventory_database");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Update the employee details in the database
$updateQuery = "UPDATE employee SET emp_fname=?, emp_mname=?, emp_lname=?, emp_type=?, emp_age=?, emp_suffix=?, emp_gender=?, emp_status=? WHERE emp_id=?";
$stmt = mysqli_prepare($conn, $updateQuery);
mysqli_stmt_bind_param($stmt, 'sssssssss', $employeeData['emp_fname'], $employeeData['emp_mname'], $employeeData['emp_lname'], $employeeData['emp_type'], $employeeData['emp_age'], $employeeData['emp_suffix'], $employeeData['emp_gender'], $employeeData['emp_status'], $employeeData['emp_id']);
$result = mysqli_stmt_execute($stmt);

// Handle the result (if needed)
if ($result) {
    echo "Employee details updated successfully";
} else {
    echo "Failed to update employee details: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
