<?php
$sname = "localhost";
$username = "root";
$password = "";
$db_name = "database_project";

$conn = mysqli_connect($sname, $username, $password, $db_name);
if(!$conn){
    echo "Connection Failed!";
}
if(isset($_POST['submitted'])) {
    if(isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(empty($username)){
            header("Location: index.php?error=Username is required&submitted=true");
            exit();
        } else if(empty($password)){
            header("Location: index.php?error=Password is required&submitted=true");
            exit();
        } else {
            // Assuming user_fname and user_lname are columns in your 'user' table
            $sql = "SELECT * FROM user WHERE CONCAT(user_fname, ' ', user_lname) = '$username' AND user_password = '$password'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) === 1){
                $row = mysqli_fetch_assoc($result);
                 // Start a session
                session_start();
                // Store user data in the session
                $_SESSION['user'] = $row;
                // Perform actions after successful login using $row data
                header("Location: http://localhost/Inventory_System_Website/system.php");
                exit();
            } else {
                header("Location: index.php?error=Incorrect input&submitted=true");
                exit();
            }
        }
    } else {
        header("Location: index.php?error=Must Input it all&submitted=true");
        exit();
    }
} else {
    // Handle cases where the form is not submitted
    header("Location: index.php");
    exit();
}
?>
