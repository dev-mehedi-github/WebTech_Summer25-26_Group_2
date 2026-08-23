<?php
$appointmentList = json_decode(file_get_contents("../Model/appointment_demo.json"), true);
if (!is_array($appointmentList)) {
    $appointmentList = [];
}
?>
