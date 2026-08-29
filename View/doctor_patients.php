<?php
include '../Controller/doctor_user_validation.php';

$appointmentList = json_decode(file_get_contents('../Model/appointment_demo.json'), true);
if (!is_array($appointmentList)) {
  $appointmentList = [];
}

$doctorAppointments = [];
foreach ($appointmentList as $appointment) {
  if (strcasecmp(trim($appointment['doctor_name'] ?? ''), trim($doctorName)) === 0) {
    $doctorAppointments[] = $appointment;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Doctor Patients-Doctor Appointment System</title>
<style>
body { font-family: Arial, sans-serif; margin: 30px; background: #f4f6f8; }
.container { max-width: 900px; margin: 0 auto; background: #fff; padding: 25px; border-radius: 8px; }
nav { margin-bottom: 20px; }
nav a { margin-right: 15px; text-decoration: none; color: #0f766e; font-weight: bold; }
.card { background: #f0fdf4; padding: 15px; border-radius: 6px; margin-top: 15px; }
</style>
</head>
<body style="background: linear-gradient(rgba(224, 242, 254, 0.88), rgba(248, 250, 252, 0.92)), url('../image/hospital/hospital-bg.svg') center/cover fixed;">
<div class="container">
  <nav>
    <a href="doctor_dashboard.php">Dashboard</a>
    <a href="doctor_schedule.php">My Schedule</a>
    <a href="doctor_patients.php">Patients</a>
  </nav>
  <h1>Patients</h1>
  <div class="card">
    <p>Doctor: <?php echo htmlspecialchars($doctorName); ?></p>
    <?php if (empty($doctorAppointments)) { ?>
      <p>No patient appointments found.</p>
    <?php } else { ?>
      <table style="width:100%; margin-top:15px; border-collapse:collapse;">
        <tr><th style="text-align:left; padding:8px;">Patient</th><th style="text-align:left; padding:8px;">Date</th><th style="text-align:left; padding:8px;">Time</th><th style="text-align:left; padding:8px;">Status</th></tr>
        <?php foreach ($doctorAppointments as $appointment) { ?>
          <tr>
            <td style="padding:8px; border-top:1px solid #bbf7d0;"><?php echo htmlspecialchars($appointment['patient_name'] ?? ''); ?></td>
            <td style="padding:8px; border-top:1px solid #bbf7d0;"><?php echo htmlspecialchars($appointment['date'] ?? ''); ?></td>
            <td style="padding:8px; border-top:1px solid #bbf7d0;"><?php echo htmlspecialchars($appointment['time'] ?? ''); ?></td>
            <td style="padding:8px; border-top:1px solid #bbf7d0;"><?php echo htmlspecialchars($appointment['status'] ?? 'Pending'); ?></td>
          </tr>
        <?php } ?>
      </table>
    <?php } ?>
  </div>
</div>
</body>
</html>
