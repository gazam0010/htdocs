<?php
session_start();

$db = mysqli_connect('localhost', 'root', '', 'site');
$errors = array();


#<--------------------------------------------------- SERVER ONLY FOR ADMINISTRATIION ------------------------------------------------------->



#<---------------If Login------------------>
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  if (empty($username) && !empty($password)) {
    array_push($errors, "Username is required!");
  }
  if (empty($password) && !empty($username)) {
    array_push($errors, "Password is required!");
  }
  if (empty($password) && empty($username)) {
    array_push($errors, "Username and Password are required!");
  }


  if (count($errors) == 0){
    $query_adm = "SELECT * FROM adm WHERE username='$username' OR emp_id='$username'";
    $result_adm = mysqli_query($db, $query_adm);
    $row_adm = mysqli_fetch_assoc($result_adm);
    $acc_status = $row_adm['acc_status'];
    if (mysqli_num_rows($result_adm) == 0) {
      array_push($errors, "Incorrect username or employee ID!");
    }
    if (mysqli_num_rows($result_adm) == 1) {
      if($acc_status == "Active"){
      $username = $row_adm['username'];
      } else if($acc_status == "Disabled") {
        array_push($errors, "Account disabled, contact System Administrator!");
      } else {
        array_push($errors, "Account deletion in process, contact System Administrator!");
      }
    }
  }
  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM adm WHERE username='$username' AND password='$password'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) == 1) {

      while ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['cf40c61e54a706033144ba6a76fa7fce_opusername'] = $row["username"];
        $_SESSION['04a725b8d543725b399199a3ea65f8f8_opemail'] = $row["email"];
        $_SESSION['b35d1ea7a896f20de51e7ab5038ed614_opfname'] = $row["fname"];
        $_SESSION['34a257e66173fdd98fde73f896559a71_opemp_id'] = $row["emp_id"];
        $_SESSION['8454f46898d7c94cff04ff0f78674193_opdesig'] = $row["desig"];
      }
      header('location: op_index.php');
    } else {
      array_push($errors, "Incorrect Username or Password!");
    }
  }
}

#<---------------Login code ends--------------->


#<---------------Password reset request code--------------->

if (isset($_POST['op_reset_pass_emp'])) {

  $emp_id = mysqli_real_escape_string($db, $_POST['emp_id']);
  $username =  mysqli_real_escape_string($db, $_POST['username']);
  $date_time = time();
  $req_id = 'R' . rand(10001, 90009);

  $query_emp = "SELECT * FROM adm WHERE emp_id='$emp_id' AND username='$username'";
  $result_emp = mysqli_query($db, $query_emp);

  if (mysqli_num_rows($result_emp) == 1) {
    $query = "INSERT INTO employee_password_reset (req_id, emp_id, username, date_time, status) 
  VALUES('$req_id', '$emp_id', '$username', '$date_time', 'Open')";
    $result = mysqli_query($db, $query);
    if ($result) {
      header('location: op_reset_password_emp.php?status=1&req_return=Contact Sys. Admin with this Secret Key and click Check Status: ' . $req_id . '&req_id=' . $req_id);
    }
  } else {
    header('location: op_reset_password_emp.php?status=0&req_return=You have entered invalid employee id or username');
    exit();
  }
}

if (isset($_POST['req_status_fetch'])) {

  $req_id = mysqli_real_escape_string($db, $_POST['req_id']);

  $query = "SELECT * FROM employee_password_reset WHERE req_id='$req_id'";
  $result = mysqli_query($db, $query);
  if (mysqli_num_rows($result) == 1) {
    if ($row = mysqli_fetch_assoc($result)) {
      header('location: op_reset_password_emp.php?status=' . $row['status'] . '&req_id=' . $req_id . '&chk_sts=1');
    }
  } else {
    header('location: op_reset_password_emp.php?status=Invalid request, <a href="op_reset_password_emp.php">re-apply</a>.&req_id=' . $req_id . '&chk_sts=1');
  }
}

#<---------------Password reset request code ends--------------->

#<---------------New Password enter--------------->

if (isset($_POST['op_change_pass_emp'])) {

  $req_id = mysqli_real_escape_string($db, $_POST['req_id']);
  $emp_id = mysqli_real_escape_string($db, $_POST['emp_id']);
  $request_hash = mysqli_real_escape_string($db, $_POST['request_hash']);
  $pass_1 = mysqli_real_escape_string($db, $_POST['pass_2']);
  $pass_2 = mysqli_real_escape_string($db, $_POST['pass_1']);
  $return = $_POST['return'];

if($pass_1 == $pass_2) {
  $chk_get_value_existence = "SELECT * FROM employee_password_reset WHERE req_id='$req_id' AND emp_id='$emp_id' AND request_hash='$request_hash'";
  $result_existence_check = mysqli_query($db, $chk_get_value_existence);
  $exists = mysqli_num_rows($result_existence_check);
  

  if ($exists == 1) {
    $password = md5($pass_1);
    $query = "UPDATE adm SET password='$password' WHERE emp_id='$emp_id'";
    $result = mysqli_query($db, $query);
    if ($result) {
      header('location: operator.php?status=1&req_return=Password changed, kindly login now.');
      $query_success = "DELETE FROM employee_password_reset WHERE req_id='$req_id'";
      mysqli_query($db, $query_success);
      exit();
    } else {
      header('location: op_reset_password_emp.php?status=' . $row['status'] . '&req_id=' . $req_id . '&chk_sts=1&req_return=Please re-try.');
      exit();
    }
 } else {
    header('location: op_reset_password_emp.php?&status=0&req_return=Invalid request or request rejected, kindly re-apply or contact Sys. Admin.');
    exit();
  }
} else {
  header('location: '.$return.'&status=0&req_return=Both passwords are not matching.');
    exit();
}
}



#<---------------New Password enter ends--------------->