<!DOCTYPE html>
<html>
<head>
    <title>Inventory System Login</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head> 
<body>
     <form action="action/login.php" method="post">
        <h2> Login User </h2>
        <?php if(isset($_GET['error']) && isset($_GET['submitted'])) {?>
            <p class='error'><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <label> Username </label>
        <input type="text" name="username" placeholder="username"><br>
        <label> Password </label>
        <input type="password" name="password" placeholder="password">
        <button type="submit" name="submitted">LOGIN</button>
     </form>
</body>
</html>
