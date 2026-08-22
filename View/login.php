<?php
include '../Controller/login_validation.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login-Doctor Appointment System</title>

    <script>
        function collect_data()
            {
                let uname = document.getElementById("uname").value.trim();
                let pass = document.getElementById("pass").value.trim();
                let valid = true;
                let message="";
                if(uname.length <5)
                {
                    message+="User Name Should be 5 Char";
                    valid = false;
                }
                if(pass.length <5)
                {
                    message+="Password Must be 5 Char";
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
</style>
</head>
<body>
    <div class="container-login">
        <h1>Login to Doctor Appointment System</h1>
        <form action="" method="POST" onsubmit="return collect_data();">
            <table>
                <tr>
                    <td><label for="Username">Username:</label></td>
                    <td><input type="text" id="uname" name="uname"></td>
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