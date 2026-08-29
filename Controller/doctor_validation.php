<?php
require_once '../Model/db_connect.php';

$keyword = trim($_GET["keyword"] ?? "");

if ($keyword === "") {
    $filteredDoctors = $pdo->query("SELECT * FROM doctors ORDER BY id")->fetchAll();
} else {
    $stmt = $pdo->prepare("SELECT * FROM doctors WHERE name LIKE :kw OR specialization LIKE :kw ORDER BY id");
    $stmt->execute(["kw" => "%" . $keyword . "%"]);
    $filteredDoctors = $stmt->fetchAll();
}

$editDoctor = null;
if (isset($_GET["edit"])) {
    $stmt = $pdo->prepare("SELECT * FROM doctors WHERE id = :id LIMIT 1");
    $stmt->execute(["id" => (int)$_GET["edit"]]);
    $editDoctor = $stmt->fetch() ?: null;
}

$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["doctor_id"])) {
    $dname = trim($_POST["dname"] ?? "");
    $dspec = trim($_POST["dspec"] ?? "");
    $demail = trim($_POST["demail"] ?? "");
    $dusername = trim($_POST["dusername"] ?? "");
    $dpass = trim($_POST["dpass"] ?? "");
    $dphone = trim($_POST["dphone"] ?? "");
    $doctorId = (int)$_POST["doctor_id"];

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
        $update = $pdo->prepare(
            "UPDATE doctors SET name = :name, specialization = :spec, email = :email, username = :username, password = :password, phone = :phone WHERE id = :id"
        );
        $update->execute([
            "name" => $dname,
            "spec" => $dspec,
            "email" => $demail,
            "username" => $dusername,
            "password" => $dpass,
            "phone" => $dphone,
            "id" => $doctorId,
        ]);

        $message = "Doctor profile updated successfully.";
        $editDoctor = null;
        $filteredDoctors = $pdo->query("SELECT * FROM doctors ORDER BY id")->fetchAll();
    }
}
?>
