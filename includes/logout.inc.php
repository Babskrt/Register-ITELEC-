<?php
    require_once "includes/config.inc.php";
    $_SESSION = array();
    session_destroy();

    header("Location: ../logout.php");
    exit();
?>