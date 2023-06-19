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
$_SESSION['previous_page'] = 'medicines_health.php'
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

        .catalogue {
            padding: 2%;
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

    <div class="w3-container w3-padding-64">
        <div class="main-cont-serv w3-card">
            <p align="left">
                <font size="2px" color="grey"><a href="services_after.php">Services</a> / Deposit Fund</font>
            </p>
            <span style="font-size: 20px; line-height:1.6;">
                <br>
                <h4 align="left"><strong>Deposit Fund in Your Bank Account</strong></h4>
                <hr style="height:2px; border-width:0; color:gray;  background-color:gray">

                
                <form method="post" action="service_payment.php">
                <h5>* Funds can only be deposited to the account name below.</h5><br>

                    <input type="hidden" name="service_name" value="Deposit Fund">
                    
                    <input type="hidden" name="service_charge_reason" value="Platform Handling & Pickup">
                    <input type="hidden" name="service_charge" value="100">

                    <input type="hidden" name="service_page_name" value="Deposit Fund">
                    <input type="hidden" name="service_page_link" value="http://localhost/MySite/after/deposit_fund.php">
                    <h5><strong>Account Name: </strong><?php echo $_SESSION['a3da707b651c79ecc39a4986516180b2_fname']; ?></h5><br>
                    
                    <h5><strong>Account Number followed by IFSC and Amount: </strong></h5>
                    <input type="text" name="order_name" id="order_charge" 
                    class="w3-input" placeholder="123456789, IFSC0000XXX, 10000" required><br>
                    
                    <input type="hidden" name="order_charge" value="0">
                    
                    <font color="grey" size="3px" align="left"><p>Platform Handling & Pickup Charge: Rs. 100</p></font><br>
                    <input type="submit" value="Proceed to payment" name="serv_order" class="w3-button w3-green w3-round"><br><br>



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
<?php
include("footer.php");
?>

</html>