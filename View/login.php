<?php
include '../Controller/login_validation.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login-Doctor Appointment System</title>

    <script>
        function setRole(role) {
            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => tab.classList.toggle('active', tab.dataset.role === role));
            const hiddenRole = document.getElementById('role');
            if (hiddenRole) {
                hiddenRole.value = role;
            }
        }

        function collect_data() {
                let uname = document.getElementById("uname").value.trim();
                let pass = document.getElementById("pass").value.trim();
                let valid = true;
                let message="";
                if(uname.length <3)
                {
                    message+="Username should be at least 3 characters. ";
                    valid = false;
                }
                if(pass.length <5)
                {
                    message+="Password must be at least 5 characters.";
                    valid = false;
                }
                if(!valid)
                {
                    alert(message);
                }
                return valid;
    }
    </script>

<style>
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Cambria, Cochin, Georgia, "Times New Roman", serif;
  background-color: #7ce7ec ;
  padding: 50px;
  line-height: 1.5;
}

.container-login {
  max-width: 420px;
  margin: 0 auto;
  background-color: #d8fefd;
  padding: 30px;
  border-radius: 8px;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.tabs {
  display: flex;
  gap: 8px;
  margin-bottom: 20px;
}

.tab {
  flex: 1;
  text-align: center;
  padding: 10px 8px;
  border: 1px solid #1a4dd6;
  border-radius: 8px;
  background: #fff;
  color: #1a4dd6;
  cursor: pointer;
  font-weight: bold;
}

.tab.active {
  background: #1a4dd6;
  color: #fff;
}

h1 {
  color: #1a4dd6;
  text-align: center;
  margin-bottom: 25px;
  font-size: 28px;
}

form {
  display: flex;
  flex-direction: column;
}

table {
  width: 100%;
}

td {
  padding: 8px 0;
}

label {
  display: block;
  color: #222;
  font-size: 16px;
  margin-bottom: 4px;
}

input[type="text"],
input[type="password"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #999;
  border-radius: 8px;
  font-size: 15px;
}

input[type="text"]:focus,
input[type="password"]:focus {
  outline: none;
  border-color: #1a4dd6;
}

input[type="checkbox"] {
  cursor: pointer;
}

input[type="checkbox"] + label {
  display: inline;
  margin-left: 6px;
  cursor: pointer;
}

input[type="submit"],
input[type="reset"] {
  padding: 12px 0;
  width: 100%;
  border: none;
  border-radius: 10px;
  font-weight: bold;
  font-size: 16px;
  cursor: pointer;
  margin-top: 15px;
  transition: background-color 0.2s ease;
}

input[type="submit"] {
  background-color: #d92626;
  color: #fff;
}

input[type="submit"]:hover {
  background-color: #5bf08a;
}

input[type="reset"] {
  background-color: #ddd;
  color: #222222;
  margin-top: 8px;
}

input[type="reset"]:hover {
  background-color: #bbb;
}

.message {
  background-color: #fdecea;
  color: #b71c1c;
  border: 1px solid #f5c6cb;
  border-radius: 6px;
  padding: 10px;
  margin-bottom: 15px;
  font-size: 14px;
  text-align: center;
}
</style>
</head>
<body>
    <div class="container-login">
        <h1>Login to Doctor Appointment System</h1>

        <?php if (!empty($message)) { ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php } ?>

        <div class="tabs">
            <div class="tab active" data-role="patient" onclick="setRole('patient')">Patient</div>
            <div class="tab" data-role="admin" onclick="setRole('admin')">Admin</div>
            <div class="tab" data-role="doctor" onclick="setRole('doctor')">Doctor</div>
        </div>

        <form action="" method="POST" onsubmit="return collect_data();">
            <input type="hidden" id="role" name="role" value="patient">
            <table>
                <tr>
                    <td><label for="Username">Username:</label></td>
                    <td><input type="text" id="uname" name="uname" value="<?php echo htmlspecialchars($uname); ?>"></td>
                </tr>

                <tr>
                    <td><label for="Password">Password:</label></td>
                    <td><input type="password" id="pass" name="pass"></td>
                </tr>

                <tr>
                    <td colspan="2"> 
                        <input type="checkbox" id="remember" name="remember" value="1" <?php echo (!empty($_COOKIE["remember_user"])) ? "checked" : ""; ?>>
                        <label for="remember"> Remember Me </label>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" id="submit" value="LogIn">
                        <input type="reset" id="reset">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <p>Don't have an account? <a href="register.php">Register</a></p>
                    </td>
                </tr>
            </table>

        </form>
    </div>
</body>