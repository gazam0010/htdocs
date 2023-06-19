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
mysqli_close($db);
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
        </div>
        <div class="w3-contianer">
            <div class="w3-bar w3-border w3-light-grey w3-card-4">
                <a href="op_index.php" class="w3-bar-item w3-button">Home</a>
                <a href="enrol.php" class="w3-bar-item w3-button">Create Account</a>
                <a href="usersinfo/op_usersinfo.php" class="w3-bar-item w3-button">Search Account</a>
                <?php if ($designation == "System Administrator") : ?>
                    <a href="system_upd.php" class="w3-bar-item w3-button">System Security</a>
                    <a href="#" class="w3-bar-item w3-button w3-red">Tickets Resolution</a>
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

    <?php if ($designation == "System Administrator") : ?>

    <div class="body-main">
        <div class="body-content">
            <div class="search-tab w3-card">
                <form method="GET" action="">
                    <table width="100%">
                        <tr>
                            <td>
                                <input type="text" name="tkt_search_param" class="w3-input w3-large w3-border w3-round" style="width: 95%;" placeholder="Search Ticket ID/Status">
                            </td>
                            <td>
                                <input type="submit" name="search-tkt" class="w3-btn w3-blue" value="Search">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <?php 
            include('alert.php');
            ?>
            <div class="result-out w3-card">
                <?php
                $db1 = mysqli_connect('localhost', 'root', '', 'site');
                if (isset($_GET['search-tkt'])) {
                    $tkt_param = $_GET['tkt_search_param'];
                    $query = "SELECT * FROM query WHERE ticket_id='$tkt_param' OR ticket_status='$tkt_param'";
                    $result = mysqli_query($db1, $query);

                    if(mysqli_num_rows($result) > 0) {

                    while($tkt_rows = mysqli_fetch_assoc($result)) {

                    if ($tkt_rows['ticket_status'] == "Open") {
                        $tkt_status = '<font color="green">'.$tkt_rows['ticket_status'].'</font>';
                    } else if($tkt_rows['ticket_status'] == "Processing") {
                        $tkt_status = '<font color="orange">'.$tkt_rows['ticket_status'].'</font>';
                    } else if($tkt_rows['ticket_status'] == "Closed") {
                        $tkt_status = '<font color="red">'.$tkt_rows['ticket_status'].'</font>';
                    }

                    echo '<font size="5px"><strong>Ticket ID: </strong>'.$tkt_rows['ticket_id'].'</font>';
                    echo '<table>';
                    echo '<tr>';
                    echo '<th>Customer ID: </th>
                    <td><a target="_blank" style="color: blue; text-decoration: none;" href="usersinfo/op_usersinfo.php?search_param='.$tkt_rows['customer_id']
                    .'&search=&userControlModalReturn=1">'
                    .$tkt_rows['customer_id'].'</a></td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<tr>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<th>Ticket Status: </th><td>'.$tkt_status.'</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<th>Query: </th><td>'.$tkt_rows['msg'].'</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<th>Ticket Date & Time: </th><td>'.(date("d-m-Y h:i:s a", $tkt_rows['date_time']+16200)).' IST</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '</tr>';
                    echo '<td colspan="2">';
                    echo '<p></p>';
                    echo '</td>';
                    echo '<tr>';
                    echo '<th>Employee ID: </th><td>'.$tkt_rows['employee_id'].'</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<th>Comment: </th><td>'.$tkt_rows['comment'].'</td>';
                    echo '</tr>';
                    if ($tkt_rows['ticket_status'] == "Closed") {
                    echo '<tr>';
                    echo '<th>Close Date & Time: </th><td>'.(date("d-m-Y h:i:s a", $tkt_rows['close_date']+16200)).' IST</td>';
                    echo '</tr>';
                    }
                    echo '</table>';

                    echo '<form method="POST" action="">';
                    echo '<label>Comment: </label>';
                    echo '<input type="text" name="com" placeholder="Comment" class="w3-input" style="width: 50%;"><br>';
                    echo '<input type="hidden" name="tkt_id" value="'.$tkt_rows['ticket_id'].'">';
                    echo '<input type="submit" name="com_save" class="w3-btn w3-blue" value="Save"><br><br>';
                    echo '</form>';
                    echo '<form method="POST" action="">';
                    echo 'Update Ticket Status: ';
                    echo '<input type="hidden" name="tkt_id" value="'.$tkt_rows['ticket_id'].'">';
                    if($tkt_rows['ticket_status'] == "Closed") {
                        echo '<input type="submit" name="open_tkt" class="w3-btn w3-green" value="Re-Open">';
                        } else if($tkt_rows['ticket_status'] == "Processing") {
                            echo '<input type="submit" name="close_tkt" class="w3-btn w3-red" value="Close">';
                        } else {
                            echo '<input type="submit" name="proc_tkt" class="w3-btn w3-orange" value="Processing">&nbsp;&nbsp;';
                            echo '<input type="submit" name="close_tkt" class="w3-btn w3-red" value="Close">';
                        }
                    echo '<br><p align="right"><input type="submit" name="flush_tkt" class="w3-btn w3-red w3-small" onclick="return tktFlush()" value="Flush Ticket"></p>';
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