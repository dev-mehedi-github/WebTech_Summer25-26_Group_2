<?php
session_start();

$uname = "";
$pass = "";
$message = "";
$remember = false;

if (isset($_COOKIE["remember_user"])) {
    $uname = $_COOKIE["remember_user"];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $uname = trim($_POST["uname"] ?? "");
    $pass = trim($_POST["pass"] ?? "");
    $remember = isset($_POST["remember"]) && $_POST["remember"] === "1";

    // if ($uname === "admin" && $pass === "admin123") {
    //     $_SESSION["logged_in"] = true;
    //     $_SESSION["role"] = "admin";
    //     $_SESSION["username"] = $uname;

    //     if ($remember) {
    //         setcookie("remember_user", $uname, time() + 60 * 60 * 24 * 7, "/");
    //     } else {
    //         setcookie("remember_user", "", time() - 3600, "/");
    //     }

    //     header("Location: admin_dashboard.php");
    //     exit;
    // } elseif ($uname === "patient" && $pass === "pt12345") {
    //     $_SESSION["logged_in"] = true;
    //     $_SESSION["role"] = "patient";
    //     $_SESSION["username"] = $uname;

    //     if ($remember) {
    //         setcookie("remember_user", $uname, time() + 60 * 60 * 24 * 7, "/");
    //     } else {
    //         setcookie("remember_user", "", time() - 3600, "/");
    //     }

    //     header("Location: patient_dashboard.php");
    //     exit;
    // } else {
    //     $message = "Invalid username or password.";
    // }
}

    // $uname = trim($_POST["uname"] ?? "");
    // $pass = trim($_POST["pass"] ?? ""); 
    // $remember = isset($_POST["remember"]) && $_POST["remember"] === "1";

    // if (strlen($uname) < 5) {
    //     $errors[] = "Username must be at least 5 characters.";
    // }
    // if (strlen($pass) < 5) {
    //     $errors[] = "Password must be at least 5 characters.";
    // }

    // if (empty($errors)) {
    //     $_SESSION["logged_in"] = true;
    //     $_SESSION["username"] = $uname;

    //     if ($remember) {
    //         setcookie("remember_user", $uname, time() + 60 * 60 * 24 * 7, "/");
    //     } else {
    //         setcookie("remember_user", "", time() - 3600, "/");
    //     }
    // }
