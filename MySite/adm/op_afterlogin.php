<?php
  session_start(); 
  if (!isset($_SESSION['cf40c61e54a706033144ba6a76fa7fce_opusername']) 
          || !isset($_SESSION['b35d1ea7a896f20de51e7ab5038ed614_opfname']) 
          || !isset($_SESSION['04a725b8d543725b399199a3ea65f8f8_opemail'])
          || !isset($_SESSION['8454f46898d7c94cff04ff0f78674193_opdesig'])
          || !isset($_SESSION['34a257e66173fdd98fde73f896559a71_opemp_id'])) 
          {
        header('location: /MySite/adm/operator.php');
        exit();
          }

  
          
$success = array();
$errors = array();
$opfname = $_SESSION['b35d1ea7a896f20de51e7ab5038ed614_opfname'];
$db = mysqli_connect('localhost', 'root', '', 'site');
          
$db1 = mysqli_connect('localhost', 'root', '', 'registration');

$query = "SELECT version FROM versions ORDER BY version DESC LIMIT 1";
$result = mysqli_query($db, $query);  
 if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $ver = $row['version'];
  }
$curr_version = $ver;
$next_version = $ver+0.1;

$query = "SELECT nos FROM hits";
$result = mysqli_query($db, $query);  
 if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $nos = $row['nos'];
  }
$hits = $nos;

if (isset($_POST['ver_upd'])) {
    $version = mysqli_real_escape_string($db, $_POST['version']);
    $details = mysqli_real_escape_string($db, $_POST['details']);
               
    $query = "INSERT INTO versions (version, details) VALUES('$version', '$details')";
        $result = mysqli_query($db, $query);
        if($result) {
          header('location: system_upd.php?status=1&req_return=Version Update Success');
        } else {
          header('location: system_upd.php?status=0&req_return=Version Already Exists');
        }
        mysqli_close($db);
}
if (isset($_POST['ver_dlt'])) {
    $ver = mysqli_real_escape_string($db, $_POST['ver']);
    $query = "DELETE FROM versions WHERE version = '$ver'";
        $result = mysqli_query($db, $query);
        if($result) {
          header('location: system_upd.php?status=1&req_return=Version Deletion Success');
        } else {
          header('location: system_upd.php?status=0&req_return=Version Deletion Failed');
        }
        mysqli_close($db);
}
if (isset($_POST['enable_user'])) {
    $username = mysqli_real_escape_string($db1, $_POST['username']);
    $return = $_POST['return'];
    $query = "UPDATE users SET acc_status = 'Active' WHERE mobile = '$username'";
        mysqli_query($db1, $query);
        header('location: '.$return.'&userControlModalReturn=1');
        mysqli_close($db1);
}
if (isset($_POST['disable_user'])) {
    $username = mysqli_real_escape_string($db1, $_POST['username']);
    $return = $_POST['return'];
    $query = "UPDATE users SET acc_status = 'Disabled' WHERE mobile = '$username'";
        mysqli_query($db1, $query);
        header('location: '.$return.'&userControlModalReturn=1');
        mysqli_close($db1);
}
if (isset($_POST['delete_user'])) {
  $username = mysqli_real_escape_string($db1, $_POST['username']);
  $return = $_POST['return'];
  $query = "UPDATE users SET acc_status = 'Deleted' WHERE mobile = '$username'";
      mysqli_query($db1, $query);
      header('location: '.$return.'&userControlModalReturn=1');
      mysqli_close($db1);
}
if (isset($_POST['head_mode'])) {
    $username = mysqli_real_escape_string($db1, $_POST['username']);
    $return = $_POST['return'];
  	$query = "SELECT * FROM users WHERE mobile='$username'";
        $result = mysqli_query($db1, $query);

        if (mysqli_num_rows($result) == 1) {
         
           while($row = mysqli_fetch_assoc($result)) 
            {
              $_SESSION['0c83f57c786a0b4a39efab23731c7ebc_email'] = $row["email"];
              $_SESSION['b80bb7740288fda1f201890375a60c8f_id'] = $row["id"];
              $_SESSION['a3da707b651c79ecc39a4986516180b2_fname'] = $row["fname"];
              $_SESSION['532c28d5412dd75bf975fb951c740a30_mobile'] = $row["mobile"];
              $_SESSION['48e3ae0056e0c0dc97f70c4f29a4864c_login-success'] = 'Hey Admin, You have successfully logged in as '.$row["fname"].'.';
              $_SESSION['head_mode'] = $opfname;
              $_SESSION['return'] = $return.'&userControlModalReturn=1';
              unset($_SESSION['change']);
            }
           header('location: /MySite/after/start_after.php');
        }
        mysqli_close($db1);
}
if (isset($_POST['reset-hits'])) {
  $query = "UPDATE hits SET nos = '0'";
      $result = mysqli_query($db, $query);
      if($result) {
        header('location: system_upd.php?status=1&req_return=Hits Reset to Zero');
      } else {
        header('location: system_upd.php?status=0&req_return=Fail to Reset Value to Zero');
      }
      mysqli_close($db);
}
if (isset($_POST['modify-hits'])) {
  $val = $_POST['hits-value'];
  $query = "UPDATE hits SET nos = '$val'";
      $result = mysqli_query($db, $query);
      if($result) {
        header('location: system_upd.php?status=1&req_return=Hits Value Modification Success');
      } else {
        header('location: system_upd.php?status=0&req_return=Hits Value Modification Failed');
      }
      mysqli_close($db);
}
if (isset($_POST['master_access_dis_ena_users'])) {
  $master_pass = $_POST['master_pass'];
  $ena_dis = $_POST['ena_dis'];
  if(isset($_POST['confirm_dis-ena'])){
  $confirmation = $_POST['confirm_dis-ena'];
  } else {
    $confirmation = 'not_confirm';
  }
 
  $query_mp = 'SELECT master_password FROM master_password';
  $result_mp = mysqli_query($db,$query_mp);
  $mp = mysqli_fetch_assoc($result_mp);
  $master_pass_fetch = $mp['master_password'];
  mysqli_close($db);

  if($master_pass != $master_pass_fetch) {
   header ('location: system_upd.php?status=0&req_return=Incorrect Master Password');
   exit();
  } else if($confirmation != "i_confirm") {
    header ('location: system_upd.php?status=0&req_return=You have not confirmed the action');
    exit();
  } else {
    if($ena_dis == "enable") {
    $query = 'UPDATE users SET acc_status="Active"';
    $result = mysqli_query($db1, $query);
    if($result) {
      header ('location: system_upd.php?status=1&req_return=Entire Users Enabled');
    }
  }
  if($ena_dis == "disable") {
    $query = 'UPDATE users SET acc_status="Disabled"';
    $result = mysqli_query($db1, $query);
    if($result) {
      header ('location: system_upd.php?status=1&req_return=Entire Users Disabled');
    }
  }
  }
  mysqli_close($db1);
 }

 if (isset($_POST['lock_unlock_system'])) {

  $date = time();
  $master_pass = $_POST['master_pass'];
  $ena_dis = $_POST['ena_dis'];
  if(isset($_POST['confirm_dis-ena'])){
  $confirmation = $_POST['confirm_dis-ena'];
  } else {
    $confirmation = 'not_confirm';
  }
 
  $query_mp = 'SELECT master_password FROM master_password';
  $result_mp = mysqli_query($db,$query_mp);
  $mp = mysqli_fetch_assoc($result_mp);
  $master_pass_fetch = $mp['master_password'];
  

  if($master_pass != $master_pass_fetch) {
   header ('location: system_upd.php?status=0&req_return=Incorrect Master Password');
   exit();
  } else if($confirmation != "i_confirm") {
    header ('location: system_upd.php?status=0&req_return=You have not confirmed the action');
    exit();
  } else {
    $query = "UPDATE system_gate SET gate_status='$ena_dis', date='$date'";
    $result = mysqli_query($db, $query);
    if($result) {
      if($ena_dis == 0){
      header ('location: system_upd.php?status=1&req_return=System Locked');
      } else if($ena_dis == 1) {
        header ('location: system_upd.php?status=1&req_return=System status updated: Under Maintainance');
      } else {
        header ('location: system_upd.php?status=1&req_return=System Unlocked');
      }
 } else {
  header ('location: system_upd.php?status=0&req_return=Error Occured. Please try again');
 }
}
 mysqli_close($db);
}

 if (isset($_POST['master_access_reset_pass_users'])) {
  $master_pass = $_POST['master_pass'];
  if(isset($_POST['confirm_dis-ena'])){
  $confirmation = $_POST['confirm_dis-ena'];
  } else {
    $confirmation = 'not_confirm';
  }

  $query_mp = 'SELECT master_password FROM master_password';
  $result_mp = mysqli_query($db,$query_mp);
  $mp = mysqli_fetch_assoc($result_mp);
  $master_pass_fetch = $mp['master_password'];
  mysqli_close($db);

  if($master_pass != $master_pass_fetch) {
    header ('location: system_upd.php?status=0&req_return=Incorrect Master Password');
    exit();
   } else if($confirmation != "i_confirm") {
     header ('location: system_upd.php?status=0&req_return=You have not confirmed the action');
     exit();
   } else {
     $query_users = 'SELECT id FROM users';
     $result_users = mysqli_query($db1,$query_users);
     
     while ($rows_users = mysqli_fetch_assoc($result_users)) {
       $gen_pass = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 10);
       $new_pass = md5($gen_pass);
       $id = $rows_users['id'];
       $query_pass = "UPDATE users SET password='$new_pass', master_pass_reset='Y' WHERE id='$id'";
       $result_pass = mysqli_query($db1,$query_pass);
       if($result_pass) {
        header ('location: system_upd.php?status=1&req_return=Passwords reset successful for the entire users');
       } else {
        header ('location: system_upd.php?status=0&req_return=Error occured. Please try again');
       }
     }
   }
   mysqli_close($db1);
}

if (isset($_POST['update_user_details'])) {
    
  $email = $_POST['email'];
  $fname = $_POST['fname'];
  $mobile = $_POST['mobile'];
  $balance = $_POST['balance'];
  $ID = $_POST['id'];
  $return = $_POST['return'];
  $user_check_query = "SELECT * FROM users WHERE id='$ID' LIMIT 1";
  $result = mysqli_query($db1, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  /*if ($user['email'] === $email) {
      array_push($errors, "Email ID already exists in the system");
  }

  if ($user['mobile'] === $mobile) {
      array_push($errors, "Mobile Number already exists in the system");
  }
   if (count($errors) == 0) {*/
    $query = "UPDATE users SET email = '$email', fname = '$fname', mobile = '$mobile', balance = '$balance' WHERE id = '$ID'";
    $result = mysqli_query($db1,$query);
    header('location: '.$return.'&userControlModalReturn=1');
    mysqli_close($db1);
}
if (isset($_POST['raise_request'])) {
  $request_msg = $_POST['request_msg'];
  $customer_id = $_POST['cid'];
  $employee_id = $_POST['eid'];
  $return = $_POST['return'];
  
  $chk_prv_tkt = "SELECT max(ticket_id) AS max_tkt_no FROM query";
  $output = mysqli_query($db,$chk_prv_tkt);
  $tkt_row = mysqli_fetch_assoc($output);
  $max_tkt_with_alpha = $tkt_row['max_tkt_no'];

  $max_tkt_num = substr($max_tkt_with_alpha, 1);
  $max_tkt = $max_tkt_num + 1;
  
  $ticket_id = 'A'.$max_tkt;
  $date_time = time();

  $query = "INSERT INTO query (customer_id, employee_id, msg, date_time, ticket_id, ticket_status, comment)
             VALUES('$customer_id', '$employee_id', '$request_msg', '$date_time', '$ticket_id', 'Open', 'null')";
  $result = mysqli_query($db, $query);
  if($result) {
  header('location: '.$return.'&status=1&req_return=Request Registered with Ticket ID: '.$ticket_id.'&userControlModalReturn=1');
  } else {
    header('location: '.$return.'&status=0&req_return=Failed, please try again&userControlModalReturn=1');
  }
  mysqli_close($db);
}
if (isset($_POST['com_save'])) {
  $com = $_POST['com'];
  $tkt_id = $_POST['tkt_id'];
  $query = "UPDATE query SET comment = '$com' WHERE ticket_id = '$tkt_id'";
    $result = mysqli_query($db, $query);
    if($result) {
      header ('location: tickets_resolution.php?status=1&req_return=Comment Updated&tkt_search_param='.$tkt_id.'&search-tkt');
    } else {
      header ('location: tickets_resolution.php?status=0&req_return=Error occured. Please try again&tkt_search_param='.$tkt_id.'&search-tkt');
    }
}
if (isset($_POST['open_tkt'])) {
  $tkt_id = $_POST['tkt_id'];
  $query = "UPDATE query SET ticket_status = 'Open' WHERE ticket_id = '$tkt_id'";
    $result = mysqli_query($db, $query);
    if($result) {
      header ('location: tickets_resolution.php?status=1&req_return=Ticket marked as Open&tkt_search_param='.$tkt_id.'&search-tkt');
    } else {
      header ('location: tickets_resolution.php?status=0&req_return=Error occured. Please try again&tkt_search_param='.$tkt_id.'&search-tkt');
    }
}
if (isset($_POST['proc_tkt'])) {
  $tkt_id = $_POST['tkt_id'];
  $query = "UPDATE query SET ticket_status = 'Processing' WHERE ticket_id = '$tkt_id'";
    $result = mysqli_query($db, $query);
    if($result) {
      header ('location: tickets_resolution.php?status=1&req_return=Ticket marked as Processing&tkt_search_param='.$tkt_id.'&search-tkt');
    } else {
      header ('location: tickets_resolution.php?status=0&req_return=Error occured. Please try again.&tkt_search_param='.$tkt_id.'&search-tkt');
    }
}
if (isset($_POST['close_tkt'])) {
  $tkt_id = $_POST['tkt_id'];
  $close_date = time();
  $query = "UPDATE query SET ticket_status = 'Closed', close_date = '$close_date' WHERE ticket_id = '$tkt_id'";
    $result = mysqli_query($db, $query);
    if($result) {
      header ('location: tickets_resolution.php?status=1&req_return=Ticket marked as Closed&tkt_search_param='.$tkt_id.'&search-tkt');
    } else {
      header ('location: tickets_resolution.php?status=0&req_return=Error occured. Please try again.&tkt_search_param='.$tkt_id.'&search-tkt');
    }
}
if (isset($_POST['flush_tkt'])) {
  $tkt_id = $_POST['tkt_id'];
  $query = "DELETE FROM query WHERE ticket_id = '$tkt_id'";
    $result = mysqli_query($db, $query);
    if($result) {
      header ('location: tickets_resolution.php?status=1&req_return=Ticket Flushed&tkt_search_param='.$tkt_id.'&search-tkt');
    } else {
      header ('location: tickets_resolution.php?status=0&req_return=Error occured. Please try again.&tkt_search_param='.$tkt_id.'&search-tkt');
    }
}


?>
