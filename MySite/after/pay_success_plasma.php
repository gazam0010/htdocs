<?php include ('afterlogin.php') ?>
<?php 
  if (isset($_GET['logout'])) {
        unset($_SESSION['b80bb7740288fda1f201890375a60c8f_id']);
        unset($_SESSION['a3da707b651c79ecc39a4986516180b2_fname']);
        unset($_SESSION['0c83f57c786a0b4a39efab23731c7ebc_email']);
        unset($_SESSION['532c28d5412dd75bf975fb951c740a30_mobile']);
  	header("location: /MySite/start.php");
  }
?>
<?php if (!isset($_SESSION['txn'])) {
  	header('location: donate_after.php');
  }
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
.bordr{
  border: 2px solid gray;
  padding: 10px;
}

h1 {
  text-align: center;
  text-transform: uppercase;
  color: #06554B;
}
h2 {
  text-align: center;
  font-size: 25px; 
  color: black;
}
h3 {
  padding: 10px;
  text-align: center;
  font-size: 20px; 
  color: black;
}


p {
  text-indent: 100px;
  text-align: justify;
  letter-spacing: 3px;
  font-size: 20px;
}

a {
  text-decoration: none;
  color: #008CBA;
}
</style>
<style>
.popups {
    display: inline-block;
}
.popups .popupstext {
    visibility: hidden;
    width: 16px;
    background-color: #b1b1b1;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 7px;
    position:relative;
    top:-36px;
    right:-62px;
}
.popups .sshow {
    visibility: visible;
    -webkit-animation: fadeIn 1s;
    animation: fadeIn 1s;
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
</style>
<!--End of Footer code-->
<style>
/* Center the loader */
#loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 150px;
  height: 150px;
  margin: -75px 0 0 -75px;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom { 
  from{ bottom:-100px; opacity:0 } 
  to{ bottom:0; opacity:1 }
}

#myDiv {
  display: none;
  text-align: center;
}
</style>
<!--End of footer Code--> 
</head>
<body onload="myFunction()" style="margin:0;">
<div id="process">
<br><br><br><br>
<h4 align="center">Please wait your request is in process.</h4>
<h5 align="center">Thanks for using our Plasma donation service.</h5>
</div>
<div id="loader"></div>

<div style="display:none;" id="myDiv" class="animate-bottom">

<div class="bordr">
     
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="donate_after.php"><img align="left" src = "/MySite/img/back-button.png" width = "42.5" height="37.5" /></a>
    <h2> Hello, <strong><?php echo $_SESSION['a3da707b651c79ecc39a4986516180b2_fname']; ?></strong></h2><br><br>
    <br><br>   
    
    
   <h3>Your request has been successfully registered</h3><br>
   <h4>Our team will contact you at your address within 7 days from below date.</h4><br>
    Type: <strong><?php if($_SESSION['don_type'] == "donate"){$don_type="Donate";} 
    else {$don_type="Registering for receiving the donation";} echo $don_type;?></strong> <br>
    Address: <strong><?php echo $_SESSION['address']?> </strong><br>
    Reference ID: <strong><?php echo $_SESSION['ref_id']?> </strong><br>
    Request date and time: <strong><?php echo (date("d-m-Y h:i:s a",  $_SESSION['c_time']+15480)) ?> IST</strong> <br>
    Service Charge: <strong><?php echo $_SESSION['fees']; ?> INR</h3></strong> <br>
    Payment Mode: <strong><?php echo $_SESSION['pay_mode']; ?></h3></strong> <br>
    Transaction ID: <strong><?php echo $_SESSION['txn']; ?></strong><br><br>
    
    
    <br><a href="donations.php"><h4 align="center"><u>Other Donations History</u></h4></a><br>
    <br><br>
    </div>
   
</body>
<script>
var myVar;

function myFunction() {
  myVar = setTimeout(showPage, 4000);
}

function showPage() {
  document.getElementById("process").style.display = "none";
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}
</script>
<?php
include ("footer.html");
?>
</html>