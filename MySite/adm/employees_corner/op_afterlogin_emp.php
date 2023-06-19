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

$db_adm = mysqli_connect('localhost', 'root', '', 'site');
$db_user = mysqli_connect('localhost', 'root', '', 'registration');

$adm_username = $_SESSION['cf40c61e54a706033144ba6a76fa7fce_opusername'];
$emp_id_logged = $_SESSION['34a257e66173fdd98fde73f896559a71_opemp_id'];
$query = "SELECT desig FROM adm WHERE emp_id = '$emp_id_logged'";
$result = mysqli_query($db_adm, $query);
$desig = mysqli_fetch_assoc($result);
$designation = $desig['desig'];
if($designation != "System Administrator") {
    header('location: /MySite/adm/op_index.php');
    exit();
}


if (isset($_POST['processsing_req'])) {
    $req_id = $_POST['req_id'];
    $query = "UPDATE employee_password_reset SET status = 'Processing' WHERE req_id = '$req_id'";
      $result = mysqli_query($db_adm, $query);
      if($result) {
        header ('location: requests_resolution.php?status=1&req_return=Request marked as processing&tkt_search_param='.$req_id.'&search-tkt');
      } else {
        header ('location: requests_resolution.php?status=0&req_return=Error occured. Please try again&tkt_search_param='.$req_id.'&search-tkt');
      }
  }
  
  if (isset($_POST['approved_req'])) {
    $req_id = $_POST['req_id'];
    $query = "UPDATE employee_password_reset SET status = 'Approved' WHERE req_id = '$req_id'";
      $result = mysqli_query($db_adm, $query);
      if($result) {
        header ('location: requests_resolution.php?status=1&req_return=Request approved with ID&tkt_search_param='.$req_id.'&search-tkt');
      } else {
        header ('location: requests_resolution.php?status=0&req_return=Error occured. Please try again.&tkt_search_param='.$tkt_id.'&search-tkt');
      }
  }
  if (isset($_POST['link_sent_req_pass_change_emp'])) {
    $req_id = $_POST['req_id'];
    $emp_id = $_POST['emp_id'];
    $req_hash = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 20);
    $link_prepare = '<a href="http://localhost/MySite/adm/op_reset_password_emp_pt2.php?password_reset_emp=1&emp_id='.$emp_id.'&req_id='.$req_id.'&request_hash='.$req_hash.'">Click Here</a>';
    $link = mysqli_real_escape_string($db_adm,$link_prepare);
    $query = "UPDATE employee_password_reset SET status = 'Reset link sent',link = '$link',request_hash='$req_hash' WHERE req_id = '$req_id'";
      $result = mysqli_query($db_adm, $query);
      if($result) {
        header ('location: requests_resolution.php?status=1&req_return=Reset link sent&tkt_search_param='.$req_id.'&search-tkt');
      } else {
        header ('location: requests_resolution.php?status=0&req_return=Error occured. Please try again.&tkt_search_param='.$req_id.'&search-tkt');
      }
  }
  
  if (isset($_POST['reject_req'])) {
    $req_id = $_POST['req_id'];
    $query = "UPDATE employee_password_reset SET status = 'Rejected',request_hash='null' WHERE req_id = '$req_id'";
      $result = mysqli_query($db_adm, $query);
      if($result) {
        header ('location: requests_resolution.php?status=1&req_return=Request Rejected&tkt_search_param='.$req_id.'&search-tkt');
      } else {
        header ('location: requests_resolution.php?status=0&req_return=Error occured. Please try again.&tkt_search_param='.$req_id.'&search-tkt');
      }
  }
  
  if (isset($_POST['dlt_req_pswd_emp'])) {
    $req_id = $_POST['req_id'];
    $query_success = "DELETE FROM employee_password_reset WHERE req_id='$req_id'";
        mysqli_query($db_adm, $query_success);
      if($result) {
        header ('location: requests_resolution.php?status=1&req_return=Request Flushed&tkt_search_param='.$req_id.'&search-tkt');
      } else {
        header ('location: requests_resolution.php?status=0&req_return=Error occured. Please try again.&tkt_search_param='.$req_id.'&search-tkt');
      }
  }



  if (isset($_POST['enable_emp'])) {
    $emp_id = mysqli_real_escape_string($db_adm, $_POST['emp_id']);
    $return = $_POST['return'];
    $query = "UPDATE adm SET acc_status = 'Active' WHERE emp_id = '$emp_id'";
    $result = mysqli_query($db_adm, $query);
    if($result) {
     header('location: '.$return.'&userControlModalReturn=1&status=1&req_return=Employee Enabled');
    } else {
     header('location: '.$return.'&userControlModalReturn=1&status=0&req_return=Error Occured)');
    }
     
     mysqli_close($db_adm);
}
if (isset($_POST['disable_emp'])) {
    $emp_id = mysqli_real_escape_string($db_adm, $_POST['emp_id']);
    $return = $_POST['return'];
    $query = "UPDATE adm SET acc_status = 'Disabled' WHERE emp_id = '$emp_id'";
       $result = mysqli_query($db_adm, $query);
       if($result) {
        header('location: '.$return.'&userControlModalReturn=1&status=1&req_return=Employee Disabled');
       } else {
        header('location: '.$return.'&userControlModalReturn=1&status=0&req_return=Error Occured)');
       }
        
        mysqli_close($db_adm);
}
if (isset($_POST['delete_emp'])) {
  $emp_id = mysqli_real_escape_string($db_adm, $_POST['emp_id']);
  $return = $_POST['return'];
  $query = "UPDATE adm SET acc_status = 'Deleted' WHERE emp_id = '$emp_id'";
  $result = mysqli_query($db_adm, $query);
  if($result) {
   header('location: '.$return.'&userControlModalReturn=1&status=1&req_return=Employee Deleted');
  } else {
   header('location: '.$return.'&userControlModalReturn=1&status=0&req_return=Error Occured)');
  }
   
   mysqli_close($db_adm);
}



if (isset($_POST['update_emp_details'])) {
    
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $desig = $_POST['desig'];
    $username = $_POST['username'];
    $emp_id = $_POST['emp_id'];
    $return = $_POST['return'];

    /*$user_check_query = "SELECT * FROM users WHERE id='$ID' LIMIT 1";
    $result = mysqli_query($db_adm, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    
    if ($user['email'] === $email) {
        array_push($errors, "Email ID already exists in the system");
    }
  
    if ($user['mobile'] === $mobile) {
        array_push($errors, "Mobile Number already exists in the system");
    }
     if (count($errors) == 0) {*/

      $query = "UPDATE adm SET email = '$email', fname = '$fname', username = '$username', desig = '$desig' WHERE emp_id = '$emp_id'";
      $result = mysqli_query($db_adm, $query);
      if($result) {
       header('location: '.$return.'&userControlModalReturn=1&status=1&req_return=Details Updated');
      } else {
       header('location: '.$return.'&userControlModalReturn=1&status=0&req_return=Error Occured)');
      }
       
       mysqli_close($db_adm);
    }
?>
