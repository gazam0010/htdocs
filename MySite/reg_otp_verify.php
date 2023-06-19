<?php include('server.php') ?>
<?php
if(!isset($_SESSION['sent_otp_reg']))
    {
         header('location: register.php');
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
            <li class="progtrckr-todo"></li>
            <li class="progtrckr-todo"></li>
        </ol>
  </div>
	
  <form class="login-form" method="post" action="reg_otp_verify.php?return=<?php echo $_SESSION['page']; ?>">
                <div class="alert alert-success">
                    <p align='center'><font size='3px'>
                <h3><?php if (isset($_SESSION['sent_otp_reg']) && $_SESSION['otp']) : ?>
                    <?php 
         	           echo '<strong>'.$_SESSION['sent_otp_reg'].' '.$_SESSION['otp'].'</strong>.'.' It will expire in 15 minutes. <br><font size="2"><a href = "register.php">Wrong mobile number? </a></font>';
          	    ?>
                    <?php endif ?>  </h3>
                    </font></p>
                </div>
  	<?php include('errors.php'); ?>
      <br>
        <div class="form-group">
  	  <label>Enter OTP</label>
          <input type="text" name="token" class="form-control" placeholder="Enter OTP">
  	</div>
  	<div class="form-group">
  	  <button type="submit" class="btn btn-primary" name="reg_mobile_otp">Proceed</button>
  	</div>
      <br>
  	<p>
  		Already a member? <a href="start.php">Sign in</a>
  	</p>
  </form>
</body>
</html>