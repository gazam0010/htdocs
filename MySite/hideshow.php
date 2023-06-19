<?php
$error = 1;
?>
<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="progress_bar.css">
<style>
#myDIV {
  width: 100%;
  padding: 50px 0;
  text-align: center;
  background-color: lightblue;
  margin-top: 20px;
}
</style>
</head>
<body onload="myShow1()">
    
    
<div id="myForm1">
    <form method="post" action="" oninput="mobile.value = countrycode.value + mob.value">
       <?php include('errors.php'); ?>
      <div class="input-group">
  	  <label>Mobile Number</label>
          <input type="text" name="mob" class="input-control" maxlength="10" value="<?php echo $mobile; ?>" placeholder="Enter 10 digit Mobile Number">
  	</div>
  	<div class="inputs-group">
            <button type="submit" name="reg_mobile_verify" value="Verify" onclick="myShow2()">Verify</button>
        </div>
        <input type="hidden" name="countrycode" value="91">
        <input type="hidden" name="mobile">
     </form>
</div>
    
    
<div id="myForm2">
 <form class="login-form" method="post" action="reg_otp_verify.php?return=<?php echo $_SESSION['page']; ?>">
                <div class="alert alert-success">
                    <p align='center'><font size='3px'>
                <h3><?php if (isset($_SESSION['sent_otp_reg'])) : ?>
                    <?php 
         	           echo '<strong>'.$_SESSION['sent_otp_reg'].' '.$_SESSION['otp'].'</strong>.'.' It will expire in 15 minutes. <br><font size="2"><a href = "register.php">Wrong mobile number? </a></font>';
          	    ?>
                    <?php endif ?>  </h3>
                    </font></p>
                </div>
      <br>
        <div class="form-group">
  	  <label>Enter OTP</label>
          <input type="text" name="token" class="form-control" placeholder="Enter OTP">
  	</div>
  	<div class="form-group">
  	  <button type="submit" onclick="myShow3()" class="btn btn-primary" name="reg_mobile_otp">Proceed</button>
  	</div>
      <br>
  	<p>
  		Already a member? <a href="start.php">Sign in</a>
  	</p>
  </form>
</div>
    
    
<div id="myForm3">
This is my DIV element3.
<button type="submit">Submit</button>
</div>


<script>
function myShow1() {
    if (<?php echo $error; ?> > 0)
    {
  var x = document.getElementById("myForm1");
  var y = document.getElementById("myForm2");
  var z = document.getElementById("myForm3");
  
    x.style.display = "block";
    y.style.display = "none";
    z.style.display = "none";
    } 
  
 }
function myShow2() {
    if (<?php echo $error; ?> > 0)
    {
  var x = document.getElementById("myForm1");
  var y = document.getElementById("myForm2");
  
    x.style.display = "none";
 
    y.style.display = "block";
 }
}
function myShow3() {
    if (<?php echo $error; ?> > 0)
    {
  var x = document.getElementById("myForm2");
  var y = document.getElementById("myForm3");
  
    x.style.display = "none";
 
    y.style.display = "block";
  
 }
}
</script>

</body>
</html>

