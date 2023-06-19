<?php
session_start(); 
if (!isset($_SESSION['head_mode'])) {
include($_SERVER['DOCUMENT_ROOT']."/MySite/gate.php");
}
?>
<?php

#<--------Function for cURL SMS OTP starts------>
function ismscURL($link){

    $http = curl_init($link);

    curl_setopt($http, CURLOPT_RETURNTRANSFER, TRUE);
    $http_result = curl_exec($http);
    $http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
    curl_close($http);

    return $http_result;
}
#<---------Func Ends------------->


// initializing variables
$username = "";
$email    = "";
$fname    = "";
$mobile   = "";
$errors = array();  

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'registration');


#<--------------------Registering code starts here--------------->

#<!------------ (1) Get mobile and send OTP ----------->

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
#<!------------ (3) Enter further details ENDS ----------->

#<----------------------Registering code ends-------------------------->


#<---------------If Login------------------>
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $page = $_SESSION['page'];
  if (empty($username) && !empty($password)) {
  	array_push($errors, "Email/Mobile is required!");
  }
  if (empty($password) && !empty($username)) {
  	array_push($errors, "Password is required!");
  }
  if (empty($password) && empty($username)) {
  	array_push($errors, "Email/Mobile and Password are required!");
  }
  
  if (count($errors) == 0){
        $query_user = "SELECT * FROM users WHERE mobile='$username' OR email='$username'";
        $result_user = mysqli_query($db, $query_user);

        if (mysqli_num_rows($result_user) == 1) {
         
           while($row = mysqli_fetch_assoc($result_user)) 
            {
              $id = $row["id"];
              $status = $row["acc_status"];
              $password_not_match_reason = $row["master_pass_reset"];
              if ($status == 'Disabled')
              {
                  array_push($errors,"Account disabled, kindly contact customer care");
              }
              if ($status == 'Deleted')
              {
                  array_push($errors,"Account deletion in progress, it will be deleted in 30 days.
                   Contact customer care if want to keep the account.");
              }
           }
          }
           else
           {
               array_push($errors,"User not found");
           }
        
    }
   
  if (count($errors) == 0) {
        $password = md5($password);
      	$query = "SELECT * FROM users WHERE id='$id' AND password='$password'";
        $result = mysqli_query($db, $query);

        if (mysqli_num_rows($result) == 1) {
         
           while($row = mysqli_fetch_assoc($result)) 
            {
              $_SESSION['0c83f57c786a0b4a39efab23731c7ebc_email'] = $row["email"];
              $_SESSION['balance'] = $row["balance"];
              $_SESSION['b80bb7740288fda1f201890375a60c8f_id'] = $row["id"];
              $_SESSION['a3da707b651c79ecc39a4986516180b2_fname'] = $row["fname"];
              $_SESSION['532c28d5412dd75bf975fb951c740a30_mobile'] = $row["mobile"];
              $_SESSION['48e3ae0056e0c0dc97f70c4f29a4864c_login-success'] = 'You have successfully logged in.';
              unset($_SESSION['change']);
            }
           header('location: /MySite/after/'.$page.'_after.php');
  	}else {
        if($password_not_match_reason == "Y") {
          array_push($errors, "Password was changed due to some internal issues, kindly reset the password.");
        } else {
              array_push($errors, "Incorrect Username or Password!");
        }
  	}
  }
}

#<---------------Login code ends--------------->




#<----------------Send OTP for Password reset code-------------->
if (isset($_POST['reset-password'])) {
  $mobile = mysqli_real_escape_string($db, $_POST['mobile']);
  // ensure that the user exists on our system
  $query = "SELECT mobile FROM users WHERE mobile='$mobile'";
  $results = mysqli_query($db, $query);

  if (empty($mobile)) {
    array_push($errors, "Your mobile number is required");
  }else if(mysqli_num_rows($results) <= 0) {
    array_push($errors, "Sorry, no user exists on our system with that mobile number");
  }
  // generate a unique random token
  $token = rand(125694,998975);
  
  // current timestamp and set expiry timestamp for OTP expiration
  $curr_timestamp = time();
  $exp_timestamp = $curr_timestamp + (15 * 60);
  
  if (count($errors) == 0) {
    /*// store token in the password-reset database table against the user's email
    $sql = "INSERT INTO password_resets(mobile, token, timestamp, exp_timestamp) VALUES ('$mobile', '$token', '$curr_timestamp', '$exp_timestamp')";
    $results = mysqli_query($db, $sql);
     */
    // Send email to user with the token in a link they can click on
    $cc = 91;
    $fp = "https://control.msg91.com/api/sendhttp.php?authkey=341807A9JXmCCtkKUu5f61cc72P1&message=Your One Time Password (OTP) is: "
           .$token.". This OTP is valid for 15 minutes. &sender=GFAZAM&route=4&mobiles=".$cc.$mobile;
   //echo $fp;
    $result = ismscURL($fp);
    $_SESSION['expT'] = $exp_timestamp;
    $_SESSION['otp'] = $token;
    $_SESSION['sent_otp'] = 'OTP successfully sent to '.$mobile;
    header('location: new_pass.php?mob=' .$mobile);
 }
}

#<------------Send OTP for Password reset ends--------------->



#<---------------New password after OTP sent-----------------> 
if (isset($_POST['new_password'])) {
  $new_pass = mysqli_real_escape_string($db, $_POST['new_pass']);
  $new_pass_c = mysqli_real_escape_string($db, $_POST['new_pass_c']);
  $token = mysqli_real_escape_string($db, $_POST['token']);

  // grabbing all the sessions & store them in variables
  $mob = $_GET['mob'];
  $getotp = $_SESSION['otp'];
  $expT =  $_SESSION['expT'];
  $curr_timestamp = time();
          
  
 
  if (empty($new_pass) || empty($new_pass_c)) array_push($errors, "Password is required");
  if ($new_pass !== $new_pass_c) array_push($errors, "Password do not match");
  if (count($errors) == 0) {
     //select email address of user from the password_reset table 
    /*$sql = "SELECT * FROM password_resets WHERE mobile='$mob'";
    $results = mysqli_query($db, $sql);
    while($row = mysqli_fetch_assoc($results)) 
     {
     $expT = $row['exp_timestamp'];
     }
     */
    if ($getotp == $token)
    {
    if ($curr_timestamp < $expT)
    {
      if ($mob) {
        $new_pass = md5($new_pass);
        $sql = "UPDATE users SET password='$new_pass',master_pass_reset='N' WHERE mobile='$mob'";
        $results = mysqli_query($db, $sql);
       
        //Login after password successfully changed
        $reset = "SELECT * FROM users WHERE mobile='$mob'";
        $result_reset = mysqli_query($db, $reset);
        

        if (mysqli_num_rows($result_reset) == 1) {
         
           while($rows = mysqli_fetch_assoc($result_reset)) 
            {
              $_SESSION['14c4b06b824ec593239362517f538b29_username'] = $rows["username"];
              $_SESSION['0c83f57c786a0b4a39efab23731c7ebc_email'] = $rows["email"];
              $_SESSION['a3da707b651c79ecc39a4986516180b2_fname'] = $rows["fname"];
              $_SESSION['532c28d5412dd75bf975fb951c740a30_mobile'] = $mob;
              $_SESSION['reset-success'] = 'Your password has been successfully changed and you have now logged in!';
              $_SESSION['b80bb7740288fda1f201890375a60c8f_id'] = $rows["id"];
            }
            
           header('location: /MySite/after/start_after.php');
        }
      }
      else
      {
          array_push($errors, "Error 401, Pl. cont. admn.");
      }
    }
    else
    {
        array_push($errors, "OTP Expired! <a href = 'forgot.php'>Restart the process</a");
    }
    }
    else
    {
        array_push($errors, "Incorrect OTP!");
    }
  }
}
#<------------------New password after OTP enter ends--------------->
?>