<?php
session_start();

$ptname = "";
$ptphone = "";
$ptdob = "";
$ptgender = "";
$ptemail = "";
$ptpass = "";
$message = "";
$success = false;
$remember = false;

if (isset($_COOKIE["remember_user"])) {
    $ptemail = $_COOKIE["remember_user"];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ptname = trim($_POST["ptfname"] ?? "");
    $ptphone = trim($_POST["ptphon"] ?? "");
    $ptdob = $_POST["ptdob"] ?? "";
    $ptgender = $_POST["gender"] ?? "";
    $ptemail = trim($_POST["ptemail"] ?? "");
    $ptpass = trim($_POST["ptpass"] ?? "");
    $remember = isset($_POST["remember"]) && $_POST["remember"] === "1";

    $errors = [];

    if (strlen($ptname) < 3) {
        $errors[] = "Full name must be at least 3 characters.";
    }
    if (strlen($ptphone) < 11) {
        $errors[] = "Phone number must be at least 11 characters.";
    }
    if ($ptdob === "") {
        $errors[] = "Date of birth is required.";
    }
    if ($ptgender === "") {
        $errors[] = "Please select a gender.";
    }
    if ($ptemail === "" || !str_ends_with($ptemail, "@gmail.com")) {
        $errors[] = "Email must end with @gmail.com.";
    }
    if (strlen($ptpass) < 5) {
        $errors[] = "Password must be at least 5 characters.";
    }

    $patientList = json_decode(file_get_contents("../Model/demo.json"), true);
    if (!is_array($patientList)) {
        $patientList = [];
    }

    foreach ($patientList as $patientRow) {
        if (strtolower($patientRow["email"]) === strtolower($ptemail)) {
            $errors[] = "An account with that email already exists.";
            break;
        }
    }

    if (empty($errors)) {
        $newId = 1;
        foreach ($patientList as $patientRow) {
            if ($patientRow["id"] >= $newId) {
                $newId = $patientRow["id"] + 1;
            }
        }

        $patientList[] = [
            "id" => $newId,
            "name" => $ptname,
            "phone" => $ptphone,
            "dob" => $ptdob,
            "gender" => $ptgender,
            "email" => $ptemail,
            "password" => $ptpass
        ];

        file_put_contents("../Model/demo.json", json_encode($patientList, JSON_PRETTY_PRINT));

        if ($remember) {
            setcookie("remember_user", $ptemail, time() + 60 * 60 * 24 * 7, "/");
        }

        $success = true;
        $message = "Account created successfully. You can now log in.";
        $ptname = "";
        $ptphone = "";
        $ptdob = "";
        $ptgender = "";
        $ptemail = "";
    } else {
        $message = implode(" ", $errors);
    }
}
?>