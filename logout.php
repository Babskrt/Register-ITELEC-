<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="index.php">Home</a> |
    <a href="register.php">Register</a> |
    <a href="login.php">Login</a><br /><br />

    <?php
    session_start();

    if (isset($_SESSION["username"])) {
        $username = $_SESSION["username"];
        unset($_SESSION["username"]);
        echo "User " . $username . " has logged out!";
    }
    ?>

</body>
</html>