<?php
include("op_server.php");
?>
<?php
include("alert.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style type="text/css">
        .login {
            background-color: whitesmoke;
            padding-left: 11%;
            padding-right: 9%;
            padding-top: 7%;
            padding-bottom: 4%;
            margin-left: 18%;
            margin-right: 18%;
            margin-top: 9%;
            margin-bottom: 9%;
        }
        .msg {
            width: 17%;
            position: fixed;
            right: 0;
        }

        .msg-container {
            padding: 4%;
            border-radius: 10px;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }
    </style>
</head>
<body>
   <div class="login w3-card">
   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label>Username/Employee ID</label>
                <input type="text" name="username" class="w3-input w3-border w3-round" value="">
                <label>Password</label>
                <input type="password" name="password" class="w3-input w3-border w3-round"><br>
                <input name="login_user" type="submit" class="w3-button w3-red" value="Login">
                <br>
                <p align="left"><a href="op_reset_password_emp.php" style="text-decoration: none;">Forgot Password?</a></p>
        </form>
   </div>
</body>
</html>