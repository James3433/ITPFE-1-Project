<?php
// Connect to the database (replace these parameters with your actual database credentials)
$conn = mysqli_connect("localhost", "root", "", "inventory_database");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_GET['emp_id'])) {
    // Handle the case where emp_id is not provided
    echo json_encode(['error' => 'emp_id parameter is missing']);
    exit;
}

$empId = $_GET['emp_id']; // Retrieve emp_id from the GET parameters

// Query to get employee details based on emp_id
$sql = "SELECT * FROM employee WHERE emp_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 's', $empId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Fetch employee details as an associative array
$employeeDetails = mysqli_fetch_assoc($result);

// Send the employee details as JSON
header('Content-Type: application/json');
echo json_encode($employeeDetails);
?>
