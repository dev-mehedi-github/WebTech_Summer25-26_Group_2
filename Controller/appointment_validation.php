<?php
// Used by view_appointments.php - read-only, no appointment editing needed

$appointmentList = json_decode(file_get_contents("../Model/appointment_demo.json"), true);
if (!is_array($appointmentList)) {
    $appointmentList = [];
}
?>
