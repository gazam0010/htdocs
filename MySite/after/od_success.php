<?php include ('afterlogin.php') ?>
<?php if (!isset($_SESSION['od_id'])) {
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
<h4 align="center">Your order is under process please wait.</h4>
</div>
<div id="loader"></div>

<div style="display:none;" id="myDiv" class="animate-bottom">

<div class="bordr">
     
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="donate_after.php"><img align="left" src = "/MySite/img/back-button.png" width = "42.5" height="37.5" /></a>
    <h2> Hello, <strong><?php echo $_SESSION['a3da707b651c79ecc39a4986516180b2_fname']; ?></strong></h2><br><br>
    <br>
    
    <?php $date = date('d-m-yy', $_SESSION['exp']); ?>
    <h3>We thank you for your precious support<br>We have <strong>successfully</strong> received your order<br>
        Please pack the item carefully.<br>Please spread good words about my website.<br><br><u>Here is your order info:</u><br><br>
        Donation Order ID: <strong><?php echo $_SESSION['od_id']; ?></strong><br><br>
        Expected pick up date: <strong><?php echo $date; ?></strong>
    </h3>
    
    <br><a href="donations_else.php"><h4 align="center"><u>Donations History</u></h4></a><br>
    <br><br>
    </div>
   
</body>
<script>
var myVar;

function myFunction() {
  myVar = setTimeout(showPage, 2000);
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