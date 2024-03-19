<?php
require_once 'config.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    $_SESSION['inputs'] = [
        'username' => $username,
        'pwd' => $pwd,
        'email' => $email
    ];
    
    // if(empty($email)) {
    //     $_SESSION['errorEmail'] = "Email address is a required field.";
    //     header('Location: ../register.php');
    //     exit();
    // }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errorEmail'] = "Invalid email address.";
            }
            if(empty($email)) {
                $_SESSION['errors']['email'] = "Email address is a required field.";
            }
            if(empty($username)) {
                $_SESSION['errors']['username'] = "Username is a required field.";
            }
            if(empty($pwd)) {
                $_SESSION['errors']['pwd'] = "Password is a required field.";
            }
            if(isset($_SESSION['errors'])) {
            header('Location: ../register.php');
            exit();
        }

        try {
            require_once "dbc.inc.php";

        $query = "SELECT * FROM users WHERE username = :username OR email = :email;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $existingUser = $stmt->fetch();

        if ($existingUser) {
            echo "<script>alert('Username or Email already taken!'); window.location.href='../register.php';</script>";
            exit();
        }

        $query = "INSERT INTO users (username, pwd, email) VALUES (:username, :hashedPwd, :email);";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":hashedPwd", $hashedPwd);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $pdo = null;
        $stmt = null;

        echo "<script>alert('Successfully Registered!'); window.location.href='../login.php';</script>";
        exit();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    exit();
}