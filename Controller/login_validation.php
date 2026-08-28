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
    $role = strtolower(trim($_POST["role"] ?? "patient"));
    $remember = isset($_POST["remember"]) && $_POST["remember"] === "1";

    $loggedIn = false;
    $redirectTo = "";

    if ($role === "admin") {
        if ($uname === "admin" && $pass === "admin123") {
            $_SESSION["logged_in"] = true;
            $_SESSION["role"] = "admin";
            $_SESSION["username"] = $uname;
            $_SESSION["admin_logged_in"] = true;
            $_SESSION["admin_name"] = "Administrator";
            $_SESSION["admin_username"] = $uname;
            $_SESSION["admin_email"] = "admin@doctorapp.local";

            $loggedIn = true;
            $redirectTo = "admin_dashboard.php";
        } else {
            $adminList = json_decode(file_get_contents("../Model/admin_demo.json"), true);
            if (!is_array($adminList)) {
                $adminList = [];
            }

            foreach ($adminList as $adminRow) {
                if (strtolower($adminRow["username"]) === strtolower($uname) && $adminRow["password"] === $pass) {
                    $_SESSION["logged_in"] = true;
                    $_SESSION["role"] = "admin";
                    $_SESSION["username"] = $adminRow["username"];
                    $_SESSION["admin_logged_in"] = true;
                    $_SESSION["admin_name"] = $adminRow["name"];
                    $_SESSION["admin_username"] = $adminRow["username"];
                    $_SESSION["admin_email"] = $adminRow["email"];

                    $loggedIn = true;
                    $redirectTo = "admin_dashboard.php";
                    break;
                }
            }
        }
    } elseif ($role === "doctor") {
        $doctorList = json_decode(file_get_contents("../Model/doctor_demo.json"), true);
        if (!is_array($doctorList)) {
            $doctorList = [];
        }

        foreach ($doctorList as $doctorRow) {
            $doctorUsername = strtolower($doctorRow["username"] ?? "");
            $doctorEmail = strtolower($doctorRow["email"] ?? "");
            if (($doctorUsername === strtolower($uname) || $doctorEmail === strtolower($uname)) && ($doctorRow["password"] ?? "") === $pass) {
                $_SESSION["logged_in"] = true;
                $_SESSION["role"] = "doctor";
                $_SESSION["username"] = $doctorRow["username"] ?? $doctorRow["email"];
                $_SESSION["doctor_name"] = $doctorRow["name"];
                $_SESSION["doctor_email"] = $doctorRow["email"];
                $_SESSION["doctor_logged_in"] = true;

                $loggedIn = true;
                $redirectTo = "doctor_dashboard.php";
                break;
            }
        }
    } else {
        if ($uname === "patient" && $pass === "pt12345") {
            $_SESSION["logged_in"] = true;
            $_SESSION["role"] = "patient";
            $_SESSION["username"] = $uname;
            $_SESSION["patient_name"] = "Patient";

            $loggedIn = true;
            $redirectTo = "patient_dashboard.php";
        } else {
            $patientList = json_decode(file_get_contents("../Model/demo.json"), true);
            if (!is_array($patientList)) {
                $patientList = [];
            }

            foreach ($patientList as $patientRow) {
                if (strtolower($patientRow["email"]) === strtolower($uname) && $patientRow["password"] === $pass) {
                    $_SESSION["logged_in"] = true;
                    $_SESSION["role"] = "patient";
                    $_SESSION["username"] = $patientRow["email"];
                    $_SESSION["patient_name"] = $patientRow["name"];

                    $loggedIn = true;
                    $redirectTo = "patient_dashboard.php";
                    break;
                }
            }
        }
    }

    if ($loggedIn) {
        if ($remember) {
            setcookie("remember_user", $uname, time() + 60 * 60 * 24 * 7, "/");
        } else {
            setcookie("remember_user", "", time() - 3600, "/");
        }

        header("Location: " . $redirectTo);
        exit;
    } else {
        $message = "Invalid username or password.";
    }
}