<?php
$doctorList = json_decode(file_get_contents("../Model/doctor_demo.json"), true);
if (!is_array($doctorList)) {
    $doctorList = [];
}

$keyword = trim($_GET["keyword"] ?? "");

$filteredDoctors = [];
if ($keyword === "") {
    $filteredDoctors = $doctorList;
} else {
    foreach ($doctorList as $doctorRow) {
        if (stripos($doctorRow["name"], $keyword) !== false || stripos($doctorRow["specialization"], $keyword) !== false) {
            $filteredDoctors[] = $doctorRow;
        }
    }
}

$editDoctor = null;
if (isset($_GET["edit"])) {
    foreach ($doctorList as $doctorRow) {
        if ((int)$doctorRow["id"] === (int)$_GET["edit"]) {
            $editDoctor = $doctorRow;
            break;
        }
    }
}

$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["doctor_id"])) {
    $dname = trim($_POST["dname"] ?? "");
    $dspec = trim($_POST["dspec"] ?? "");
    $demail = trim($_POST["demail"] ?? "");
    $dusername = trim($_POST["dusername"] ?? "");
    $dpass = trim($_POST["dpass"] ?? "");
    $dphone = trim($_POST["dphone"] ?? "");
    $doctorId = $_POST["doctor_id"];

    if (strlen($dname) < 3 || strlen($dspec) < 3 || $demail === "" || strlen($dusername) < 3 || strlen($dpass) < 5 || strlen($dphone) < 6) {
        $message = "Please fill in all fields correctly.";
        $editDoctor = [
            "id" => $doctorId,
            "name" => $dname,
            "specialization" => $dspec,
            "email" => $demail,
            "username" => $dusername,
            "password" => $dpass,
            "phone" => $dphone
        ];
    } else {
        foreach ($doctorList as &$doctorRow) {
            if ((int)$doctorRow["id"] === (int)$doctorId) {
                $doctorRow["name"] = $dname;
                $doctorRow["specialization"] = $dspec;
                $doctorRow["email"] = $demail;
                $doctorRow["username"] = $dusername;
                $doctorRow["password"] = $dpass;
                $doctorRow["phone"] = $dphone;
                break;
            }
        }
        unset($doctorRow);

        file_put_contents("../Model/doctor_demo.json", json_encode($doctorList, JSON_PRETTY_PRINT));

        $message = "Doctor profile updated successfully.";
        $editDoctor = null;
        $filteredDoctors = $doctorList;
    }
}
?>
