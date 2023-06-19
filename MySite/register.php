<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <link rel="stylesheet" type="text/css" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="progress_bar.css">
</head>
<body>
  <div class="header">
  	<h2 align="center">Register</h2>
      <ol class="progtrckr" data-progtrckr-steps="5">
    <li class="progtrckr-todo"></li>
    <li class="progtrckr-todo"></li>
    <li class="progtrckr-todo"></li>
</ol>
</div>
  </div>
	
  <form method="post" action="register.php?return=<?php echo $_SESSION['page']; ?>">
  	<?php include('errors.php'); ?>
  	
        <div class="input-group">
  	  <label>Mobile Number</label>
          <input type="text" name="mobile" class="input-control" maxlength="10" value="<?php echo $mobile; ?>" placeholder="Enter 10 digit Mobile Number">
  	</div>
  	<div class="inputs-group">
  	  <button type="submit" class="btn btn-primary" name="reg_mobile_verify">Verify</button>
  	</div>
  	<p>
  		Already a member? <a href="start.php">Sign in</a>
  	</p>
  </form>
</body>
</html>