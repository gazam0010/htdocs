<?php include ('afterlogin.php') ?>
<?php
$pp = $_SESSION['previous_page'];
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
<style>
h10 { 
  display: block;
  font-size: 1.2em;
  margin-top: -0.9em;
  margin-bottom: 0em;
  margin-left: 0em;
  margin-right: 0em;
}
h11 { 
  display: block;
  font-size: 1.2em;
  margin-top: -0.8em;
  margin-bottom: -0.6em;
  margin-left: 2em;
  margin-right: 10em;
}
h12 { 
  display: block;
  font-size: 1.05em;
  margin-top: -0.8em;
  margin-bottom: -0.6em;
  margin-left: 6em;
  margin-right: 10em;
}
h13 { 
  display: block;
  font-size: 1em;
  margin-top: 0em;
  margin-bottom: 0em;
  margin-left: 6em;
  margin-right: 8em;
}
</style>
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
    <div class="bordr">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href=<?php echo $pp; ?>><img src = "/MySite/img/back-button.png" width = "42.5" height="37.5" /></a>
    <h2> Hello, <strong><?php echo $_SESSION['a3da707b651c79ecc39a4986516180b2_fname']; ?></strong></h2><br><br>
    <br><br><p><u>Other Donations History</u></p><br><br>   

    
   

      <?php
    $sno=0;
    $id = $_SESSION['b80bb7740288fda1f201890375a60c8f_id'];
    $query="SELECT * FROM donate_else WHERE id='$id' GROUP BY date";
    $result=mysqli_query($db, $query);
    if ($result->num_rows > 0) {
    // output data of each row
         echo '<hr>';
    while($row = $result->fetch_assoc()) {
        $sno += 1;
        $ord_date = date('d-m-yy', $row['date']);
        $exp_date = $row['date'] + (7 * 24 * 60 * 60);
        $exp = date('d-m-yy', $exp_date);
        $od_id = $row['od_id'];
        $add1 = $row['add1'];
        $add2 = $row['add2'];
        $dist = $row['dist'];
        $pin = $row['pin'];
        $itype = $row['item_type'];
        $iquan = $row['item_quan'];
        $status = $row['status'];
        
        echo '<h10>'.$sno.'.</h10>';
        echo '<br>';
        echo  '<h11>Order #<strong>'.$od_id.'</strong></h11>';
        echo '<br><br>';
        
        echo '<h12>';
        echo '<table>';
        echo '<tr>';
        if($status != 'Cancelled'){
        echo '<td>Order Date: <strong>'.$ord_date.'</strong></td>';
        echo '<td></td>';
        echo '<td>Item Type: <strong>'.$itype.'</strong></td>';
        echo '<td></td>';
        echo '<td><u><strong><h align = "center">Address</h></strong></u></td>';
        echo '<td></td>';
         }
        echo '<td><u>Order Status</u></td>';
        echo '</tr>';
    
        
      
        echo '<tr>';
        if($status != 'Cancelled'){
        echo '<td>Expected pick up date: <strong>'.$exp.'</strong></td>';
        echo '<td></td>';
        echo '<td>Item Quantity: <strong>'.$iquan.'</strong></td>';
        echo '<td></td>';
        echo '<td>'.$add1.', '.$add2.'<br> Dist.: '.$dist.'<br>Pin: '.$pin.'</td>';
        echo '<td></td>';
    
                   }
        echo '<td><strong>'.$status.'</strong></td>';
        if($status != 'Cancelled'){
        echo '<td><form action="" method="post"><input type="hidden" value="'.$od_id.'" name="od_id"><input type="submit" value="Cancel Order" name="don_can"></form></td>';
        }
        echo '</tr>';
        echo '</table>';
        echo '</h12>';
        
        echo '<hr>';
        }                 
    }
    else
    {
        echo "<h5>No donation to display. <a href='donate_after.php'>Start giving some donation</a></h5>";
    }
    ?>
  <br><br>
</div>
</body>
<?php
include ("footer.html");
?>
</html>
     
    
    