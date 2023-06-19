<?php
include('op_afterlogin_emp.php');
?>
<?php
if (isset($_GET['logout'])) {
    unset($_SESSION['cf40c61e54a706033144ba6a76fa7fce_opusername']);
    unset($_SESSION['b35d1ea7a896f20de51e7ab5038ed614_opfname']);
    unset($_SESSION['04a725b8d543725b399199a3ea65f8f8_opemail']);
    header("location: /MySite/adm/operator.php");
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
        .vl {
            border-left: 2px solid grey;
            height: 15px;
        }

        .body-main {
            padding: 1%;
            margin: 1%;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .body-content {
            flex: 10 auto;
        }

        .search-tab {
            padding: 3%;
            background-color: whitesmoke;
        }

        .result-out {
            padding: 2%;
            margin-top: 1%;
            background-color: whitesmoke;
        }

        .result-out table {
            padding: 2%;
        }

        .result-out th, td {
            text-align: left;
        }

        .result-out form {
            margin-left: 2%;
        }

        footer {
            margin-top: 2%;
            text-align: center;
            background-color: whitesmoke;
            padding: 2%;
            width: 100%;
            bottom: 0;
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
    <div class="header-nav">
        <div class="w3-container w3-teal">
        <h1 align='center'>CIS Admin Panel</h1>
            <h6 align='center'>Employees Control</h6>
        </div>
        <div class="w3-contianer">
            <div class="w3-bar w3-border w3-light-grey w3-card-4">
            <a href="op_index_emp.php" class="w3-bar-item w3-button">Home</a>
                <a href="op_enrol_emp.php" class="w3-bar-item w3-button">Create Account</a>
                <a href="op_empinfo.php" class="w3-bar-item w3-button">Search Account</a>
                <a href="#" class="w3-bar-item w3-button w3-red">Requests</a>
                <a href="?logout='1'" class="w3-bar-item w3-button"> Logout</a>
                <a href="../op_index.php" class="w3-bar-item w3-button w3-border w3-round"> User Control</a>
                <a href="op_profile.php" class="w3-bar-item w3-button w3-right"><span class="vl"></span>
                &nbsp;&nbsp;<?php echo $_SESSION['b35d1ea7a896f20de51e7ab5038ed614_opfname']
                                                                . ", <font size='3'>" . $_SESSION['8454f46898d7c94cff04ff0f78674193_opdesig'] . "</font>"; ?></a>
            </div>
        </div>
    </div>

    <?php if ($designation == "System Administrator") : ?>

    <div class="body-main">
        <div class="body-content">
            <div class="search-tab w3-card">
                <form method="GET" action="">
                    <table width="100%">
                        <tr>
                            <td>
                                <input type="text" name="tkt_search_param" class="w3-input w3-large w3-border w3-round" style="width: 95%;" placeholder="Search Request ID/Status">
                            </td>
                            <td>
                                <input type="submit" name="search-tkt" class="w3-btn w3-blue" value="Search">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <?php 
            include('../alert.php');
            ?>
            <div class="result-out w3-card">
                <?php
                $db1 = mysqli_connect('localhost', 'root', '', 'site');
                if (isset($_GET['search-tkt'])) {
                    $tkt_param = $_GET['tkt_search_param'];
                    $query = "SELECT * FROM employee_password_reset WHERE req_id='$tkt_param' OR status='$tkt_param'";
                    $result = mysqli_query($db1, $query);

                    if(mysqli_num_rows($result) > 0) {

                    while($tkt_rows = mysqli_fetch_assoc($result)) {

                    if ($tkt_rows['status'] == "Open") {
                        $tkt_status =  '<font color="green">'.$tkt_rows['status'].'</font>';
                    }

                    else  if ($tkt_rows['status'] == "Processing"){
                        $tkt_status =  '<font color="orange">'.$tkt_rows['status'].'</font>';
                    }

                    else if ($tkt_rows['status'] == "Approved"){
                        $tkt_status =  '<font color="green">'.$tkt_rows['status'].'</font>';
                    }

                    else if ($tkt_rows['status'] == "Reset link sent"){
                        $tkt_status =  '<font color="green">'.$tkt_rows['status'].'</font>';
                    } else {
                        $tkt_status =  '<font color="red">'.$tkt_rows['status'].'</font>';
                    }

                    echo '<font size="5px"><strong>Request ID/Secret Key: </strong>'.$tkt_rows['req_id'].'</font>';
                    echo '<table>';
                    echo '<tr>';
                    echo '<th>Employee ID: </th>
                    <td><a target="_blank" style="color: blue; text-decoration: none;" href="usersinfo/op_usersinfo.php?search_param='.$tkt_rows['emp_id']
                    .'&search=&userControlModalReturn=1">'
                    .$tkt_rows['emp_id'].'</a></td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<tr>';
                    echo '<td><strong>Status: </strong>'.$tkt_status.'</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<th>Request Date & Time: </th><td>'.(date("d-m-Y h:i:s a", $tkt_rows['date_time'])).' GMT</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '</tr>';
                    echo '</table>';

                  
                    echo '<form method="POST" action="">';
                    echo '<input type="hidden" name="req_id" value="'.$tkt_rows['req_id'].'">';
                    echo '<input type="hidden" name="emp_id" value="'.$tkt_rows['emp_id'].'">';
                    if($tkt_rows['status'] == "Open") {
                        echo '<input type="submit" name="processsing_req" class="w3-btn w3-orange" value="Mark Processing">';
                    }
                    if($tkt_rows['status'] == "Processing") {
                            echo '<input type="submit" name="approved_req" class="w3-btn w3-green" onclick="return approve()" value="Verified with ID">';
                    }
                    if($tkt_rows['status'] == "Approved") {
                            echo '<input type="submit" name="link_sent_req_pass_change_emp" class="w3-btn w3-green" value="Send password reset link">&nbsp;&nbsp;';
                    }
                    echo '<table width="100%">';
                    echo '<tr>';
                    if($tkt_rows['status'] == "Rejected") {
                        echo '<td align="left">';
                        echo '<br><input type="submit" name="dlt_req_pswd_emp" class="w3-btn w3-red w3-small" value="Flush Request">&nbsp;&nbsp;';
                        echo '</td>';
                    }
                    
                    echo '<td align="right">';
                    echo '<br><p align="right"><input type="submit" name="reject_req" class="w3-btn w3-small w3-red" value="Reject Request"></p>';
                    echo '<td>';
                    echo '</table>';
                    echo '</form>';
                    echo '<hr color="lightgrey">';
                    }
                } else {
                    echo '<p align="center"><font color="red">No result found!</font></p>';
                }
            }
                ?>
            </div>

        </div>
    </div>
    <script>
    function approve() {
        if(confirm('I have verified the employee with his/her ID card.')) {
            return true;
        }
        return false;
    }
    </script>
    <script>
        function tktFlush() {
            if(confirm('This will delete the ticket.')) {
                return true;
            }
            return false;
        }
    </script>

      <?php endif ?>
      
      <?php if($designation == "Customer Support") : ?>
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

    <footer class="w3-card-2">
        Designed and Developed by Gulfarogh Azam<br>Faculty Number: 18CAB105<br>Enrollment Number: GL0210
    </footer>
</body>

</html>