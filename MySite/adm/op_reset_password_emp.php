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
        <ul>
            <p align="left">
                <font size="2">
                    <li>Apply for password reset here.</li>
                </font>
            </p>
            <p align="left">
                <font size="2">
                    <li>
                        Kindly, contact System Administrator with Secret Key and your ID card after applying and do not leave this page.
                    </li>
                    </font>
            </p>
                    <p align="left">
                <font size="2">
                    <li>
                        Click Check Status to check the status of your request.
                    </li>
                </font>
            </p>
        </ul>
        <hr color="lightgrey">
        <form action="" method="POST">
            <label>Employee ID: </label>
            <input type="text" name="emp_id" class="w3-input w3-border w3-round" required>
            <label>Username: </label>
            <input type="text" name="username" class="w3-input w3-border w3-round" required><br>
            <input name="op_reset_pass_emp" type="submit" class="w3-button w3-red" value="Apply for Reset">
        </form>
        <?php if (isset($_GET['status']) && isset($_GET['req_id'])) : ?>
            <form action="" method="POST">
                <input type="hidden" name="req_id" value="<?php echo $_GET['req_id']; ?>">
                <hr color="lightgrey">
                <input type="submit" name="req_status_fetch" value="Check Status" class=" w3-button w3-small w3-orange">

                <?php if (isset($_GET['status']) && isset($_GET['req_id']) && isset($_GET['chk_sts'])) : ?>
                    &nbsp;&nbsp;&nbsp;

                    <?php
                    $req_id = $_GET['req_id'];
                    if ($_GET['status'] == "Open") {
                        echo 'Secret Key: ' . $_GET['req_id'] . ' - ';
                        echo '<font color="green">';
                        echo $_GET['status'];
                        echo '</font>';
                    } else  if ($_GET['status'] == "Processing") {
                        echo 'Secret Key: ' . $_GET['req_id'] . ' - ';
                        echo '<font color="orange">';
                        echo $_GET['status'];
                        echo '  </font>';
                    } else if ($_GET['status'] == "Approved") {
                        echo 'Secret Key: ' . $_GET['req_id'] . ' - ';
                        echo '<font color="green">';
                        echo $_GET['status'];
                        echo '</font>';
                    } else if ($_GET['status'] == "Reset link sent") {
                        echo 'Secret Key: ' . $_GET['req_id'] . ' - ';
                        echo '<font color="green">';
                        echo $_GET['status'];
                        echo '</font>';


                        $db = mysqli_connect('localhost', 'root', '', 'site');
                        $query = "SELECT * FROM employee_password_reset WHERE req_id='$req_id'";
                        $result = mysqli_query($db, $query);
                        $row = mysqli_fetch_assoc($result);
                        echo ' ' . $row['link'];
                        mysqli_close($db);
                    } else {
                        echo 'Secret Key: ' . $_GET['req_id'] . ' - ';
                        echo '<font color="red">';
                        echo $_GET['status'];
                        echo '</font>';
                    }
                    ?>


                <?php endif ?>
            </form>
        <?php endif ?>
    </div>
</body>

</html>