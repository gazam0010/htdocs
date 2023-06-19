<?php include ('afterlogin.php'); ?>
<?php 
  if (isset($_GET['logout'])) {
        unset($_SESSION['b80bb7740288fda1f201890375a60c8f_id']);
        unset($_SESSION['a3da707b651c79ecc39a4986516180b2_fname']);
        unset($_SESSION['0c83f57c786a0b4a39efab23731c7ebc_email']);
        unset($_SESSION['532c28d5412dd75bf975fb951c740a30_mobile']);
  	header("location: /MySite/about.php");
  }
?>
<?php
$_SESSION['previous_page'] = 'about_after.php'
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
<!-------------Header--------------->
<style>
body-header {
  margin: 0;
  font-size: 28px;
  font-family: Arial, Helvetica, sans-serif;
}

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

.sticky + .content {
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
h2,h6 {
        text-align: center;
        margin-right: 130px;
        
    }
     img {
        margin-left: 20px;
    }
</style>
</head>
<body>
<!----------------Write header---------------->
<?php
include ('header_after.php');
?>
<!-----------------Write header end------------->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    
<ul class="nav navbar-nav">
    <li ><a href="start_after.php"><font size = "4.5">Home</font></a></li>
    <li ><a href="donate_after.php"><font size = "4.5">Donate</font></a></li>
    <li ><a href="services_after.php"><font size = "4.5">Services</font></a></li>
    <li ><a href="contact_after"><font size = "4.5">Contact Us</font></a></li>
    <li class="active"><a href="#"><font size = "4.5">About</font></a></li>
    <li ><a href="sitemap_after.php"><font size = "4.5">Site Map</font></a></li>
    
      
</ul>
<ul class="nav navbar-nav navbar-right">
 <div class="navbar-header">
     <li class="navbar-brand">Welcome <font size = "4.5"><strong><?php echo htmlspecialchars($_SESSION["a3da707b651c79ecc39a4986516180b2_fname"]); ?></strong></font></a>
    </div>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><font size = "4.5">Menu </font><span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="profile.php">Profile</a></li>
          <li class="dropdown-submenu">
          <a class="test" tabindex="-1" href="#">Donations Made<span class="caret"></span></a>
          <ul class="dropdown-menu">
              <li><a tabindex="-1" href="donations.php">Money Donations</a></li>
              <li><a tabindex="-1" href="donations_else.php">Other Donations</a></li>
          </ul>
          <li><a href="#">Orders</a></li>
          <li><a href="#">Cancelled Orders</a></li>
          <li><a href="change-password.php">Change Password</a></li>
          <li><a href="?logout='1'">Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
<script>
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>
</body>
<?php 
include ("popups_after.php"); 
?>    
<?php
include ("footer.php");
?>
</html>