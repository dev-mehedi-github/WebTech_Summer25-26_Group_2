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
<title>Doctor Schedule-Doctor Appointment System</title>
<style>
body { font-family: Arial, sans-serif; margin: 30px; background: #f4f6f8; }
.container { max-width: 900px; margin: 0 auto; background: #fff; padding: 25px; border-radius: 8px; }
nav { margin-bottom: 20px; }
nav a { margin-right: 15px; text-decoration: none; color: #0f766e; font-weight: bold; }
.card { background: #ecfeff; padding: 15px; border-radius: 6px; margin-top: 15px; }
</style>
</head>
<body style="background: linear-gradient(rgba(224, 242, 254, 0.88), rgba(248, 250, 252, 0.92)), url('../image/hospital/hospital-bg.svg') center/cover fixed;">
<div class="container">
  <nav>
    <a href="doctor_dashboard.php">Dashboard</a>
    <a href="doctor_schedule.php">My Schedule</a>
    <a href="doctor_patients.php">Patients</a>
  </nav>
  <h1>Doctor Schedule</h1>
  <div class="card">
    <p>Doctor: <?php echo htmlspecialchars($doctorName); ?></p>
    <p>Email: <?php echo htmlspecialchars($doctorEmail); ?></p>
    <?php if (empty($doctorAppointments)) { ?>
      <p>No appointments are scheduled yet.</p>
    <?php } else { ?>
      <h2 style="margin-top:15px;">Upcoming appointments</h2>
      <?php foreach ($doctorAppointments as $appointment) { ?>
        <div style="padding:12px 0; border-bottom:1px solid #a5f3fc;">
          <strong><?php echo htmlspecialchars($appointment['date'] ?? ''); ?> at <?php echo htmlspecialchars($appointment['time'] ?? ''); ?></strong>
          <p>Patient: <?php echo htmlspecialchars($appointment['patient_name'] ?? ''); ?> | Status: <?php echo htmlspecialchars($appointment['status'] ?? 'Pending'); ?></p>
        </div>
      <?php } ?>
    <?php } ?>
  </div>
</div>
</body>
</html>
