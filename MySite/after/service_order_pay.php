<?php include('afterlogin.php'); ?>
<?php include('header_after.php') ?>
<?php
if (isset($_GET['logout'])) {
    unset($_SESSION['b80bb7740288fda1f201890375a60c8f_id']);
    unset($_SESSION['a3da707b651c79ecc39a4986516180b2_fname']);
    unset($_SESSION['0c83f57c786a0b4a39efab23731c7ebc_email']);
    unset($_SESSION['532c28d5412dd75bf975fb951c740a30_mobile']);
    header("location: /MySite/services.php");
    exit();
}
?>

<?php
$_SESSION['previous_page'] = 'services_after.php'
?>
<?php
$bal_query = "SELECT balance FROM users WHERE mobile = '$username'";
$out = mysqli_query($db, $bal_query);
$bal = mysqli_fetch_assoc($out);
$balance1 = $bal['balance'];
$inner_use_balance = $bal['balance'];
$len = strlen($balance1);
if ($len > 0 && $len < 4) {
    $balance = $bal['balance'];
} elseif ($len == 4) {
    $bal = $bal['balance'];
    $one_ten_hundred = substr($bal, 1);
    $thousand_tenthousand = substr($bal, 0, -3);
    $balance = $thousand_tenthousand . "," . $one_ten_hundred;
} elseif ($len == 5) {
    $bal = $bal['balance'];
    $one_ten_hundred = substr($bal, 2);
    $thousand_tenthousand = substr($bal, 0, -3);
    $balance = $thousand_tenthousand . "," . $one_ten_hundred;
} elseif ($len == 6) {
    $bal = $bal['balance'];
    $one_ten_hundred = substr($bal, 3);
    $thousand_tenthousand_1 = substr($bal, 0, -3);
    $thousand_tenthousand_2 = substr($thousand_tenthousand_1, 1);
    $lac = substr($bal, 0, -5);
    $balance = $lac . "," . $thousand_tenthousand_2 . "," . $one_ten_hundred;
}
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
        .header {
            background-color: #f1f1f1;
            padding: 3px;
            text-align: center;
        }

        .header-header {
            background-color: #f1f1f1;
            padding: 3px;
            text-align: center;
        }

        .content {
            padding: 16px;
        }

        .sticky {
            position: fixed;
            top: 0;
            width: 100%;
        }

        .sticky+.content {
            padding-top: 60px;
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
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu .dropdown-menu {
            top: 0;
            right: 100%;
            margin-top: -1px;
        }



        img {
            margin-left: 20px;
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

        .pp {
            padding-left: 8%;
            padding-right: 8%;
            padding-top: 2%;
            padding-bottom: 2%;
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
            <a style="text-decoration: none;" href="#" class="w3-bar-item w3-button w3-red">Services</a>
            <a style="text-decoration: none;" href="covid_info_after.php" class="w3-bar-item w3-button">About Corona Virus</a>
            <a style="text-decoration: none;" href="contact_after.php" class="w3-bar-item w3-button">Contact Us</a>


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
  if (isset($_POST['place_service_order'])) {
$service_page_name = $_POST['service_page_name'];
$service_page_link = $_POST['service_page_link'];
  }
  ?>
    <div class="w3-container w3-padding-64">
        <div class="main-cont-serv w3-card">
            <p align="left">
                <font size="2px" color="grey"><a href="services_after.php">Services</a> / <a href="<?php echo $service_page_link; ?>"><?php echo $service_page_name; ?></a> / Payment</font>
            </p>
            <span style="font-size: 20px; line-height:1.6;">
                <br>
                <h3 align="left"><strong>Payment Status</strong></h3>
                <hr style="height:2px; border-width:0; color:gray;  background-color:gray">

                <div class="pp">
                    <?php
                    if (isset($_POST['place_service_order'])) {
                        $serv_name = mysqli_real_escape_string($db1, $_POST['service_name']);
                        $order_name = mysqli_real_escape_string($db1, $_POST['order_name']);
                        $serv_charge_reason = $_POST['service_charge_reason'];
                        $serv_charge = $_POST['service_charge'];
                        $order_charge = $_POST['order_charge'];
                        $address_services = $_POST['address_services'];
                        $pay_mode = $_POST['payment_mode'];
                        $od_id = rand(1000000, 9999000);
                        $txn_id = rand(10001111000, 99990009999);
                        $c_time = time();
                        $total_charge = $order_charge + $serv_charge;

                        $usage_place = "Service Order (" . $serv_name . ", " . $order_name . ", Order ID: " . $od_id . ")";
                        $txn_type = "Debit";

                        if ($pay_mode == "WA") {

                            $payment_mode_for_display = "Wallet";
                            $fetch_bal = "SELECT balance FROM users WHERE mobile='$username'";
                            $bal_result = mysqli_query($db, $fetch_bal);
                            $bal_param = mysqli_fetch_assoc($bal_result);
                            $bal = $bal_param['balance'];

                            if ($bal >= $total_charge) {
                                $query = "INSERT INTO ecommerce (txn_id, od_id, cust_id, service_name, order_name, service_charge_reason, payment_mode, date_time, service_charge, order_charge, user_service_address)
                                VALUES('$txn_id', '$od_id', '$id', '$serv_name', '$order_name', '$serv_charge_reason', '$pay_mode', '$c_time', '$serv_charge', '$order_charge', '$address_services')";
                                $result = mysqli_query($db1, $query);

                                if ($result) {

                                    $updated_bal = $bal - $total_charge;
                                    $insert = "UPDATE users SET balance = '$updated_bal' WHERE mobile = '$username'";
                                    $result = mysqli_query($db, $insert);

                                    $wallet_txn_data_store = "INSERT INTO wallet_transactions (id, txn_id, usage_place, amount, date_time, type) 
                                    VALUES ('$id', '$txn_id', '$usage_place', '$total_charge', '$c_time', '$txn_type')";
                                    mysqli_query($db, $wallet_txn_data_store);

                                    echo '<strong>We have successfully received your payment.</strong><br><br>';
                                    echo 'Your Order ID is: <strong>' . $od_id . '</strong><br>';
                                    echo 'Your Transaction ID is: <strong>' . $txn_id . '</strong><br>';
                                    echo 'Payment Mode: <strong>' . $payment_mode_for_display . '</strong><br><br>';
                                    echo 'Service Name: <strong>' . $serv_name . ' ('.$order_name.')</strong><br>';
                                    echo 'Total Amount Debited (Order + Service Charge): <strong>Rs. ' . $total_charge . '</strong><br>';
                                    echo 'Your Address: <strong>' . $address_services . '</strong><br>';
                                    echo '<br><br>';
                                    if($serv_name == "Medicines") {
                                        echo '<strong>You will recieve your medicines within next 7-20 days.</strong>';
                                    }
                                    if($serv_name == "Doctors Appointment") {
                                        echo '<strong>You will recieve a call from an specialized doctor on you registered mobile number within next 30-60 minutes.</strong>';
                                    }
                                    if($serv_name == "Withdraw Fund") {
                                        echo '<strong>You will receive your cash securely at the above address within the selected timeline.</strong>';
                                    }
                                    if($serv_name == "Deposit Fund") {
                                        echo '<strong>We will pickup your cash securely from the above address within the selected timeline. Cash picked up will be deposited on same day (excluding exceptions).</strong>';
                                    }
                                } else {
                                    echo "<strong>Some error occured, please re-try, 
                                    <br>if problem perists please contact customer care with this error ID (119) and Transaction ID: " . $txn_id . ".</strong>";
                                }
                            } else {
                                echo "<strong>You don't have enough balance in your wallet. Please repeat the order using other payment mode.</strong>";
                            }
                        } else {
                            $query = "INSERT INTO ecommerce (txn_id, od_id, cust_id, service_name, order_name, service_charge_reason, payment_mode, date_time, service_charge, order_charge, user_service_address)
                                VALUES('$txn_id', '$od_id', '$id', '$serv_name', '$order_name', '$serv_charge_reason', '$pay_mode', '$c_time', '$serv_charge', '$order_charge', '$address_services')";
                            $result = mysqli_query($db1, $query);


                            if ($result) {
                                if ($pay_mode == "CC") {
                                    $payment_mode_for_display = "Credit Card";
                                }
                                if ($pay_mode == "DC") {
                                    $payment_mode_for_display = "Debit Card";
                                }
                                if ($pay_mode == "UPI") {
                                    $payment_mode_for_display = "UPI";
                                }

                                echo '<strong>We have successfully received your payment.</strong><br><br>';
                                echo 'Your Order ID is: <strong>' . $od_id . '</strong><br>';
                                echo 'Your Transaction ID is: <strong>' . $txn_id . '</strong><br>';
                                echo 'Payment Mode: <strong>' . $payment_mode_for_display . '</strong><br><br>';
                                echo 'Service Name: <strong>' . $serv_name . ' ('.$order_name.')</strong><br>';
                                echo 'Total Amount Debited (Order + Service Charge): <strong>Rs. ' . $total_charge . '</strong><br>';
                                echo 'Your Address: <strong>' . $address_services . '</strong><br>';
                                echo '<br><br>';
                                if($serv_name == "Medicines") {
                                    echo '<strong>You will recieve your medicines within next 7-20 days.</strong>';
                                }
                                if($serv_name == "Doctors Appointment") {
                                    echo '<strong>You will recieve a call from an specialized doctor on you registered mobile number within next 30-60 minutes.</strong>';
                                }
                                if($serv_name == "Withdraw Fund") {
                                    echo '<strong>You will receive your cash securely at the above address within the selected timeline.</strong>';
                                }
                                if($serv_name == "Deposit Fund") {
                                    echo '<strong>We will pickup your cash securely from the above address within the selected timeline. Cash picked up will be deposited on same day (excluding exceptions).</strong>';
                                }
                            } else {
                                echo "<strong>Some error occured, please re-try, 
                                    <br>if problem perists please contact customer care with this error ID (120) and Transaction ID: " . $txn_id . ".</strong>";
                            }
                        }
                        mysqli_close($db);
                        mysqli_close($db1);
                    }
                    ?>

                </div>

                <br><br>

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
</body>
<?php
include("footer.php");
?>

</html>