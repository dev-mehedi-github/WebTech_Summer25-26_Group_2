<?php
session_start();

$auname = "";
$apass = "";
$message = "";
$remember = false;

if (isset($_COOKIE["admin_remember_user"])) {
    $auname = $_COOKIE["admin_remember_user"];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $auname = trim($_POST["auname"] ?? "");
    $apass = trim($_POST["apass"] ?? "");
    $remember = isset($_POST["remember"]) && $_POST["remember"] === "1";

    $adminList = json_decode(file_get_contents("../Model/admin_demo.json"), true);
    if (!is_array($adminList)) {
        $adminList = [];
    }

    $matchedAdmin = null;
    foreach ($adminList as $adminRow) {
        if (strtolower($adminRow["username"]) === strtolower($auname) && $adminRow["password"] === $apass) {
            $matchedAdmin = $adminRow;
            break;
        }
    }

    if ($matchedAdmin) {
        $_SESSION["admin_logged_in"] = true;
        $_SESSION["admin_name"] = $matchedAdmin["name"];
        $_SESSION["admin_username"] = $matchedAdmin["username"];
        $_SESSION["admin_email"] = $matchedAdmin["email"];

        if ($remember) {
            setcookie("admin_remember_user", $auname, time() + 60 * 60 * 24 * 7, "/");
        } else {
            setcookie("admin_remember_user", "", time() - 3600, "/");
        }

        header("Location: admin_dashboard.php");
        exit;
    } else {
        $message = "Invalid admin username or password.";
    }
}
?>
