<?php
session_start(); 
if (!isset($_SESSION['head_mode'])) {
include($_SERVER['DOCUMENT_ROOT']."/MySite/gate.php");
}
?>
<?php
if (isset($_POST['reg_mobile_verify'])) {
    
    if (isset($_GET['return'])){
       $return = $_GET['return'];
    }
    else{
        $return = 'start';
    }
    
$mobile = mysqli_real_escape_string($db, $_POST['mobile']);
if (empty($mobile)) { array_push($errors, "Mobile Number is required"); }

$user_check_query = "SELECT * FROM users WHERE mobile='$mobile' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
   if ($user) { // if user exist
    if ($user['mobile'] === $mobile) {
      array_push($errors, "Mobile Number already exists");
    }
  }
  if (count($errors) == 0) {
    $token = rand(111111,999999);
    $curr_timestamp = time();
    $exp_timestamp = $curr_timestamp + (15 * 60);
    $cc = 91;
    $fp = "https://control.msg91.com/api/sendhttp.php?authkey=341807A9JXmCCtkKUu5f61cc72P&message=Your One Time Password (OTP) is: "
            .$token.". This OTP is valid for 15 minutes. &sender=GFAZAM&route=4&mobiles=".$cc.$mobile;
   $result = ismscURL($fp);
   $_SESSION['sent_otp_reg'] = 'OTP has been sent to '.$mobile;
   $_SESSION['expT'] = $exp_timestamp;
   $_SESSION['mobile'] = $mobile;
   $_SESSION['otp'] = $token;
   header('location: reg_otp_verify.php?mob=' .$mobile);
  }
}
#<!------------ (1) Get mobile and send OTP ENDS ----------->

#<!------------ (2) Verify OTP ----------->

if(isset($_POST['reg_mobile_otp']))
{

$token = mysqli_real_escape_string($db, $_POST['token']);

$getotp = $_SESSION['otp'];
$mobile = $_SESSION['mobile'];
$expT =  $_SESSION['expT'];
$curr_timestamp = time();
if (empty($token)) array_push($errors, "OTP Is required");
 if ($getotp == $token)
    {
    if ($curr_timestamp < $expT)
    {
        $_SESSION['mob'] = $mobile;
        $_SESSION['after_mobile_verification'] = "Mobile verified";
        header('location: reg_enteruserdetails.php');
    }
    else
    {
        array_push($errors, "OTP Expired! <a href = 'register.php'>Restart the process</a>");
    }
   }
    else
    {
        array_push($errors, "Incorrect OTP!");
    }
}
#<!------------ (2) Verify OTP ENDS ----------->

#<!------------ (3) Enter further details ----------->

if (isset($_POST['reg_user'])) {
    if(!isset($_SESSION['after_mobile_verification']))
    {
         header('location: register.php');
    }
    if (isset($_GET['return'])){
       $return = $_GET['return'];
    }
    else{
        $return = 'start';
    }
  // receive all input values from the form
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $fname = mysqli_real_escape_string($db, $_POST['fname']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($fname)) { array_push($errors, "Name is required"); }
  if (empty($email)) { array_push($errors, "Email ID is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  

  if ($user) { // if user exists
    if ($user['email'] === $email) {
      array_push($errors, "Email ID already exists");
    }
  }
  $mobile = $_SESSION['mob'];
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (email, password, fname, mobile, acc_status, balance, master_pass_reset) 
  			  VALUES('$email', '$password', '$fname', '$mobile', 'Active', '100', 'N')";
  	$register = mysqli_query($db, $query);
    if($register) {
      $_SESSION['signup-success'] = "Congratulations! Your account has been successfully created and please login to continue.";
      header('location: '.$return.'.php');
    } else {
      $_SESSION['signup-success'] = "Error occured.";
      header('location: '.$return.'.php');
      
    }
  }
  mysqli_close($db);
}
?> 