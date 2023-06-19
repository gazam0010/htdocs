<?php 
include('op_afterlogin.php');
?>
<?php
if(isset($_POST['submit'])) {
    $amt = $_POST['amt'];
    $cid = rand();
    $pin_val_1 = rand(1000, 9990);
    $pin_val_2 = rand(1000, 9990);
    $pin_val_3 = rand(1000, 9990);
    $pin = $pin_val_1."-".$pin_val_2."-".$pin_val_3;
    $dt = time();
    $query = "INSERT INTO coupon (coupon_id, pin, amount, date_time, redeem) 
    VALUES('$cid', '$pin', '$amt', '$dt', 'NO')";
    $result = mysqli_query($db1, $query);
    if($result) {
      echo 'Gift Card Creation Successfull!';
    } else {
      echo 'Error';
    }
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>
            Welcome Admin
        </title>
        <link rel="stylesheet" href="w3css.css">
        <style>
    table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
td, th {
  text-align: left;
  padding: 8px;
}
</style>
    </head>
    <body>
        <p align="center">
            <font size="6">
            <u>Welcome <?php echo $_SESSION['b35d1ea7a896f20de51e7ab5038ed614_opfname']; ?></u>,
            </font><a href="?logout='1'"> Logout</a>
        </p>
         <form method="POST" action="" style="padding: 5%; margin: 5%;">
         <label>Amount: </label>
         <input type="text" name="amt" placeholder="Amount" class="w3-input"><br>
         <input type="submit" value="Submit" name="submit">
         </form>
    </body>
</html>