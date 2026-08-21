<?php
session_start();

$ptname = "";
$ptphone = "";
$ptdob = "";
$ptgender = "";
$ptemail = "";
$ptpass = "";
$message = "";
$remember = false;

if (isset($_COOKIE["remember_user"])) {
    $name = $_COOKIE["remember_user"];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") 
    {
    $ptname = trim($_POST["ptfname"] ?? "");
    $ptphone = trim($_POST["ptphon"] ?? "");
    $ptdob = $_POST["ptdob"] ?? "";
    $ptgender = $_POST["gender"] ?? "";
    $ptemail = trim($_POST["ptemail"] ?? "");
    $ptpass = trim($_POST["ptpass"] ?? "");
    $remember = isset($_POST["remember"]) && $_POST["remember"] === "1";

     $valid = true;
    }
?>