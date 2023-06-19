<?php
include('op_afterlogin.php');
$eid = $_SESSION['cf40c61e54a706033144ba6a76fa7fce_opusername'];
$query = "SELECT desig FROM adm WHERE username = '$eid'";
$result = mysqli_query($db, $query);
$desig = mysqli_fetch_assoc($result);
$designation = $desig['desig'];
mysqli_close($db);
?>
<html>

<head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        .query {
            padding: 3%;
            margin: 5%;
            background-color: whitesmoke;
        }

        table th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            text-align: left;
            padding: 1%;
        }
    </style>
</head>

<body>
    <?php
    $db = mysqli_connect('localhost', 'root', '', 'site');
    if (isset($_GET['ticket_id'])) {
        $tkt_id_get = mysqli_escape_string($db, $_GET['ticket_id']);
        $query = "SELECT * FROM query WHERE ticket_id='$tkt_id_get'";
        $result = mysqli_query($db, $query);

        if (mysqli_num_rows($result) == 1) {

            while ($tkt = mysqli_fetch_assoc($result)) {
                if ($tkt['ticket_status'] == "Open") {
                    $tkt_status = '<font color="green">' . $tkt['ticket_status'] . '</font';
                } else if ($tkt['ticket_status'] == "Processing") {
                    $tkt_status = '<font color="orange">' . $tkt['ticket_status'] . '</font';
                } else if ($tkt['ticket_status'] == "Closed") {
                    $tkt_status = '<font color="red">' . $tkt['ticket_status'] . '</font';
                }
                echo '<div class="query w3-card">';
                echo '<strong>Ticket ID: </strong>' . $tkt['ticket_id'] . '<br>';
                echo '<br><table class="w3-striped" width="100%">';
                echo '<tr>';
                echo '<th>Customer ID: </th><td>' . $tkt['customer_id'] . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<th>Employee ID: </th><td>' . $tkt['employee_id'] . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<th>Query Message: </th><td>' . $tkt['msg'] . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<th>Ticket Date & Time: </th><td>' . (date("d-m-Y h:i:s a", $tkt['date_time']+15480)) . ' IST</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<th>Ticket Status: </th><td>' . $tkt_status . '</td>';
                if ($tkt['ticket_status'] == "Closed") {
                    echo '<tr>';
                    echo '<th>Close Date & Time: </th><td>' . (date("d-m-Y h:i:s a", $tkt['close_date']+15480)) . ' IST</td>';
                    echo '</tr>';
                }
                echo '</table><br>';
                echo '<strong>Comment: </strong><td>' . $tkt['comment'] . '</td>';
                if ($designation == "System Administrator") {
                    echo '<p align="center"><a target="_blank" href="tickets_resolution.php?tkt_search_param=' . $tkt['ticket_id'] . '&search-tkt=Search">Ticket Resolution</a></p>';
                }
                echo '</div>';
            }
        } else {
            echo '<br><br><br>';
            echo '<p align="center"><font color="red">Invalid request or ticket doesn\'t exists.</font></p>';
            echo '<br><br><br>';
        }
    }
    ?>
    <center><input type=button onClick="self.close();" value="Close this window"></center>
</body>

</html>