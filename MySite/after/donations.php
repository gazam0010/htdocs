<?php include ('afterlogin.php') ?>
<?php
$pp = $_SESSION['previous_page'];
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
<!DOCTYPE html>
<html>
<head>
    <title>Donation History</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
.bordr{
  border: 2px solid gray;
  padding: 10px;
  width: 100%;
}

h1 {
  text-align: center;
  text-transform: uppercase;
  color: #06554B;
}
h2 {
  text-align: center;
  font-size: 25px; 
  color: black;
}
h3 {
  padding: 10px;
  text-align: center;
  font-size: 20px; 
  color: black;
}
h5 {
  padding: 10px;
  text-align: center;
  font-size: 15px; 
  color: black;
}


p {
  text-indent: 530px;
  letter-spacing: 3px;
  font-size: 20px;
}

a {
  text-decoration: none;
  color: #008CBA;
}
</style>
<style>
.popups {
    display: inline-block;
}
.popups .popupstext {
    visibility: hidden;
    width: 16px;
    background-color: #b1b1b1;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 7px;
    position:relative;
    top:-36px;
    right:-62px;
}
.popups .sshow {
    visibility: visible;
    -webkit-animation: fadeIn 1s;
    animation: fadeIn 1s;
}
</style>
<style>
    table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}
tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<!--Footer Code-->
<style>
    .footer-foo {
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: #2b2b2b;
   color: whitesmoke;
   text-align: center;
}
</style>
<!--End of footer Code--> 
</head>
<body>
    <div class="bordr">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href=<?php echo $pp; ?>><img src = "/MySite/img/back-button.png" width = "42.5" height="37.5" /></a>
    <h2> Hello, <strong><?php echo $_SESSION['a3da707b651c79ecc39a4986516180b2_fname']; ?></strong></h2><br><br>
    <br><br><p><u>Donations History</u></p><br><br>   

    
    <table>
  <tr>
    <th><u>S.No.</u></th>
    <th><u>Txn ID</u></th>
    <th><u>Date & Time</u></th> 
    <th><u>Payment Mode</u></th> 
    <th><u>Amount (INR)</u></th>
  </tr>
   
      <?php
    $sno=0;
    $id = $_SESSION['b80bb7740288fda1f201890375a60c8f_id'];
    $query="SELECT * FROM donate_mo WHERE id='$id' GROUP BY date DESC";
    $result=mysqli_query($db, $query);
    if ($result->num_rows > 0) {
    // output data of each row
         
    while($row = $result->fetch_assoc()) {
        $sno += 1;
        $date = date('d-m-yy G:i:s', $row['date']);
       
        if ($row['mode'] == 'CC')
        {
            $mode = 'Credit Card';
        }
        if ($row['mode'] == 'DC')
        {
            $mode = 'Debit Card';
        }
        if ($row['mode'] == 'UPI')
        {
            $mode = 'Unified Payment Interface';
        }
        if ($row['mode'] == 'WA')
        {
            $mode = 'Wallet';
        }
        $txn = $row['txn_id'];
        $amount = $row['amount'];
        
        echo "<tr>";
        echo "<td> ".$sno."</td>";
        echo "<td> ".$txn." </td>";
        echo "<td> ".$date." </td>";
        echo "<td> ".$mode." </td>";
        echo "<td> ".$amount."</td>";
        echo "</tr>";
          
            
        }                           
    echo "</table>";

    }
      else
    {
        echo "<h5>No donation to display. <a href='donate_after.php'>Start giving some donation</a></h5>";
          echo "</table>";
    }
    ?>
  <br><br>
</div>
</body>
<?php
include ("footer.php");
?>
</html>
     
    
    