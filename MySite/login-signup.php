
<!-- The Sign up Modal -->
<div id="mysModal" class="modal">

  <!-- Sign up Modal content -->
  <div class="modal-content">
      <div class="modal-header">
      <span class="sclose">&times;</span>
      <h2 align="center">Register</h2>
    </div>
        <div class="w3-container">
<div class="wrapper">
    <p><font>Enter your Mobile Number for Verification.</font></p>
     <p></p>
        <form method="post" action="register.php?return=<?php echo $_SESSION['page']; ?>" >
  	<?php include('errors.php'); ?>
        <div class="form-group">
  	  <label>Mobile Number</label>
          <input type="text" name="mobile" class="form-control" maxlength="10" value="<?php echo $mobile; ?>" placeholder="Enter 10 digit Mobile Number">
  	</div>
  	<div class="form-group">
  	  <button type="submit" class="btn btn-primary" name="reg_mobile_verify">Verify</button>
  	</div>
  	<p>
  		Already a member? <a href="start.php">Sign in</a>
  	</p>
  </form>

</div>   
  </div>
</div>
</div>


<!--------Sign up modal content ends--------->


    
<!-- The Login Modal -->
<div id="myModal" class="modal">

  <!-- Login Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2 align="center">Login Here</h2>
    </div>
    <div class="w3-container">
 
    <div class="wrapper">
       
	 
  <form method="post" action="">
  	<?php include('errors.php'); ?>
      <br>
        <div class="form-group">
                <label>Mobile or Email ID</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                
        </div>   
  	
  	
  	<div class="form-group">
  		<label>Password</label>
                <input type="password" name="password" class="form-control" value="">
  	</div>
      
      
  	<div class="form-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php?return=<?php echo $_SESSION['page']; ?>">Create an account</a>
  	</p>
        <p>
            Forgot Password? <a href="forgot.php">Click Here</a>
  	</p>
  </form>
    </div>    
</div>
  </div>
</div>
      
<!-----------Login modal content ends----------->