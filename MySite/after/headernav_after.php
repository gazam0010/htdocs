<html>
<!----------------Write header---------------->
<div class="header">
  <h2>COVID 19</h2>
  <h3> <font size="6">Information System</font></h3>
</div>
<!-----------------Write header end------------->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    
<ul class="nav navbar-nav">
    <li class="active"><a href="#"><font size = "4.5">Home</font></a></li>
    <li ><a href="donate_after.php"><font size = "4.5">Donate</font></a></li>
    <li ><a href="services_after.php"><font size = "4.5">Services</font></a></li>
    <li ><a href="contact_after"><font size = "4.5">Contact Us</font></a></li>
    <li ><a href="about_after.php"><font size = "4.5">About</font></a></li>
    <li ><a href="sitemap_after.php"><font size = "4.5">Site Map</font></a></li>
    
      
</ul>
<ul class="nav navbar-nav navbar-right">
 <div class="navbar-header">
     <li class="navbar-brand">Welcome <font size = "4.5"><strong><?php echo htmlspecialchars($_SESSION["a3da707b651c79ecc39a4986516180b2_fname"]); ?></strong></font></a>
    </div>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><font size = "4.5">Menu </font><span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="profile.php">Profile</a></li>
          <li><a href="donations.php">Donation History</a></li>
          <li><a href="#">Orders</a></li>
          <li><a href="#">Cancelled Orders</a></li>
          <li><a href="change-password.php">Change Password</a></li>
          <li><a href="?logout='1'">Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
     </html>

