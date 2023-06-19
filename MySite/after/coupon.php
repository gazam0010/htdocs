<?php include ('afterlogin.php'); ?>
<?php
$_SESSION['previous_page'] = 'start_after.php';
?>
<?php 
  if (isset($_GET['logout'])) {
        unset($_SESSION['b80bb7740288fda1f201890375a60c8f_id']);
        unset($_SESSION['a3da707b651c79ecc39a4986516180b2_fname']);
        unset($_SESSION['0c83f57c786a0b4a39efab23731c7ebc_email']);
        unset($_SESSION['532c28d5412dd75bf975fb951c740a30_mobile']);
  	header("location: /MySite/start.php");
  }
?>
<html>
<head>
</head>
<body>
<form method="POST" action="">
<label>Gift Card ID: </label>
<input type="text" name="cid" placeholder="Coupon ID" class="w3-input">
<label>PIN: </label>
<input type="text" name="pin" placeholder="PIN" class="w3-input">
<input type="submit" name="redeem" value="Redeem">
</form>
</body>
</html>