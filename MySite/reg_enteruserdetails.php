<?php include('server.php') ?>
 <?php
if(!isset($_SESSION['after_mobile_verification']))
    {
         header('location: register.php');
    }
    else
    {
        unset($_SESSION['sent_otp_reg']);
    }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="progress_bar.css">
</head>
<body>
  <div class="header">
  	<h2 align="center">Register</h2>
        <ol class="progtrckr" data-progtrckr-steps="5">
    <li class="progtrckr-done"></li>
    <li class="progtrckr-done"></li>
    <li class="progtrckr-todo"></li>
  </div>
	
   <form class="login-form" method="post" action="register.php?return=<?php echo $_SESSION['page']; ?>">
       <div class="alert alert-success">
                    <p align='center'><font size='3'>
                <h3><?php if (isset($_SESSION['after_mobile_verification'])) : ?>
                    <?php 
         	           echo '<strong>'.$_SESSION['after_mobile_verification'].'</strong>.'.' Please fill further details.';
          	    ?>
                    <?php endif ?>  </h3>
                    </font></p>
                </div>
  	<?php include('errors.php'); ?>
         <div class="form-group">
  	  <label>Full Name</label>
  	  <input type="text" name="fname" class="form-control" value="<?php echo $username; ?>">
  	</div>
  	<div class="form-group">
  	  <label>Email</label>
  	  <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
  	</div>
  	<div class="form-group">
  	  <label>Password</label>
          <input type="password" id="myInput" class="form-control" name="password_1"><br>
          <input type="checkbox" onclick="myFunction()"> Show Password
  	</div>
  	<div class="form-group">
  	  <button type="submit" class="btn btn-primary" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="start.php">Sign in</a>
  	</p>
  </form>
</body>
<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
</html>