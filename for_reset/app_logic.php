<?php

session_start();
function ismscURL($link){

    $http = curl_init($link);

    curl_setopt($http, CURLOPT_RETURNTRANSFER, TRUE);
    $http_result = curl_exec($http);
    $http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
    curl_close($http);

    return $http_result;
}

$errors = [];
$user_id = "";
// connect to database
$db = mysqli_connect('localhost', 'root', '', 'registration');

// LOG USER IN
if (isset($_POST['login_user'])) {
  // Get username and password from login form
  $user_id = mysqli_real_escape_string($db, $_POST['user_id']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  // validate form
  if (empty($user_id)) array_push($errors, "Username or Email is required");
  if (empty($password)) array_push($errors, "Password is required");

  // if no error in form, log user in
  if (count($errors) == 0) {
    $password = md5($password);
    $sql = "SELECT * FROM users WHERE username='$user_id' OR email='$user_id' AND password='$password'";
    $results = mysqli_query($db, $sql);

    if (mysqli_num_rows($results) == 1) {
      $_SESSION['username'] = $user_id;
      $_SESSION['success'] = "You are now logged in";
      header('location: index.php');
    }else {
      array_push($errors, "Wrong credentials");
    }
  }
}

/*
  Accept email of user whose password is to be reset
  Send email to user to reset their password
*/
if (isset($_POST['reset-password'])) {
  $mobile = mysqli_real_escape_string($db, $_POST['mobile']);
  // ensure that the user exists on our system
  $query = "SELECT email FROM users WHERE mobile='$mobile'";
  $results = mysqli_query($db, $query);

  if (empty($mobile)) {
    array_push($errors, "Your mobile number is required");
  }else if(mysqli_num_rows($results) <= 0) {
    array_push($errors, "Sorry, no user exists on our system with that mobile number");
  }
  // generate a unique random token of length 100
  $token = bin2hex(random_bytes(3));
  $curr_timestamp = date ('yy:m:d G:i:s');
  
  $endTime = strtotime("+15 minutes", strtotime($curr_timestamp));
  $exp_timestamp = date('yy:m:d G:i:s', $endTime);

  /*if (count($errors) == 0) {
    // store token in the password-reset database table against the user's email
    $sql = "INSERT INTO password_resets(mobile, token, timestamp, exp_timestamp) VALUES ('$mobile', '$token', '$curr_timestamp', '$exp_timestamp')";
    $results = mysqli_query($db, $sql);
*/
    // Send email to user with the token in a link they can click on
   $fp = "https://control.msg91.com/api/sendhttp.php?authkey=341807A9JXmCCtkKUu5f61cc72P1&message=Your One Time Password (OTP) is: ".$token.". This OTP is valid for 15 minutes. &sender=DRSLVE&route=4";
   $fp .= "&mobiles=$mobile";
   //echo $fp;
   $result = ismscURL($fp);
    $_SESSION['expT'] = $exp_timestamp;
    $_SESSION['mob'] = $mobile;
    $_SESSION['otp'] = $token;
    $_SESSION['sent_otp'] = 'OTP successfully sent!';
    header('location: new_pass.php');
  
}



// ENTER A NEW PASSWORD
if (isset($_POST['new_password'])) {
  $new_pass = mysqli_real_escape_string($db, $_POST['new_pass']);
  $new_pass_c = mysqli_real_escape_string($db, $_POST['new_pass_c']);
  $token = mysqli_real_escape_string($db, $_POST['token']);

  $mob = $_SESSION['mob'];
  $getotp = $_SESSION['otp'];
  $expT =  $_SESSION['expT'];
  $curr_timestamp = date ('yy:m:d G:i:s');
          
  // Grab to token that came from the email link
 
  if (empty($new_pass) || empty($new_pass_c)) array_push($errors, "Password is required");
  if ($new_pass !== $new_pass_c) array_push($errors, "Password do not match");
  if (count($errors) == 0) {
     //select email address of user from the password_reset table 
   /* $sql = "SELECT * FROM password_resets WHERE mobile='$mob'";
    $results = mysqli_query($db, $sql);
    while($row = mysqli_fetch_assoc($results)) 
     {
     $mobile = $row['mobile'];
     $exp_timestamp = $row['exp_timestamp'];
     }
     */
    if ($getotp == $token)
    {
    if (strtotime($curr_timestamp) < strtotime($expT))
    {
      if ($mob) {
        $new_pass = md5($new_pass);
        $sql = "UPDATE users SET password='$new_pass' WHERE mobile='$mob'";
        $results = mysqli_query($db, $sql);
       
        //Login after password successfully changed
        $reset = "SELECT * FROM users WHERE mobile='$mob'";
        $result_reset = mysqli_query($db, $reset);
        

        if (mysqli_num_rows($result_reset) == 1) {
         
           while($rows = mysqli_fetch_assoc($result_reset)) 
            {
              $_SESSION['username'] = $rows["username"];
              $_SESSION['email'] = $rows["email"];
              $_SESSION['fname'] = $rows["fname"];
              $_SESSION['reset-success'] = 'Your password has been successfully changed and you have now logged in!';
              $_SESSION['id'] = $rows["id"];
            }
            
           header('location: /MySite/index.php');
        }
      }
    }
    else
    {
        array_push($errors, "OTP Expired!");
    }
    }
    else
    {
        array_push($errors, "Incorrect OTP!");
    }
  }
}
?>