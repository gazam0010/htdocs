<?php include('server.php'); ?>
<?php if (!isset($_SESSION['sent_otp'])) : ?>
<?php 
        header('location: forgot.php');
?>
<?php endif ?>  </h3>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<title>Password Reset</title>
	<link rel="stylesheet" href="main.css">
</head>
<body>
	<form class="login-form" action="" method="post">
		<h2 class="form-title">Change Password</h2>
                <div class="alert alert-success">
                    <p align='center'><font size='3'>
                <h3><?php if (isset($_SESSION['sent_otp'])) : ?>
                    <?php 
         	           echo '<strong>'.$_SESSION['sent_otp'].'</strong>.'.' It will expire in 15 minutes.';
          	    ?>
                    <?php endif ?>  </h3>
                    </font></p>
                </div>
		<!-- form validation messages -->
		<?php include('messages.php'); ?>
                <div class="form-group">
			<label>Enter OTP</label>
			<input type="text" name="token">
		</div>
		<div class="form-group">
			<label>New password</label>
			<input type="password" name="new_pass">
		</div>
		<div class="form-group">
			<label>Confirm new password</label>
			<input type="password" name="new_pass_c">
		</div>
		<div class="form-group">
			<button type="submit" name="new_password" class="login-btn">Submit</button>
		</div>
                <p>Getting excess error? <a href = 'forgot.php'>Restart the process</a></p>
	</form>
    
    
</body>
</html>