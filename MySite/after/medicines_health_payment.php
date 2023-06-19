<?php include('afterlogin.php'); ?>
<?php include('header_after.php') ?>
<?php
if (isset($_GET['logout'])) {
    unset($_SESSION['b80bb7740288fda1f201890375a60c8f_id']);
    unset($_SESSION['a3da707b651c79ecc39a4986516180b2_fname']);
    unset($_SESSION['0c83f57c786a0b4a39efab23731c7ebc_email']);
    unset($_SESSION['532c28d5412dd75bf975fb951c740a30_mobile']);
    header("location: /MySite/services.php");
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
            <a style="text-decoration: none;" href="contact_after.php" class="w3-bar-item w3-button">Contact Us</a>


            <a style="text-decoration: none;" class="w3-bar-item w3-button w3-right">
                <span class="vl"></span>
                &nbsp; Welcome, <font size="4.5"><strong><?php echo htmlspecialchars($_SESSION["a3da707b651c79ecc39a4986516180b2_fname"]); ?></strong></font></a>

            <div class="w3-dropdown-hover w3-right">
                <button class="w3-button">Menu</button>
                <div class="w3-dropdown-content w3-bar-block w3-card-4">
                    <a style="text-decoration: none;" href="profile.php" class="w3-bar-item w3-button">Profile</a>
                    <a style="text-decoration: none;" href="wallet.php" class="w3-bar-item w3-button">Wallet</a>
                    <a style="text-decoration: none;" href="#" class="w3-bar-item w3-button">Orders</a>
                    <a style="text-decoration: none;" href="change-password.php" class="w3-bar-item w3-button">Change Password</a>
                    <a style="text-decoration: none;" href="?logout='1'" class="w3-bar-item w3-button">Logout</a>
                </div>
            </div>
        </div>
    </div>



    <!----------Body Starts Here--------->

    <div class="w3-container w3-padding-64">
        <div class="main-cont-serv w3-card">
            <p align="left">
                <font size="2px" color="grey"><a href="services_after.php">Services</a> / <a href="medicines_health.php">Medicines & Health</a> / Payment</font>
            </p>
            <span style="font-size: 20px; line-height:1.6;">
                <br>
                <h3 align="left"><strong>Address & Payment</strong></h3>
                <hr style="height:2px; border-width:0; color:gray;  background-color:gray">
 
                <div class="pp">
                    <?php
                    if (isset($_POST['serv_order'])) {
                     $serv_name = $_POST['service_name'];
                     $order_name = $_POST['order_name'];
                     $serv_charge_reason = $_POST['service_charge_reason'];
                     $serv_charge = $_POST['service_charge'];
                     $order_charge = $_POST['order_charge'];
                    }
                    ?>
                    <h4><strong>Service Name: </strong><?php echo $serv_name.' ('.$order_name.')'; ?></h4>
                    <h4><strong>Order Cost: </strong><?php echo 'Rs. '.$order_charge; ?></h4><br>
                    <h4><strong>Address: </strong></h4>
                    <input type="text" class="w3-input w3-border-green" placeholder="Enter full address with city and pin code" name="address_services" required><br>
                    <h4><strong>Service Charge: </strong><?php echo 'Rs. '.$serv_charge.' ('.$serv_charge_reason.')'; ?></h4>
                    <?php $total_cost = $serv_charge + $order_charge; ?>
                    <h4><strong>Total Amount: </strong><?php echo 'Rs. '.$total_cost;?></h4><br>

                    <h4><strong>Payment Mode: </strong></h4>
                    <h5>&nbsp;&nbsp;&nbsp;<input type="radio" name="payment_mode" value="WA"> Wallet (₹<?php echo $balance; ?>)</h5>
                    <h5>&nbsp;&nbsp;&nbsp;<input type="radio" name="payment_mode" value="CC"> Credit Card</h5>
                    <h5>&nbsp;&nbsp;&nbsp;<input type="radio" name="payment_mode" value="DC"> Debit Card</h5>
                    <h5>&nbsp;&nbsp;&nbsp;<input type="radio" name="payment_mode" value="UPI"> UPI</h5>
                    <br><br>
                    
                    <input type="hidden" value="<?php echo $total_cost; ?>" name="amount_to_be_debited">
                    <input type="submit" value="Make payment" name="palce_service_order" class="w3-green w3-button w3-round w3-left w3-small">
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