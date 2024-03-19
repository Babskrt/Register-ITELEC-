<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);


    try {
    require_once "dbc.inc.php";
        $query = "SELECT * FROM users WHERE username = :username AND pwd = :pwd;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":pwd", $pwd);
        $stmt->execute();


        if ($stmt->rowCount() > 0) {
            session_start();
            $_SESSION["username"] = $username;
            echo "<script>alert('Sucessfully Login!'); window.location.href='../index.php';</script>";
            die();
        } else {
            echo "<script>alert('Invalid Login Credentials'); window.location.href='../login.php';</script>";
            die();
        }

        $pdo = null;
        $stmt = null;
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
}