<?php include('server.php') ?>
<?php $_SESSION['page']='services'; ?>
<?php if(isset($_SESSION["14c4b06b824ec593239362517f538b29_username"])
          || isset($_SESSION['b80bb7740288fda1f201890375a60c8f_id'])
          || isset($_SESSION['a3da707b651c79ecc39a4986516180b2_fname']) 
          || isset($_SESSION['0c83f57c786a0b4a39efab23731c7ebc_email']) 
          || isset($_SESSION['532c28d5412dd75bf975fb951c740a30_mobile']))
          {
            header("location: after/services_after.php");
            exit();
          }
?>
<?php if(isset($_SESSION['signup-success']))
{
    $signup_succ = $_SESSION['signup-success'];
}
?>
<?php
  unset($_SESSION['after_mobile_verification']);
  unset ($_SESSION['expT']);
   unset ($_SESSION['mobile']);
   unset ($_SESSION['otp']);
?>
<?php if (isset($_GET['falseLogin'])) : ?> 
 <html>
    <script>
        window.onload=function(){
        document.getElementById("myBtn").click();
        };
    </script>
  </html>
<?php endif; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>C-19 Info. System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="modal.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
  .main-cont-serv {
    margin-left: 20%;
    margin-right: 20%;
    padding: 2%;
   }
</style>

<?php
include ("basestyle.html");
?>
</head>
<body>
<!----------------Write header---------------->
<div class="header">
  <h2>COVID 19</h2>
  <h3> <font size="6">Information System</font></h3>
<!-----------------Write header end------------->
</div>    
<!------------Nav bar code------------->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    
    <ul class="nav navbar-nav">
        <li ><a href="start.php"><font size = "4.5">Home</font></a></li>
      <li ><a href="donate.php"><font size = "4.5">Donate</font></a></li>
      <li class="active"><a href="#"><font size = "4.5">Services</font></a></li>
      <li ><a href="covid_info.php"><font size = "4.5">About Corona Virus</font></a></li>
      <li ><a href="contact_us.php"><font size = "4.5">Contact Us</font></a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li id="mysBtn"><a href="#"><font size = "4.5"><span class="glyphicon glyphicon-user"></span> Sign Up</a></font></li>
      <li id="myBtn"><a href="#"><font size = "4.5"><span class="glyphicon glyphicon-log-in"></span> Login</a></font></li>
    </ul>
  </div>
</nav>
<!--------------Nav bar code ends---------->
<?php
include ("login-signup.php");
?>
<!--------------------------------------------------------------- PAGE BODY STARTS ------------------------------------------------------------>

<div class="w3-container">

<?php if (isset($_SESSION['signup-success'])) : ?>
<div class="container">
<div class="alert alert-success alert-dismissible">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 
<?php 
    echo $_SESSION['signup-success']; 
    unset($_SESSION['signup-success']);
?>
    
</div>
</div>
    <?php endif ?>

<div class="main-cont-serv w3-card">
<h2 align="center"><font color="black"><strong>SERVICES PROVIDED</strong></font></h2>
<span style="font-size: 20px; line-height:1.6;">
<br>
<h4 align="left"><strong>Order Medicines and Health Equipments</strong></h4>
<hr>
You can order medicines and other health equipments and get it delivered at your home.
<br><br>

<h4 align="left"><strong>Doctor Appointment</strong></h4>
<hr>
You can take doctor's appointment and one of our specialized doctor will contact you.
<br><br>

<h4 align="left"><strong>Fund Withdrawal</strong></h4>
<hr>
Short on cash? Book a fund withdrawal using your Debit/Credit card or netbanking, and we will securely deliver it to you on a minimal charge.
<br><br>

<h4 align="left"><strong>Fund Deposit</strong></h4>
<hr>
Reducing queues in the bank, we have also an option for depositing cash, just book a Fund Deposit and we will securely pickup the cash and deposit it in your bank account on a minimal charge.
<br><br>
<p align="right"><button onclick="launchLogin()" align="center" class="w3-button w3-orange w3-round">Login/Register Now</button></p>
</div>
</div>

<!--------------------------------------------------------------- PAGE BODY ENDS ------------------------------------------------------------>

<?php
include ('basescript.html');
?>

</body>
<?php
include ('footer.php');
?>
</html>

