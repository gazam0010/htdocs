<?php include('afterlogin.php'); ?>
<?php $pp = $_SESSION['previous_page']; ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Change Password</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="/MySite/style.css">
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
  text-align: center;
  font-size: 2px; 
  color: red;
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
</head>
<body>

<div class="bordr">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="<?php echo $pp; ?>"><img src = "/MySite/img/back-button.png" width = "42.5" height="37.5" /></a>
    <h2> Hello, <strong><?php echo $_SESSION['a3da707b651c79ecc39a4986516180b2_fname']; ?></strong></h2><br><br>
    <?php include ('errafterlogin.php');?>
    
    
        <?php if (isset($_SESSION['change'])) : ?>
<div class="container">
<div class="alert alert-success alert-dismissible">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 
    <?php 
          	echo $_SESSION['change'];
                unset($_SESSION['change']);
          ?>
    
</div>
</div>
    <?php endif ?>
    <div class="header">
        <font size="5">Change Password</font>
    </div>
    <form method="post" action="">
        <div class="input-group">
          <label>Old Password</label>
          <input type="password" name="a_old_pass" placeholder="Enter Old Password"><br>
        </div>
        
        <div class="input-group">
          <label>New Password</label>
          <input type="password" name="a_new_pass" placeholder="Enter New Password"><br>
        </div>
        
        <div class="input-group">
          <label>Re-enter New Password</label>
          <input type="password" name="a_re_new_pass" placeholder="Re-enter Password"><br><br>
        </div>
        <input name="ch_ps" type="submit" value="Change Password" class="btn"><br><br>
        <a href = "/MySite/forgot.php">Forgot Old Password?</a>
    </form>
    <br><br> 
    <br><br><br>
</div>
</body>
<!--Footer Starts-->
<div class="footer-foo">
    Thanks for visiting my website.<br>
    Hope you are doing well.<br>
    Designed with <img src="heart.png" height="15" width="15.5"/> by Gulfarogh Azam
<!--Footer Ends-->
</html>
