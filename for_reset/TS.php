<?php
/*
session_start();
$errors = [];
$user_id = "";
// connect to database
$db = mysqli_connect('localhost', 'root', '', 'registration');

$sql = "SELECT * FROM password_resets WHERE token='42e220'";
$results = mysqli_query($db, $sql);

while($row = mysqli_fetch_assoc($results)) 
{
$email = $row['email'];
$exp_timestamp = $row['exp_timestamp'];
}

echo $email.'  '.$exp_timestamp;

        $reset = "SELECT * FROM users WHERE email='$email'";
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
*/

/*$curr_timestamp = date ('yy:m:d G:i:s');
$endTime = strtotime("+15 minutes", strtotime($curr_timestamp));
echo (date('yy:m:d G:i:s', $endTime));
*/



// PHP program to illustrate the 
// DateTime::modify() function 
    
// Creating a DateTime object 
$datetime = new date ('y-m-d G:i:s');
  
// Calling of date DateTime::modify() function 
// with the increment of 5 months as parameters 
$datetime->modify('+12 month, +12 year +1 minute'); 
  
// Getting the modified date in "y-m-d" format 
echo $datetime->format('Y-m-d G:i:s'); 





?>
 
 
