<?php
include('op_afterlogin.php');
?>
<?php
if (isset($_GET['logout'])) {
    unset($_SESSION['cf40c61e54a706033144ba6a76fa7fce_opusername']);
    unset($_SESSION['b35d1ea7a896f20de51e7ab5038ed614_opfname']);
    unset($_SESSION['04a725b8d543725b399199a3ea65f8f8_opemail']);
    header("location: /MySite/adm/operator.php");
}
?>
<?php
$adm_username = $_SESSION['cf40c61e54a706033144ba6a76fa7fce_opusername'];
$query = "SELECT desig FROM adm WHERE username = '$adm_username'";
$result = mysqli_query($db, $query);
$desig = mysqli_fetch_assoc($result);
$designation = $desig['desig'];

$query_system_gate = "SELECT * FROM system_gate";
$result_system_gate = mysqli_query($db, $query_system_gate);
$status_system_gate = mysqli_fetch_assoc($result_system_gate);
if($status_system_gate['gate_status'] == 0) {
    $sys_status = '<font color="red">Locked</font>';
    $gate_bypass = '<form method="post" action="">
    
    <input type="submit" value="Unset Bypass Session" name="gate_bypass_unset" class="w3-button w3-right w3-red w3-small">
    <input type="submit" value="Click here to Use Bypass" name="gate_bypass" class="w3-button w3-right w3-green w3-small">
    </form>';
}
if($status_system_gate['gate_status'] == 1) {
    $sys_status = '<font color="orange">Under Construction</font>';
    $gate_bypass = '<form method="post" action="">
    <input type="submit" value="Unset Bypass Session" name="gate_bypass_unset" class="w3-button w3-right w3-red w3-small">
    <input type="submit" value="Click here to Use Bypass" name="gate_bypass" class="w3-button w3-right w3-green w3-small">
    </form>';
}
if($status_system_gate['gate_status'] == 2) {
    $sys_status = '<font color="green">Unlocked</font>';
    $gate_bypass = '';
}
$sys_date = date("d-m-Y h:i:sa", $status_system_gate['date']);
mysqli_close($db);
?>
<?php
if(isset($_POST['gate_bypass'])) {
  $_SESSION["head_mode"] = $opfname;
  header ('location: http://localhost/MySite/adm/system_upd.php?status=1&req_return=Bypass Enabled, <a href="http://localhost/MySite/start.php" target="_blank">Click Here</a> to access');
}
if(isset($_POST['gate_bypass_unset'])) {
    unset($_SESSION["head_mode"]);
    header ('location: http://localhost/MySite/adm/system_upd.php?status=1&req_return=Bypass Unset');
 }  
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>
        Welcome Admin
    </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIS Admin</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        footer {
            margin-top: 2%;
            text-align: center;
            background-color: whitesmoke;
            padding: 2%;
            width: 100%;
            bottom: 0;
        }

        .body-main {
            padding: 1%;
            margin: 1%;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-cont {
            padding-left: 5%;
            padding-right: 5%;
            margin-left: 35%;
            margin-right: 15%;
            margin-top: 3%;
            border: 1px solid grey;
            background-color: whitesmoke;
            flex: 10 auto;
        }

        .side-nav {
            left: 0;
            position: fixed;
            padding: 2%;
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

        .vl {
            border-left: 2px solid grey;
            height: 15px;
        }
    </style>
</head>

<body>
    <div class="header-nav">
        <div class="w3-container w3-teal">
            <h1 align='center'>CIS Admin Panel</h1>
        </div>
        <div class="w3-contianer">
            <div class="w3-bar w3-border w3-light-grey w3-card-4">
                <a href="op_index.php" class="w3-bar-item w3-button">Home</a>
                <a href="enrol.php" class="w3-bar-item w3-button">Create Account</a>
                <a href="usersinfo/op_usersinfo.php" class="w3-bar-item w3-button">Search Account</a>
                <?php if ($designation == "System Administrator") : ?>
                    <a href="system_upd.php" class="w3-bar-item w3-button w3-red">System Security</a>
                    <a href="tickets_resolution.php" class="w3-bar-item w3-button">Tickets Resolution</a>
                    <a href="employees_tickets.php" class="w3-bar-item w3-button">Employees Requests</a>
                <?php endif ?>
                <?php if ($designation == "Customer Support") : ?>
                    <a href="raise_request.php" class="w3-bar-item w3-button">Raise Request</a>
                <?php endif ?>
                <a href="?logout='1'" class="w3-bar-item w3-button"> Logout</a>
                <a href="op_profile.php" class="w3-bar-item w3-button w3-right"><span class="vl"></span>
                    &nbsp;&nbsp;<?php echo $_SESSION['b35d1ea7a896f20de51e7ab5038ed614_opfname']
                                    . ", <font size='3'>" . $_SESSION['8454f46898d7c94cff04ff0f78674193_opdesig'] . "</font>"; ?></a>
            </div>
        </div>
    </div>
    <div class="body-main">

        <?php if ($designation == "System Administrator") : ?>


            <?php include('alert.php'); ?>
            <div class="body-content">

                <nav class="w3-blue side-nav"><br>
                    <div class="w3-bar-block w3-small">
                        <h3>Menu</h3>
                        <hr>
                        <a href="#" onclick='sideNavOperator("disable-enable-users")' class="w3-bar-item w3-button w3-hover-white">Disable/Enable entire Users</a>
                        <a href="#" onclick='sideNavOperator("reset-pass-users")' class="w3-bar-item w3-button w3-hover-white">Reset entire Passwords(Users)</a>
                        <a href="#" onclick='sideNavOperator("reset-pass-cs")' class="w3-bar-item w3-button w3-hover-white">Reset entire Passwords(CS)</a>
                        <a href="#" onclick='sideNavOperator("lock-user-system")' class="w3-bar-item w3-button w3-hover-white">Lock/Unlock System</a>
                        <a href="#" onclick='sideNavOperator("page-hits")' class="w3-bar-item w3-button w3-hover-white">Hits</a>
                        <a href="#" onclick='sideNavOperator("ver-upd")' class="w3-bar-item w3-button w3-hover-white">Version Update</a>
                        <a href="#" onclick='sideNavOperator("ver-del")' class="w3-bar-item w3-button w3-hover-white">Version Delete</a>
                    </div>
                </nav>
                <div id="index" class="main-cont" style="display: block;">
                    <br>Welcome to the System Security section:-<br>
                    Kindly, refer to the user manual before accessing this section.<br>
                    This section is only meant to be accessed by the System Administrator.<br><br>
                </div>

                <div id="disable-enable-users" class="main-cont" style="display: none;">
                  <h3 align="center">Disable/Enable entire users of the system</h2>
                  <hr color="lightgrey">
                  <p align="center">This feature is only intended for some emergency situations.</p>
                  <p align="center">Master Password is required to access this feature.</p>
                  <br>
                  <form method="post" action="">
                      <label>Master Password: </label>
                      <input type="password" name="master_pass" class="w3-input w3-border w3-round" required><br>
                      <input type="radio" name="ena_dis" class="w3-radio w3-small" id="enable" value="enable" required>  <label for="enable">Enable</label><br>
                      <input type="radio" name="ena_dis" class="w3-radio w3-small" id="disable" value="disable" required>  <label for="disable">Disable</label><br>
                      <br>
                      <input type="checkbox" name="confirm_dis-ena" class="w3-check w3-small" id="confirm_dis_ena" value='i_confirm'> 
                      <label for="confirm_dis_ena">I confirm this change.</label><br><br>
                      <input type="submit" name="master_access_dis_ena_users" class="w3-btn w3-red" value="Proceed">
                      <br><br>
                  </form>
                </div>

                <div id="reset-pass-users" class="main-cont" style="display: none;"> 
                <h3 align="center">Reset passwords of entire users of the system</h2>
                  <hr color="lightgrey">
                  <p align="center">This feature is only intended for some emergency situations.</p>
                  <p align="center">After this, users need to reset their passwords individually.</p>
                  <p align="center">Master Password is required to access this feature.</p>
                  <br>
                  <form method="post" action="">
                      <label>Master Password: </label>
                      <input type="password" name="master_pass" class="w3-input w3-border w3-round" required><br>
                      <br>
                      <input type="checkbox" name="confirm_dis-ena" class="w3-check w3-small" id="confirm_pass_reset" value='i_confirm'> 
                      <label for="confirm_pass_reset">I confirm this change.</label><br><br>
                      <input type="submit" name="master_access_reset_pass_users" class="w3-btn w3-red" value="Proceed">
                      <br><br>
                  </form>
                </div>

                <div id="reset-pass-cs" class="main-cont" style="display: none;">
resc
                </div>

                <div id="lock-user-system" class="main-cont" style="display: none;">
                <h3 align="center">Lock/Unlock user system</h2>
                  <hr color="lightgrey">
                  <p align="center">This feature is only intended for some crucial situations.</p>
                  <p align="center">Master Password is required to access this feature.</p>
                  <p align="center">
                      <font size="2px">
                      Current system status: <?php echo $sys_status; ?> (<?php echo $sys_date ; ?> GMT).<br>
                      <?php echo $gate_bypass; ?>
                      </font>
                  </p>
                  <br>
                  <form method="post" action="">
                      <label>Master Password: </label>
                      <input type="password" name="master_pass" class="w3-input w3-border w3-round" required><br>
                      <p align="left">Select system status to be updated: </p>
                      <input type="radio" name="ena_dis" class="w3-radio w3-small" id="enable_sys" value="2" required>  <label for="enable_sys">Unlock System</label><br>
                      <input type="radio" name="ena_dis" class="w3-radio w3-small" id="under_cons" value="1" required>  <label for="under_cons">Under Construction</label><br>  
                      <input type="radio" name="ena_dis" class="w3-radio w3-small" id="lock" value="0" required>  <label for="lock">Lock</label><br>  
                      <br>
                      <input type="checkbox" name="confirm_dis-ena" class="w3-check w3-small" id="confirmation-lock-unlock-system" value='i_confirm'> 
                      <label for="confirmation-lock-unlock-system">I confirm this change.</label><br><br>
                      <input type="submit" name="lock_unlock_system" class="w3-btn w3-red" value="Proceed">
                      <br><br>
                  </form>
                </div>

                <div id="page-hits" class="main-cont" style="display: none;">
                    <h2 class="ver-upd-h2" align="center">Website Hits</h1>
                        <hr style="border-color: lightgrey" />
                        <p align="center"> Total number of of Hits: <?php echo $hits; ?> </p><br>
                        <form align="center" method="post" action="">
                            <label>New Value: </label>
                            <input type="text" class="w3-input" placeholder="Enter number of desired hits" name="hits-value" required><br>
                            <input type="submit" class="w3-button w3-blue" name="modify-hits" value="Modify"><br><br>
                        </form>
                        <form align="center" method="post" action="">
                            <input type="submit" name="reset-hits" value="Reset Hits Counter to Zero" class="w3-button w3-blue">
                        </form><br>
                </div>

                <div id="ver-upd" class="main-cont" style="display: none;">
                    <h2 class="ver-upd-h2" align="center">Insert version update</h1>
                        <hr style="border-color: lightgrey" />
                        <form align="center" method="post" action="">
                            <p>Current Version: <strong><?php echo $curr_version; ?></strong><br><br></p>
                            <label>Next Version: </label><br>
                            <input class="w3-input w3-border w3-round" type="text" name="version" style="text-align: center" value="<?php echo $next_version; ?>" required><br>
                            <label>Details: </label><br>
                            <textarea class="w3-input w3-border w3-round" name="details" required></textarea><br><br>
                            <input class="w3-button w3-blue" name="ver_upd" type="submit" value="Update">
                        </form><br>
                </div>

                <div id="ver-del" class="main-cont" style="display: none;">
                    <h2 class="ver-upd-h2" align="center">Delete version update</h1>
                        <hr style="border-color: lightgrey" />
                        <a href="../after/versions.php" target="_blank" style="text-decoration: none;">
                            <p align="center" style="background-color: orange; margin-left: 38%; margin-right: 38%; padding: 1%; border-radius: 2%; box-shadow: 1px 1px 0px 0px;">
                                <font size="2">Version Details</font>
                            </p>
                        </a>
                        <form align="center" method="post" action=""><br>
                            <label>Version: </label><br>
                            <input class="w3-input w3-border w3-round" type="text" name="ver" required><br><br>
                            <input class="w3-button w3-blue" type="submit" onclick="confirm('Do you really want to delete this version information from the DB?')" name="ver_dlt" value="Delete">
                        </form><br>
                </div>
            </div>
    </div>
    <footer class="w3-card-2">
        Designed and Developed by Gulfarogh Azam<br>Faculty Number: 18CAB105<br>Enrollment Number: GL0210
    </footer>

    <script>
        function sideNavOperator(param) {
            var index = document.getElementById('index');
            var a = document.getElementById('ver-upd');
            var b = document.getElementById('ver-del');
            var c = document.getElementById('page-hits');
            var d = document.getElementById('lock-user-system');
            var e = document.getElementById('reset-pass-cs');
            var f = document.getElementById('reset-pass-users');
            var g = document.getElementById('disable-enable-users');

            if (param == "ver-upd") {
                a.style.display = "block";
                b.style.display = "none";
                c.style.display = "none";
                d.style.display = "none";
                e.style.display = "none";
                f.style.display = "none";
                g.style.display = "none";
                index.style.display = "none";
            }
            if (param == "ver-del") {
                b.style.display = "block";
                a.style.display = "none";
                c.style.display = "none";
                d.style.display = "none";
                e.style.display = "none";
                f.style.display = "none";
                g.style.display = "none";
                index.style.display = "none";
            }
            if (param == "page-hits") {
                c.style.display = "block";
                a.style.display = "none";
                b.style.display = "none";
                d.style.display = "none";
                e.style.display = "none";
                f.style.display = "none";
                g.style.display = "none";
                index.style.display = "none";
            }
            if (param == "lock-user-system") {
                d.style.display = "block";
                a.style.display = "none";
                b.style.display = "none";
                c.style.display = "none";
                e.style.display = "none";
                f.style.display = "none";
                g.style.display = "none";
                index.style.display = "none";
            }
            if (param == "reset-pass-cs") {
                e.style.display = "block";
                a.style.display = "none";
                b.style.display = "none";
                c.style.display = "none";
                d.style.display = "none";
                f.style.display = "none";
                g.style.display = "none";
                index.style.display = "none";
            }
            if (param == "reset-pass-users") {
                f.style.display = "block";
                a.style.display = "none";
                b.style.display = "none";
                c.style.display = "none";
                e.style.display = "none";
                d.style.display = "none";
                g.style.display = "none";
                index.style.display = "none";
            }
            if (param == "disable-enable-users") {
                g.style.display = "block";
                a.style.display = "none";
                b.style.display = "none";
                c.style.display = "none";
                e.style.display = "none";
                f.style.display = "none";
                d.style.display = "none";
                index.style.display = "none";
            }
        }
    </script>
<?php endif ?>
<?php if ($designation == "Customer Support") : ?>
    <br>
    <p align="center"><img src="not_allowed.jpg" width="10%" height="10%"></img></p>
    <br>
    <h3 align="center">
        You are not allowed to access this section.
    </h3>
    <br>
    <h5 align="center">
        Kindly <a href="raise_request.php" style="text-decoration: none; color: blue;">Raise Request</a> for any further request.
    </h5>
<?php endif ?>
</body>

</html>