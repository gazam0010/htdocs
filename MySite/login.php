<?php include('server.php') ?>

<?php if(isset($_SESSION["username"])){
    header("location: start_after.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
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
</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username">
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  </form>
</body>
<!--Footer Starts-->
<br><br>
<div class="footer-foo">
    Thanks for visiting my website.<br>
    Hope you are doing well.<br>
    <p align="center"> Designed with <img src="heart.png" height="15" width="15.5"/> by Gulfarogh Azam</p>
<!--Footer Ends-->
</html>