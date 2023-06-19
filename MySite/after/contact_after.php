<?php include('afterlogin.php'); ?>
<?php include('header_after.php') ?>
<?php
if (isset($_GET['logout'])) {
    unset($_SESSION['b80bb7740288fda1f201890375a60c8f_id']);
    unset($_SESSION['a3da707b651c79ecc39a4986516180b2_fname']);
    unset($_SESSION['0c83f57c786a0b4a39efab23731c7ebc_email']);
    unset($_SESSION['532c28d5412dd75bf975fb951c740a30_mobile']);
    header("location: /MySite/contact_us.php");
}
?>
<?php
$_SESSION['previous_page'] = 'contact_after.php'
?>
<!DOCTYPE html>
<html>

<head>


    <title>COVID 19 Information System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <link rel="stylesheet" href="style_after.css">
    <!-------------Header--------------->
    <style>
        body-header {
            margin: 0;
            font-size: 28px;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>

    <!---------------Header end------------------>
    <!--Footer Code-->
    <style>
        .footer-foo {
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #2b2b2b;
            color: whitesmoke;
            text-align: center;
        }
    </style>
    <!--End of footer Code-->
    <style>
        .body-cont {
            margin-left: 15%;
            margin-right: 15%;
            margin-top: 1%;
            margin-bottom: 3%;
            padding: 3%;
            background-color: whitesmoke;

        }

        .body-cont h1 {
            font-size: 25px;
            text-align: left;
            font-weight: bold;
            line-height: 1.6;
        }

        .body-cont h2 {
            font-size: 20px;
            text-align: left;
            line-height: 1.6;
        }

        .body-cont h3 {
            font-size: 15px;
            text-align: left;
        }

        .main-cont-serv {
            margin-left: 20%;
            margin-right: 20%;
            padding: 2%;
        }

        .vl {
            border-left: 2px solid grey;
            height: 15px;
        }

        .prev-req {
            margin-left: 5%;
            margin-right: 5%;
            margin-top: 2%;
        }
    </style>
    <!---MSG CSS--->
    <style>
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
    <!----------------Write header---------------->

    <!-----------------Write header end------------->

    <div class="w3-container w3-indigo">
        <h1 align='center'>COVID 19 <br>
            <font size="5">Information System</font>
        </h1>
    </div>
    <div class="w3-contianer">
        <div class="w3-bar w3-border w3-light-grey w3-card-4">
            <a style="text-decoration: none;" href="start_after.php" class="w3-bar-item w3-button">Home</a>
            <a style="text-decoration: none;" href="donate_after.php" class="w3-bar-item w3-button">Donate</a>
            <a style="text-decoration: none;" href="services_after.php" class="w3-bar-item w3-button">Services</a>
            <a style="text-decoration: none;" href="covid_info_after.php" class="w3-bar-item w3-button">About Corona Virus</a>
            <a style="text-decoration: none;" href="#" class="w3-bar-item w3-button w3-red">Contact Us</a>


            <a style="text-decoration: none;" class="w3-bar-item w3-button w3-right">
                <span class="vl"></span>
                &nbsp; Welcome, <font size="4.5"><strong><?php echo htmlspecialchars($_SESSION["a3da707b651c79ecc39a4986516180b2_fname"]); ?></strong></font></a>

            <div class="w3-dropdown-hover w3-right">
                <button class="w3-button">Menu</button>
                <div class="w3-dropdown-content w3-bar-block w3-card-4">
                    <a style="text-decoration: none;" href="profile.php" class="w3-bar-item w3-button">Profile</a>
                    <a style="text-decoration: none;" href="wallet.php" class="w3-bar-item w3-button">Wallet</a>
                    <a style="text-decoration: none;" href="change-password.php" class="w3-bar-item w3-button">Change Password</a>
                    <a style="text-decoration: none;" href="?logout='1'" class="w3-bar-item w3-button">Logout</a>
                </div>
            </div>
        </div>
    </div>



    <!----------Body Starts Here--------->
    <?php
    include('alert_after.php');
    ?>
    <div class="body-cont w3-card">

        <h1 align="left">
            Contact Us
        </h1>
        <hr style="height:2px;
      border-width:0;
      color:gray;
      background-color:gray">

        <form method="post" action="" style="padding-left: 15%; padding-right: 15%; padding-top: 3%">
            <label>Query Type: </label>
            <input type="text" name="query_type" class="w3-input w3-border-green w3-round" required>
            <label>Query Message: </label>
            <input type="text" name="query_msg" class="w3-input w3-border-green w3-round" required><br>
            <input type="submit" value="Submit" name="query_user" class="w3-button w3-green w3-round w3-right">
        </form>
        <br>
        <div class="prev-req">
            <h2>Previous Requests
                <a href="#" onclick="openTktSection()">
                    <img src="/MySite/img/down-arrow.png" height="3%" width="3%"></img>
                </a>
            </h2>
            <hr style="height:1px;
                    border-width:0;
                    color:gray;
                    background-color:gray;
                    width: 15%;">
            <div id="tkt-out" style="visibility: hidden;">
                <?php
                $query = "SELECT * FROM query WHERE customer_id='$id' ORDER BY date_time DESC";
                $result = mysqli_query($db1, $query);

                if (mysqli_num_rows($result) > 0) {

                    while ($tkt_rows = mysqli_fetch_assoc($result)) {

                        if ($tkt_rows['ticket_status'] == "Open") {
                            $tkt_status = '<font color="green">' . $tkt_rows['ticket_status'] . '</font>';
                        } else if ($tkt_rows['ticket_status'] == "Processing") {
                            $tkt_status = '<font color="orange">' . $tkt_rows['ticket_status'] . '</font>';
                        } else if ($tkt_rows['ticket_status'] == "Closed") {
                            $tkt_status = '<font color="red">' . $tkt_rows['ticket_status'] . '</font>';
                        }

                        echo '<h2><strong>Ticket ID: </strong>' . $tkt_rows['ticket_id'] . '</h2>';
                        echo '<div style="padding-left: 2%;">';
                        echo '<table style="line-height: 1.6">';

                        echo '<tr>';
                        echo '<tr>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<th>Ticket Status: </th><td>' . $tkt_status . '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<th>Query: </th><td>' . $tkt_rows['msg'] . '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<th>Ticket Date & Time: </th><td>' . (date("d-m-Y h:i:s a", $tkt_rows['date_time'] + 16200)) . ' IST</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '</tr>';
                        echo '<td colspan="2">';
                        echo '<p></p>';
                        echo '</td>';

                        echo '<tr>';
                        echo '<th>Comment: </th><td>' . $tkt_rows['comment'] . '</td>';
                        echo '</tr>';
                        if ($tkt_rows['ticket_status'] == "Closed") {
                            echo '<tr>';
                            echo '<th>Close Date & Time: </th><td>' . (date("d-m-Y h:i:s a", $tkt_rows['close_date'] + 16200)) . ' IST</td>';
                            echo '</tr>';
                        }
                        echo '</table>';
                        echo '</div>';

                        echo '<hr color="lightgrey">';
                    }
                } else {
                    echo '<p align="center"><font color="blue">No previous requests!</font></p>';
                }
                mysqli_close($db1);
                ?>
            </div>
        </div>

    </div>

    <!---------Body End Here------------->

    <script>
        $(document).ready(function() {
            $('.dropdown-submenu a.test').on("click", function(e) {
                $(this).next('ul').toggle();
                e.stopPropagation();
                e.preventDefault();
            });
        });
    </script>
    <script>
        var x = document.getElementById('tkt-out');

        function openTktSection() {
            if (x.style.visibility === 'hidden') {
                x.style.visibility = 'visible';
            } else {
                x.style.visibility = 'hidden';
            }
        }
    </script>
</body>
<?php
include("footer.php");
?>

</html>