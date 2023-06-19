<?php include('server.php') ?>
<?php $_SESSION['page']='sitemap'; ?>
<?php if(isset($_SESSION["14c4b06b824ec593239362517f538b29_username"])
          || isset($_SESSION['b80bb7740288fda1f201890375a60c8f_id'])
          || isset($_SESSION['a3da707b651c79ecc39a4986516180b2_fname']) 
          || isset($_SESSION['0c83f57c786a0b4a39efab23731c7ebc_email']) 
          || isset($_SESSION['532c28d5412dd75bf975fb951c740a30_mobile']))
          {
            header("location: after/sitemap_after.php");
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
<link rel="stylesheet" href="modal.css">
<?php
include ("basestyle.html");
?>
</head>
<body>
<!----------------Write header---------------->
<div class="header-header">
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
      <li ><a href="about.php"><font size = "4.5">About</font></a></li>
      <li class="active"><a href="#"><font size = "4.5">Site Map</font></a></li>
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
<!--------------------------------------------------------------- PAGE BODY ENDS ------------------------------------------------------------>
<?php
include ('basescript.html');
?>


</body>
<?php
include ('footer.php');
?>
</html>

