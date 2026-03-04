<?php
session_start();

if(!isset($_SESSION["user"]) && basename($_SERVER["PHP_SELF"]) != "login.php" && basename($_SERVER["PHP_SELF"]) != "loginBackend.php"){

    header("Location: login.php");
    exit();
}
?>