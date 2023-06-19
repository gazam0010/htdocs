<?php include('server.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Password Reset PHP</title>
	<link rel="stylesheet" href="main.css">
        <style>
.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 350px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 10px 0;

  /* Position the tooltip */
  position: absolute;
  z-index: 1;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}
</style>
</head>
<body>
	<form class="login-form" action="" method="post">
		<h2 class="form-title">Reset Password</h2>
		<!-- form validation messages -->
		<?php include('messages.php'); ?>
		<div class="form-group">
                    <label>Enter Your Mobile Number</label> &nbsp; 
                    <div class="tooltip"><img src="download.jpg" width="10" height="12"></img>  <span class="tooltiptext">
                            Enter your registered mobile number:
                            </span>
                        </div>
                    <p></p>
                    <input type="text" name="mobile" maxlength="10" placeholder="10 digit mobile number">
                         
                          
                    </div>     
                </p>
		</div>
		<div class="form-group">
			<button type="submit" name="reset-password" class="login-btn">Submit</button>
		</div>
	</form>
</body>
</html>
