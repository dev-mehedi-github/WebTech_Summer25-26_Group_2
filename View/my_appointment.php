<?php
include '../Controller/patient_validation.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>My Appointment - Doctor Appointment System</title>
<style>
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
}

body {
  display: flex;
  background: #f4f6f8;
  color: #222;
}

/* SIDEBAR */
.sidebar {
  width: 220px;
  min-height: 100vh;
  background: #1f2937;
  color: #fff;
  display: flex;
  flex-direction: column;
  padding: 20px 0;
}

.profile {
  text-align: center;
  margin-bottom: 30px;
}

.avatar {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background: #4b5563;
  margin: 0 auto 10px;
}

.sidebar nav {
  display: flex;
  flex-direction: column;
}

.sidebar nav a {
  color: #d1d5db;
  text-decoration: none;
  padding: 12px 20px;
}

.sidebar nav a:hover,
.sidebar nav a.active {
  background: #374151;
  color: #fff;
}

.logout {
  margin-top: auto;
  padding: 12px 20px;
}

.logout a {
  color: #f87171;
  text-decoration: none;
}

/* MAIN */
.main {
  flex: 1;
  padding: 20px 30px;
}

.top-head h1 {
  font-size: 22px;
  margin-bottom: 16px;
}

.top-nav {
  display: flex;
  gap: 10px;
  margin-bottom: 24px;
}

.top-nav input {
  flex: 1;
  max-width: 300px;
  padding: 8px 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.top-nav button {
  padding: 8px 16px;
  border: none;
  background: #2563eb;
  color: #fff;
  border-radius: 4px;
  cursor: pointer;
}

.top-nav button:hover {
  background: #1d4ed8;
}

/* TABLE */
.doctor-list, .booking-form {
  background: #fff;
  padding: 20px;
  border-radius: 6px;
  margin-bottom: 24px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.section-title {
  margin-bottom: 12px;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  text-align: left;
  padding: 10px;
  border-bottom: 1px solid #e5e7eb;
}

th {
  background: #f9fafb;
}

/* FORM */
.booking-form table td {
  padding: 8px 10px;
  border: none;
}

.booking-form label {
  font-weight: bold;
}

.booking-form input,
.booking-form select {
  width: 100%;
  padding: 6px 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

#makeApp {
  margin-top: 12px;
  padding: 8px 20px;
  background: #16a34a;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

#makeApp:hover {
  background: #15803d;
}
</style>
</head>


<body>


<!-- SIDEBAR -->
<div class="sidebar">
  <div class="profile">
      <div class="avatar"></div>
      <p id="patientName">Patient Name</p>
  </div>
  <nav>
      <a href="patient_dashboard.php" class="active">Home</a>
      <a href="my_appointment.php">My Appointment</a>
      <a href="patient_settings.php">Settings</a>
  </nav>
  <div class="logout">
      <a href="login.php">Logout</a>
      <?php
      if (isset($_POST['logout'])) {
          session_destroy();
          header("Location: login.php");
          exit;
      }
      ?>
  </div>
</div>

<div class="main">

  <div class="top-head">
      <h1>My Appointments</h1>
  </div>

  <div class="doctor-list">
    <h2 class="section-title">Appointment History</h2>
    <table>
        <thead>
            <tr>
                <th>Doctor Name</th>
                <th>Specialist</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="appointmentList">
        </tbody>
    </table>
  </div>

</div>

</body>
</html>