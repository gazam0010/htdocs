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
        

        .main-cont-serv {
            margin-left: 20%;
            margin-right: 20%;
            padding: 2%;
        }
        .vl {
            border-left: 2px solid grey;
            height: 15px;
        }
    </style>
</head>

<body>
    <div class="w3-container w3-indigo">
    <h1 align='center'>COVID 19 <br><font size="5">Information System</font></h1>
    </div>
    <div class="w3-contianer">
        <div class="w3-bar w3-border w3-light-grey w3-card-4">
            <a style="text-decoration: none;" href="#" class="w3-bar-item w3-button w3-red">Home</a>
            <a style="text-decoration: none;" href="donate_after.php" class="w3-bar-item w3-button">Donate</a>
            <a style="text-decoration: none;" href="services_after.php" class="w3-bar-item w3-button">Services</a>
            <a style="text-decoration: none;" href="covid_info_after.php" class="w3-bar-item w3-button">About Corona Virus</a>
            <a style="text-decoration: none;" href="contact_after.php" class="w3-bar-item w3-button">Contact Us</a>

            
            <a style="text-decoration: none;" class="w3-bar-item w3-button w3-right">
            <span class="vl"></span>
            &nbsp; Welcome, <font size = "4.5"><strong><?php echo htmlspecialchars($_SESSION["a3da707b651c79ecc39a4986516180b2_fname"]); ?></strong></font></a>
            
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
    <div class="w3-container">
<h2 align="center">Welcome to the panel COVID 19 Information System</h2>
<br><br>
<div class="main-cont-serv w3-card">
<h3 align="center"><font color="black"><strong>FEATURES</strong></font></h3>
<br>
<span style="font-size: 20px; line-height:1.6;">
<ul>
<li>Fund Donation</li>
<li>Plasma Donation</li>
<li>Doctor Appointment</li>
<li>Fund Withdrawal from Bank account</li>
<li>Fund Deposit in Bank</li>
<li>Information About the Corona Virus.</li>
</ul>
</span>
</div>
</div>
<br><br>
    
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