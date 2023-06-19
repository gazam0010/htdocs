<?php
session_start(); 
if (!isset($_SESSION['head_mode'])) {
include($_SERVER['DOCUMENT_ROOT']."/MySite/gate.php");
}
?>
<?php 
  
  unset($_SESSION['sent_otp']);
  if (!isset($_SESSION['b80bb7740288fda1f201890375a60c8f_id'])
          || !isset($_SESSION['a3da707b651c79ecc39a4986516180b2_fname']) 
          || !isset($_SESSION['0c83f57c786a0b4a39efab23731c7ebc_email']) 
          || !isset($_SESSION['532c28d5412dd75bf975fb951c740a30_mobile'])) 
          {
  	       header('location: /MySite/start.php?falseLogin=1');
          }


// initializing variables
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'registration');
$db1 = mysqli_connect('localhost', 'root', '', 'site');

$username = $_SESSION['532c28d5412dd75bf975fb951c740a30_mobile'];
$id = $_SESSION['b80bb7740288fda1f201890375a60c8f_id'];

$query = "SELECT acc_status FROM users WHERE id='$id'";
$result = mysqli_query($db, $query);
$status = mysqli_fetch_assoc($result);
if ($status['acc_status'] == "Disabled" && !isset($_SESSION['head_mode'])) {
    header('location: ?logout="1"');
}


// CHANGE EMAIL & NAME
if (isset($_POST['ch_em_nm'])) {
    
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $fname = mysqli_real_escape_string($db, $_POST['fname']);
    if (empty($fname)) { array_push($errors, "Name required"); }
    if (empty($email)) { array_push($errors, "Email ID required"); }
    
    $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    
     if ($user['email'] === $email) {
         if($user['mobile'] != $username) {
            array_push($errors, "Email ID already exists");
         }
    }
    
    
     if (count($errors) == 0) {
         $query = "UPDATE users SET fname = '$fname', email = '$email' WHERE mobile = '$username'";
         $result = mysqli_query($db, $query);
         $_SESSION['0c83f57c786a0b4a39efab23731c7ebc_email'] = $email;
         $_SESSION['a3da707b651c79ecc39a4986516180b2_fname'] = $fname;
         header ('location: profile.php?success=1');
         
         
     }
}

/*//CHANGE NAME
if (isset($_POST['ch_nm'])) {
    
    $fname = mysqli_real_escape_string($db, $_POST['fname']);
    if (empty($fname)) { array_push($errors, "Name required"); }
     if (count($errors) == 0) {
         $query = "UPDATE users SET fname = '$fname' WHERE mobile = '$username'";
         mysqli_query($db, $query);
         $_SESSION['change'] = 'Name successfully changed!';
         $_SESSION['a3da707b651c79ecc39a4986516180b2_fname'] = $fname;
         header ('location: profile.php');
     }
}
 */
//CHANGE PASSWORD
if (isset($_POST['ch_ps'])) {
    
    $old_pass = mysqli_real_escape_string($db, $_POST['a_old_pass']);
    $new_pass = mysqli_real_escape_string($db, $_POST['a_new_pass']);
    $re_new_pass = mysqli_real_escape_string($db, $_POST['a_re_new_pass']);
    if (empty($new_pass) && !empty($re_new_pass)) { array_push($errors, "Enter password should not be blank"); }
    if (empty($re_new_pass) && !empty($new_pass)) { array_push($errors, "Re-enter password should not be blank"); }
    if (empty($new_pass) && empty($re_new_pass)) { array_push($errors, "Both fields should not be blank"); }
    
    if ($new_pass != $re_new_pass)
    {
        array_push($errors, "Both passwords do not match");
    }
 else {
        
    
    $query_change = "SELECT password FROM users WHERE mobile = '$username'";
    $result_change = mysqli_query($db, $query_change);
    $info = mysqli_fetch_assoc($result_change);
    
    if($info['password'] != md5($old_pass))
    {
        array_push($errors, "Old password is incorrect!");
    }
 }
     if (count($errors) == 0) {
         $password=md5($new_pass);
         $query = "UPDATE users SET password='$password' WHERE mobile = '$username'";
         mysqli_query($db, $query);
         $_SESSION['change'] = 'Password successfully changed!';
     }
}
//DONATE MONEY
if (isset($_POST['don'])) {
    
    $amount = mysqli_real_escape_string($db, $_POST['amount']);
    $mode = mysqli_real_escape_string($db, $_POST['mode']);
    $usage_place = "Fund Donation";
    $txn_type = "Debit";
    
    if (empty($amount)) { array_push($errors, "Enter Amount"); }
    if (empty($mode)) { array_push($errors, "Please select a mode of payment"); }
    $c_time = time();
    $txn_id = rand(10001111000,99990009999);

    if (count($errors) == 0) {
        if ($mode == "WA") {
            $fetch_bal = "SELECT balance FROM users WHERE mobile='$username'";
            $bal_result = mysqli_query($db, $fetch_bal);
            $bal_param = mysqli_fetch_assoc($bal_result);
            $bal = $bal_param['balance'];
            if ($bal >= $amount) {
                $query = "INSERT INTO donate_mo (amount, date, mode, id, txn_id) 
                VALUES('$amount', '$c_time', '$mode', '$id', '$txn_id')";
                $donate_success_wallet = mysqli_query($db, $query);
                if($donate_success_wallet) {
                    $updated_bal = $bal - $amount; 
                    $insert = "UPDATE users SET balance = '$updated_bal' WHERE mobile = '$username'";
                    $result = mysqli_query($db, $insert);

                    $wallet_txn_data_store = "INSERT INTO wallet_transactions (id, txn_id, usage_place, amount, date_time, type) 
                    VALUES ('$id', '$txn_id', '$usage_place', '$amount', '$c_time', '$txn_type')";
                    mysqli_query($db, $wallet_txn_data_store);

                    $_SESSION['txn'] = $txn_id;
                    $_SESSION['amount'] = $amount;
                    header('location: pay_success.php');
                }
            } else {
                $_SESSION['txn'] = "Low Balance";
                $_SESSION['amount'] = "Retry";
                header('location: pay_success.php');
            }
        } else {
            $query = "INSERT INTO donate_mo (amount, date, mode, id, txn_id) 
  			  VALUES('$amount', '$c_time', '$mode', '$id', '$txn_id')";
            mysqli_query($db, $query);
            $_SESSION['txn'] = $txn_id;
            $_SESSION['amount'] = $amount;
            header('location: pay_success.php');
        }
    }
}

//DONATE PLASMA
if (isset($_POST['don_plasma'])) {
    
    $pay_mode = mysqli_real_escape_string($db, $_POST['mode_pl']);
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $don_type = mysqli_real_escape_string($db, $_POST['don_type']);
    $usage_place = "Plasma Donation";
    $txn_type = "Debit";

    if (empty($address)) { array_push($errors, "Enter Address"); }
    if (empty($pay_mode)) { array_push($errors, "Please select a mode of payment"); }
    $c_time = time();
    $txn_id = rand(10001111000,99990009999);
    $ref_id = rand(10000000,90000000);
    $fees = 100;

    if (count($errors) == 0) {
        if ($pay_mode == "WA") {
            $fetch_bal = "SELECT balance FROM users WHERE mobile='$username'";
            $bal_result = mysqli_query($db, $fetch_bal);
            $bal_param = mysqli_fetch_assoc($bal_result);
            $bal = $bal_param['balance'];
            if ($bal >= $fees) {
                $query = "INSERT INTO donate_pl (id, date, mode, txn_id, ref_id, don_type, address, fees) 
                VALUES('$id', '$c_time', '$pay_mode', '$txn_id', '$ref_id', '$don_type', '$address', '$fees')";
                $donate_success_plasma = mysqli_query($db, $query);

                $wallet_txn_data_store = "INSERT INTO wallet_transactions (id, txn_id, usage_place, amount, date_time, type) 
                VALUES ('$id', '$txn_id', '$usage_place', '$fees', '$c_time', '$txn_type')";
                mysqli_query($db, $wallet_txn_data_store);

                if($donate_success_plasma) {
                    $updated_bal = $bal - $fees; 
                    $insert = "UPDATE users SET balance = '$updated_bal' WHERE mobile = '$username'";
                    $result = mysqli_query($db, $insert);
                    $_SESSION['txn'] = $txn_id;
                    $_SESSION['pay_mode'] = $pay_mode;
                    $_SESSION['don_type'] = $don_type;
                    $_SESSION['ref_id'] = $ref_id;
                    $_SESSION['address'] = $address;
                    $_SESSION['c_time'] = $c_time;
                    $_SESSION['fees'] = $fees;
                    header('location: pay_success_plasma.php');
                }
            } else {
                $_SESSION['txn'] = "Low Balance";
                $_SESSION['amount'] = "Retry";
                header('location: pay_success_plasma.php');
            }
        } else {
            $query = "INSERT INTO donate_pl (id, date, mode, txn_id, ref_id, don_type, address, fees) 
                VALUES('$id', '$c_time', '$pay_mode', '$txn_id', '$ref_id', '$don_type', '$address', '$fees')";
            $result = mysqli_query($db, $insert);
            $_SESSION['txn'] = $txn_id;
            $_SESSION['pay_mode'] = $pay_mode;
            $_SESSION['don_type'] = $don_type;
            $_SESSION['ref_id'] = $ref_id;
            $_SESSION['address'] = $address;
            $_SESSION['c_time'] = $c_time;
            $_SESSION['fees'] = $fees;
            header('location: pay_success_plasma.php');
            
        }
    }
}


//DONATE ELSE
if (isset($_POST['other_don'])) {
    
    $itype = mysqli_real_escape_string($db, $_POST['itype']);
    $quan = mysqli_real_escape_string($db, $_POST['quan']);
    $add1 = mysqli_real_escape_string($db, $_POST['add1']);
    $add2 = mysqli_real_escape_string($db, $_POST['add2']);
    $dist = mysqli_real_escape_string($db, $_POST['dist']);
    $pin = mysqli_real_escape_string($db, $_POST['pin']);
    
    $c_time = time();
    $exp = $c_time + (7 * 24 * 60 * 60);
    $od_id = rand(1000000,9999000);
    
  if (count($errors) == 0) {
         $query = "INSERT INTO donate_else (item_type, item_quan, add1, add2, dist, pin, od_id, date, status, id) 
  			  VALUES('$itype', '$quan', '$add1', '$add2', '$dist', '$pin', '$od_id', '$c_time', 'Order Placed', '$id')";
         mysqli_query($db, $query);
         $_SESSION['od_id'] = $od_id;
         $_SESSION['exp'] = $exp;
        header ('location: od_success.php');
  }
}
//DONATE ORDER CANCELLATION REQUEST
if (isset($_POST['don_can'])) {
    
        $od_id = mysqli_real_escape_string($db, $_POST['od_id']);

        $query = "UPDATE donate_else SET status = 'Cancelled' WHERE od_id = '$od_id'";
         mysqli_query($db, $query);
        header ('location: donations_else.php');

}
//DONATE ORDER DELETETION CANCELLED
if (isset($_POST['don_del'])) {
    
        $od_id = mysqli_real_escape_string($db, $_POST['od_id']);
        $query = "DELETE FROM donate_else WHERE status = 'Cancelled' AND od_id = '$od_id'";
        mysqli_query($db, $query);
        
        if(!mysqli_query($db, $query))
        {
            array_push($errors, "Some error occured, Pl. Cont. Adm. w/ ref.: 402.");
        }
        else
        {
        header ('location: donations_else.php');
        }
}

//COUPON REDEMPTION
if(isset($_POST['redeem'])) {
    $pin = $_POST['pin'];
    $query = "SELECT * FROM coupon WHERE pin = '$pin'";
    $gift_query = mysqli_query($db, $query);
    $fetch_data = mysqli_fetch_assoc($gift_query);
    $txn_id = rand(10001111000,99990009999);
    $c_time = time();
    $usage_place = "Wallet (Gift Card)";
    $txn_type="Credit";
    if(mysqli_num_rows($gift_query) > 0) {
        if($fetch_data['redeem'] == "NO") {
        $bal = $fetch_data['amount'];
        $bal_query = "SELECT balance FROM users WHERE id = '$id'";
        $out = mysqli_query($db, $bal_query);
        $bal_fetch = mysqli_fetch_assoc($out);
        $current_bal = $bal_fetch['balance'];
        $updated_bal = $current_bal + $bal; 
        $insert = "UPDATE users SET balance = '$updated_bal' WHERE mobile = '$username'";
        $result = mysqli_query($db, $insert);

        if($result) {
            $redeem = "UPDATE coupon SET redeem = 'YES',redemption_by_user = '$id',txn_id='$txn_id' WHERE pin = '$pin'";
            mysqli_query($db, $redeem);
            $wallet_txn_data_store = "INSERT INTO wallet_transactions (id, txn_id, usage_place, amount, date_time, type) 
            VALUES ('$id', '$txn_id', '$usage_place', '$bal', '$c_time', '$txn_type')";
            mysqli_query($db, $wallet_txn_data_store);
            header('location: http://localhost/MySite/after/wallet.php?status=1&req_return=Redeemed!');
        }
     } else {
        header('location: http://localhost/MySite/after/wallet.php?status=0&req_return=Already Redeemed!');
     }
    } else {
        header('location: http://localhost/MySite/after/wallet.php?status=0&req_return=Incorrect Pin!');
    }
}

//QUERY
if(isset($_POST['query_user'])) {
    $query_msg = $_POST['query_msg'];
    $query_type = $_POST['query_type'];
    $employee_id = 'User';
    $msg = $query_type.', '.$query_msg;

    $chk_prv_tkt = "SELECT max(ticket_id) AS max_tkt_no FROM query";
    $output = mysqli_query($db1,$chk_prv_tkt);
    $tkt_row = mysqli_fetch_assoc($output);
    $max_tkt_with_alpha = $tkt_row['max_tkt_no'];
  
    $max_tkt_num = substr($max_tkt_with_alpha, 1);
    $max_tkt = $max_tkt_num + 1;
    
    $ticket_id = 'A'.$max_tkt;
    $date_time = time();
  
    $query = "INSERT INTO query (customer_id, employee_id, msg, date_time, ticket_id, ticket_status, comment)
               VALUES('$id', '$employee_id', '$msg', '$date_time', '$ticket_id', 'Open', 'No Update')";
    $result = mysqli_query($db1, $query);
    if($result) {
    header('location: http://localhost/MySite/after/contact_after.php?&status=1&req_return=Request Registered with Ticket ID: '.$ticket_id);
    } else {
        header('location: http://localhost/MySite/after/contact_after.php?&status=0&req_return=Error Occurred, please try later');
    }
    
}