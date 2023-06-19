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
    <title>Password Reset</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style type="text/css">
        .login {
            background-color: whitesmoke;
            padding-left: 11%;
            padding-right: 9%;
            padding-top: 4%;
            padding-bottom: 3%;
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

        .req-return-status {
            background-color: lightgrey;
            padding: 1%;
        }
    </style>
</head>

<body>
    <div class="login w3-card">
        <?php
        if (isset($_GET['password_reset_emp']) && ($_GET['emp_id']) && ($_GET['req_id']) && ($_GET['request_hash'])) {

            $req_hash = $_GET['request_hash'];
            $req_id = $_GET['req_id'];
            $emp_id = $_GET['emp_id'];

            $chk_get_value_existence = "SELECT * FROM employee_password_reset WHERE req_id='$req_id' AND emp_id='$emp_id' AND request_hash='$req_hash'";
            $result_existence_check = mysqli_query($db, $chk_get_value_existence);
            $exists = mysqli_num_rows($result_existence_check);

            if ($exists == 1) {
                
                echo '<form action="" method="POST">';
                echo '<p>Employee ID: <strong>'.$emp_id.'</strong></p>';
                echo '<hr color="lightgrey">';
                echo '<input type="hidden" name="emp_id" value="'.$_GET['emp_id'].'">';
                echo '<input type="hidden" name="req_id" value="'.$_GET['req_id'].'">';
                echo '<input type="hidden" name="request_hash" value="'.$_GET['request_hash'].'">';
                echo '<input type="hidden" name="return" value="'. $_SERVER['REQUEST_URI'] .'">';
                echo '<label>New Password: </label>';
                echo '<input type="password" name="pass_1" class="w3-input w3-border w3-round" required>';
                echo '<label>Repeat New Password: </label>';
                echo '<input type="password" name="pass_2" class="w3-input w3-border w3-round" required><br>';
                echo '<input name="op_change_pass_emp" type="submit" class="w3-button w3-red" value="Change">';
                echo '</form>';
            } else {
                header('location: op_reset_password_emp.php?&status=0&req_return=Invalid request, kindly re-apply.');
                exit();
            }
        } else {
    header('location: op_reset_password_emp.php?&status=0&req_return=Apply new request for password change on this page.');
    exit();
}
        ?>
    </div>
</body>

</html>