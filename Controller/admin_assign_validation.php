<?php
$aname = "";
$aemail = "";
$auname = "";
$message = "";
$success = false;

$adminList = json_decode(file_get_contents("../Model/admin_demo.json"), true);
if (!is_array($adminList)) {
    $adminList = [];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $aname = trim($_POST["aname"] ?? "");
    $aemail = trim($_POST["aemail"] ?? "");
    $auname = trim($_POST["auname"] ?? "");
    $apass = trim($_POST["apass"] ?? "");

    $errors = [];

    if (strlen($aname) < 3) {
        $errors[] = "Full name must be at least 3 characters.";
    }
    if ($aemail === "" || !str_ends_with($aemail, "@gmail.com")) {
        $errors[] = "Email must end with @gmail.com.";
    }
    if (strlen($auname) < 4) {
        $errors[] = "Username must be at least 4 characters.";
    }
    if (strlen($apass) < 5) {
        $errors[] = "Password must be at least 5 characters.";
    }

    foreach ($adminList as $adminRow) {
        if (strtolower($adminRow["username"]) === strtolower($auname)) {
            $errors[] = "That username is already taken.";
            break;
        }
    }

    if (empty($errors)) {
        $newId = 1;
        foreach ($adminList as $adminRow) {
            if ($adminRow["id"] >= $newId) {
                $newId = $adminRow["id"] + 1;
            }
        }

        $adminList[] = [
            "id" => $newId,
            "name" => $aname,
            "email" => $aemail,
            "username" => $auname,
            "password" => $apass
        ];

        file_put_contents("../Model/admin_demo.json", json_encode($adminList, JSON_PRETTY_PRINT));

        $success = true;
        $message = "New admin account \"" . $auname . "\" was created successfully.";
        $aname = "";
        $aemail = "";
        $auname = "";
    } else {
        $message = implode(" ", $errors);
    }
}
?>
