<?php include('afterlogin.php') ?>
<?php include('header_after.php') ?>
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
<?php
if (isset($_GET['logout'])) {
  unset($_SESSION['b80bb7740288fda1f201890375a60c8f_id']);
  unset($_SESSION['a3da707b651c79ecc39a4986516180b2_fname']);
  unset($_SESSION['0c83f57c786a0b4a39efab23731c7ebc_email']);
  unset($_SESSION['532c28d5412dd75bf975fb951c740a30_mobile']);
  header("location: /MySite/donate.php");
}
$_SESSION['previous_page'] = 'donate_after.php'
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
  <link rel="stylesheet" href="style_after.css?v=1">
  <!-------------Header--------------->
  <style>
    body-header {
      margin: 0;
      font-size: 28px;
      font-family: Arial, Helvetica, sans-serif;
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
  <style>
    h1 {
      text-align: center;
    }

    h7 {
      text-align: center;
      font-size: 15px;
    }

    h3 {
      font-size: 15px;
      text-align: left;
    }

    h4 {
      font-size: 12px;
      text-align: right;
    }

    p1 {
      text-align: center;
    }

    p7 {
      text-align: center;
    }

    .vl {
      border-left: 2px solid grey;
      height: 15px;
    }
  </style>

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

    .footer-abo {
      left: 0;
      bottom: 0;
      width: 100%;
      background-color: #2b2b2b;
      color: whitesmoke;
      text-align: left;
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
  </style>
  <style>
    .right {
      float: right;
    }

    .left {
      float: left;
    }

    .center {
      float: center;
    }

    h2,
    h6 {
      text-align: center;
      margin-right: 130px;

    }

    img {
      margin-left: 20px;
    }

    .fund-don-cont {
      padding-left: 5%;
      padding-right: 5%;
      padding-bottom: 5%;
      border: 1p solid black;
    }

    .body-cont {
      margin-left: 10%;
      margin-right: 10%;
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
  </style>
</head>

<body onload="myFunction();">
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
      <a style="text-decoration: none;" href="#" class="w3-bar-item w3-button w3-red">Donate</a>
      <a style="text-decoration: none;" href="services_after.php" class="w3-bar-item w3-button">Services</a>
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

  <br>
  <h><?php include('errors.php'); ?></h>

  <div class="body-cont w3-card">
    <h1>Fund Donation</h1>
    <hr style="height:2px;
      border-width:0;
      color:gray;
      background-color:gray">
    <h2>
      In this critical time several families around the globe are getting financially weak. In order to provide them support we started collecting funds.<br>
      In colaboration with NGOs, we are collecting funds to help effected families.<br>
      Those NGOs will use this fund to provide them support by providing them meals, clothes, medicines and several other daily usage items.<br>
      This may not help every single person but we are trying to cover as many as we can.<br>
      We encourage you to take a step in this generous work.<br>
      Every fund donation made by you, we will add 5% from our end.<br><br>
    </h2>
    <p align="left">
      <button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-green">Donate Fund</button>
    </p>
    <br>
    <h1>Plasma Donation</h1>
    <hr style="height:2px;
      border-width:0;
      color:gray;
      background-color:gray">
    <h2>
      We are also providing services for registration for plasma donation.<br>
      You can register yourself for donating plasma, after complete registration for plasma donation, an agent will approach to your address to collect the donation.<br>
      You can also register yourself for getting the plasma donation at your doorstep. Our team will approach to your address to provide this service.<br><br>
    </h2>
    <p align="left">
      <button onclick="document.getElementById('id02').style.display='block'" class="w3-button w3-green">Donate Plasma</button>
    </p>

    <!-----Fund Donation Modal----->
    <div id="id01" class="w3-modal">
      <div class="w3-modal-content w3-card-4 w3-animate-zoom w3-padding-32">
        <div class="w3-container">
          <span class="w3-topleft w3-tag"><strong>FUND DONATION</strong></span>
          <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
          <hr style="background-color: grey; height:2px;">
          <!----Modal Content----->
          <div class="fund-don-cont">

            <form method="post" action="">
              <a href="donations.php">
                <h4 align="right">Money Donations History</h4>
              </a>


              <h3><u>Donor's Details:</u></h3>
              <h3>Name: <strong><?php echo $_SESSION['a3da707b651c79ecc39a4986516180b2_fname']; ?></strong></h3>
              <h3>Email ID: <strong><?php echo $_SESSION['0c83f57c786a0b4a39efab23731c7ebc_email']; ?></strong></h3>
              <hr color="black">
              <label>Amount (INR):</label>
              <input type="text" class="w3-input w3-border-green" name="amount" id="amount" value="" placeholder="Enter amount" required><br>
              <font color="red">
                <p align="center" id="msg"></p>
              </font>
              <label>Payment Mode:</label> <br>

              <div style="padding-left: 3%;">

                <table>
                  <tr>
                    <td>
                      <font size="3">Wallet <font size="2">(₹<?php echo $balance; ?>) : </font>
                      </font>
                    </td>
                    <td>
                      &nbsp;<input id="mode" type="radio" name="mode" value="WA" required><br>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <font size="3">Credit Card: </font>
                    </td>
                    <td>
                      <input id="mode" type="radio" name="mode" value="CC" required><br>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <font size="3">Debit Card: </font>
                    </td>
                    <td>
                      <input id="mode" type="radio" name="mode" value="DC" required><br>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <font size="3">UPI: </font>
                    </td>
                    <td>
                      <input id="mode" type="radio" name="mode" value="UPI" required><br>
                    </td>
                  </tr>
                </table>
              </div>
              <input type="submit" value="Donate" onclick="return donate_wallet()" name="don" class="w3-button w3-right w3-round w3-green">

            </form>

          </div>
        </div>
      </div>
    </div>
    <!-----Fund Donation Modal Ends----->

    <!-----Plasma Donation Modal Starts----->
    <div id="id02" class="w3-modal">
      <div class="w3-modal-content w3-card-4 w3-animate-zoom w3-padding-32">
        <div class="w3-container">
          <span class="w3-topleft w3-tag"><strong>PLASMA DONATION</strong></span>
          <span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-display-topright">&times;</span>
          <hr style="background-color: grey; height:2px;">
          <!----Modal Content----->
          <div class="fund-don-cont">

            <form method="post" action="">
              <a href="plasma.php">
                <h4 align="right">History</h4>
              </a>


              <h3><u>Your Details:</u></h3>
              <h3>Name: <strong><?php echo $_SESSION['a3da707b651c79ecc39a4986516180b2_fname']; ?></strong></h3>
              <h3>Email ID: <strong><?php echo $_SESSION['0c83f57c786a0b4a39efab23731c7ebc_email']; ?></strong></h3>
              <hr color="black">
              <label>You are: </label>
              <br>
              <div style="padding-left: 3%;">
                <input type="radio" name="don_type" value="donate" id="pl_don_1" required> <label for="pl_don_1">Donating</label><br>
                <input type="radio" name="don_type" value="receive" id="pl_don_2" required> <label for="pl_don_2">Registering for receiving the donation</label>
              </div>

              <br>

              <label>Address:</label> <br>
              <input type="text" class="w3-input w3-border-green" name="address" value="" placeholder="Full address with city and pin code" required><br>

              <p align="center">
                <font color="gray">You have to pay a door step service charge amounting to Rs. 100.</font>
              </p>
              <font color="red">
                <p align="center" id="msg_pl"></p>
              </font>
              <label>Payment Mode:</label> <br>

              <div style="padding-left: 3%;">

                <table>
                  <tr>
                    <td>
                      <font size="3">Wallet <font size="2">(₹<?php echo $balance; ?>) : </font>
                      </font>
                    </td>
                    <td>
                      &nbsp;<input id="mode_pl" type="radio" name="mode_pl" value="WA" required><br>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <font size="3">Credit Card: </font>
                    </td>
                    <td>
                      <input id="mode_pl" type="radio" name="mode_pl" value="CC" required><br>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <font size="3">Debit Card: </font>
                    </td>
                    <td>
                      <input id="mode_pl" type="radio" name="mode_pl" value="DC" required><br>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <font size="3">UPI: </font>
                    </td>
                    <td>
                      <input id="mode_pl" type="radio" name="mode_pl" value="UPI" required><br>
                    </td>
                  </tr>
                </table>
              </div>
              <input type="submit" value="Donate" onclick="return donate_plasma_wallet()" name="don_plasma" class="w3-button w3-right w3-round w3-green">

            </form>

          </div>
        </div>
      </div>
    </div>


    <!-----Plasma Donation Modal Ends----->
  </div>
</body>
<script>
  function donate_wallet() {
    if (document.getElementById('mode').checked) {
      if (document.getElementById('mode').value == "WA") {
        var amount = document.getElementById('amount').value;
        var bal = <?php echo $inner_use_balance; ?>;
        if (bal < amount) {
          document.getElementById('msg').innerHTML = "Low Wallet Balance";
          document.getElementById('amount').style.border = "thin solid red";
          return false;
        }
        document.getElementById('msg').innerHTML = "";
        document.getElementById('amount').style.border = "thin solid black";
        return true;

      }
    }
  }
</script>
<script>
  function donate_plasma_wallet() {
    if (document.getElementById('mode_pl').checked) {
      if (document.getElementById('mode_pl').value == "WA") {
        var bal = <?php echo $inner_use_balance; ?>;
        if (bal < 100) {
          document.getElementById('msg_pl').innerHTML = "Low Wallet Balance";
          return false;
        }
        document.getElementById('msg_pl').innerHTML = "";
        return true;

      }
    }
  }
</script>
<script>
  function myFunction() {
    var x = document.getElementById("myDIV");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }

  function myFunctionC() {
    var x = document.getElementById("myDIVA");
    if (x.style.display === "none") {
      x.style.display = "block";
    }
  }
</script>
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