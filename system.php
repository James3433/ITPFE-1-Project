<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
$user = $_SESSION['user'];
$user_fname = $user['user_fname'];

$conn = mysqli_connect("localhost", "root", "", "inventory_database");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$countQuery = "SELECT COUNT(emp_id) as count FROM employee";
$countResult = mysqli_query($conn, $countQuery);

if ($countResult) {
    $rowCount = mysqli_fetch_assoc($countResult)['count'];
    $nextEquipId = 2021010 + $rowCount;
}

$sql = "SELECT * FROM employee_details";
$result = mysqli_query($conn, $sql);

$empIdQuery = "SELECT emp_id FROM employee WHERE emp_id != 404";
$empIdResult = mysqli_query($conn, $empIdQuery);

if ($empIdResult) {
    // Fetch the emp_id values into an array
    $empIds = [];
    while ($row = mysqli_fetch_assoc($empIdResult)) {
        $empIds[] = $row['emp_id'];
    }
} else {
    // Handle the case where the query failed
    $empIds = [];
}

function getStatusText($empStatus) {
    switch ($empStatus) {
        case 1:
            return 'Active';
        case 2:
            return 'Inactive';
        case 0:
            return 'Retired';
        default:
            return 'Unknown';
    }
}

function getStatusInt($empStatus) {
    switch ($empStatus) {
        case 'Active':
            return 1;
        case 'Inactive':
            return 2;
        case 'Retired':
            return 0;
        default:
            return -1;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inventory System</title>
    <link rel="stylesheet" type="text/css" href="css/system.css">
    <script src="js/system_1.js" defer></script>
</head>
<body>

<form method="post">
        <div class="menu">
            <img class="pic1" src="pictures/user.png" alt="picture_1">
            <h3>Welcome, <?php echo $user_fname; ?></h3>
            <button type="button" id="logout">Logout</button>
        </div>

        <div class="employee" id="empDiv">
            <h2>Equipment Status</h2>
            <div class="table_container">
                <table class="emp_table_view">
                    <tr>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Employee Type</th>
                        <th>Status</th>
                    </tr>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $statusText = getStatusText($row["emp_status"]);
                            echo "<tr>
                                <td>" . $row["emp_id"] . "</td>
                                <td>" . $row["emp_name"] . "</td>
                                <td>" . $row["emp_age"] . "</td>
                                <td>" . $row["emp_gender"] . "</td>
                                <td>" . $row["emp_type"] . "</td>
                                <td>" . $statusText . "</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='12'>No data available</td></tr>";
                    }
                    ?>
                </table>
                </div>
    <div class="input_text">
        <div class="textfield1">
               <input type="text" name="input_emp_id" value="<?php echo $nextEquipId ?>" readonly>
               <input type="text" name="input_emp_fname" placeholder="First name">
               <input type="text" name="input_emp_mname" placeholder="Middle name"> 
               <input type="text" name="input_emp_lname" placeholder="Last name"> 
        </div>
        <div class="textfield2">
                 <input type="text" name="input_emp_type" placeholder="Employee Type">
                 <input type="text" name="input_emp_age" placeholder="Emp Age"> 
            <select name="input_emp_suffix">
                 <option value=" "> </option>
                 <option value="Jr.">Jr.</option>
                 <option value="Sr.">Sr.</option>
            </select>
            <select name="input_emp_gender">
                 <option value="Male">Male</option>
                 <option value="Female">Female</option>
            </select>
            <select name="input_emp_status">
                 <option value="Active">Active</option>
                 <option value="Inactive">Inactive</option>
                 <option value="Retired">Retired</option>
            </select>
        </div>
        </div>
        <div class="input_button">
            <button type="button" id="add">ADD</button>
            <button type="button" id="edit">EDIT</button>
            <button type="button" id="delete">DELETE</button>
        </div>
    </div>
</form>

    <div class="overlay" id="overlay"></div>
    
     <div class="popup" id="logoutPopup">
            <div class="m-header">
                 <h3 class="m-title">Logout Confirmation</h3>
            </div>
            <div class="m-body" id="logoutMBody">
                     Are you sure you want to logout?
            </div>
    <div class="m-footer">
        <button type="button" class="btn btn-primary" id="logoutYes">Yes</button>
        <button type="button" class="btn btn-secondary" id="logoutNo">No</button>
    </div>
    </div>

    <div class="popup" id="editPopup">
            <div class="m-header">
                 <h3 class="m-title">Editing Employee</h3>
            </div>
    <div class="m-body" id="editMBody">
        <div class="textfield3">
            <select name="input_emp_id1">
            <?php
                foreach ($empIds as $empId) {
                echo "<option value=\"$empId\">$empId</option>";
               }
              ?>
            </select>
               <input type="text" name="input_emp_fname1" placeholder="First name">
               <input type="text" name="input_emp_mname1" placeholder="Middle name"> 
               <input type="text" name="input_emp_lname1" placeholder="Last name">
        </div>
        <div class="textfield4">
            <input type="text" name="input_emp_type1" placeholder="Equipment Type">
            <input type="text" name="input_emp_age1" placeholder="Equipment age"> 
            <select name="input_emp_suffix1">
                 <option value=" "> </option>
                 <option value="Jr.">Jr.</option>
                 <option value="Sr.">Sr.</option>
            </select>
            <select name="input_emp_gender1">
                 <option value="Male">Male</option>
                 <option value="Female">Female</option>
            </select>
            <select name="input_emp_status1">
                 <option value="Active">Active</option>
                 <option value="Inactive">Inactive</option>
                 <option value="Retired">Retired</option>
            </select> 
        </div>   
    </div>
    <div class="m-footer">
        <button type="button" class="btn btn-primary" id="OKEdit">OK</button>
        <button type="button" class="btn btn-secondary" id="CancelEdit">Cancel</button>
    </div>
    </div>
    
    <div class="popup" id="deletePopup">
            <div class="m-header">
                 <h3 class="m-title">Delete Employee</h3>
            </div>
    <div class="m-body" id="deleteMBody">
        <div class="textfield3">
            <select name="input_emp_id2">
            <?php
                foreach ($empIds as $empId) {
                echo "<option value=\"$empId\">$empId</option>";
               }
              ?>
            </select>
               <input type="text" name="input_emp_fname2" placeholder="First name" readonly>
               <input type="text" name="input_emp_mname2" placeholder="Middle name" readonly> 
               <input type="text" name="input_emp_lname2" placeholder="Last name" readonly>
        </div>
        <div class="textfield4">
            <input type="text" name="input_emp_type2" placeholder="Employee Type" readonly>
            <input type="text" name="input_emp_age2" placeholder="Employee age" readonly> 
            <input type="text" name="input_emp_suffix2" placeholder="Employee suffix" readonly> 
            <input type="text" name="input_emp_gender2" placeholder="Employee gender" readonly> 
            <input type="text" name="input_emp_status2" placeholder="Employee Status" readonly> 
               
        </div>   
    </div>
    <div class="m-footer">
        <button type="button" class="btn btn-primary" id="OKDelete">OK</button>
        <button type="button" class="btn btn-secondary" id="CancelDelete">Cancel</button>
    </div>
    </div>

</body>
</html>

<?php
mysqli_close($conn);
?>