<?php include('server.php') ?>
<?php $_SESSION['page']='contact_us'; ?>
<?php if(isset($_SESSION["14c4b06b824ec593239362517f538b29_username"])
          || isset($_SESSION['b80bb7740288fda1f201890375a60c8f_id'])
          || isset($_SESSION['a3da707b651c79ecc39a4986516180b2_fname']) 
          || isset($_SESSION['0c83f57c786a0b4a39efab23731c7ebc_email']) 
          || isset($_SESSION['532c28d5412dd75bf975fb951c740a30_mobile']))
          {
            header("location: after/contact_after.php");
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
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
  .main-cont-serv {
    margin-left: 20%;
    margin-right: 20%;
    padding: 2%;
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
<?php
include ("basestyle.html");
?>
</head>
<body>
      <!----------------Write header---------------->
<div class="header">
  <h2>COVID 19</h2>
  <h3> <font size="6">Information System</font></h3>
</div> 
<!-----------------Write header end------------->
   
<!------------Nav bar code------------->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    
    <ul class="nav navbar-nav">
        <li ><a href="start.php"><font size = "4.5">Home</font></a></li>
      <li ><a href="donate.php"><font size = "4.5">Donate</font></a></li>
      <li ><a href="services.php"><font size = "4.5">Services</font></a></li>
      <li ><a href="covid_info.php"><font size = "4.5">About Corona Virus</font></a></li>
      <li class="active"><a href="#"><font size = "4.5">Contact Us</font></a></li>
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

<br><br>
<div class="main-cont-serv w3-card">

<h1 align="left">
    Contact Us
</h1>
<hr style="height:2px;
border-width:0;
color:gray;
background-color:gray">
Please login or register to write a complaint or you may contact us at customercare@example.com.<br><br>
<p align="left"><button onclick="launchLogin()" align="center" class="w3-button w3-orange w3-round">Login/Register Now</button></p>
</div>





<!--------------------------------------------------------------- PAGE BODY ENDS ------------------------------------------------------------>

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

<?php
include ('basescript.html');
?>


</body>
<?php
include ('footer.php');
?>
</html>

