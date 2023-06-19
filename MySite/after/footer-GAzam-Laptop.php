<?php
$db = mysqli_connect('localhost', 'root', '', 'site');
$query = "SELECT * FROM hits";
$result = mysqli_query($db, $query);
$row = $result->fetch_assoc();
$nos = $row['nos'];
?>
<?php
$nos_new = $nos + 1;
$db = mysqli_connect('localhost', 'root', '', 'site');
$query = "UPDATE hits SET nos='$nos_new'";
mysqli_query($db, $query);
?>
<?php
$db = mysqli_connect('localhost', 'root', '', 'site');

$query = "SELECT version FROM versions ORDER BY version DESC LIMIT 1";
$result = mysqli_query($db, $query);  
 if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $ver = $row['version'];
  }
$curr_version = $ver;
?>
<!DOCTYPE html>
<html>
    <style>
        .right{
    float:right;
}

.left{
    float:left;
}
    </style>
    <style>
    .footer-foo {
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: #2b2b2b;
   color: whitesmoke;
   text-align: center;
   border: 1px;
   border-color: black;
}
</style>
<body>
   <!--Footer Starts-->
<div class="footer-foo">
    <br>
    <span class="left">
        <font size="3.5">&nbsp; - Encountered some error? <a href='enc_err.php'>Please let me know</a></font>
    </span>
    <span class="right">
        <font size="3.5">&nbsp; - Have some suggestions or feedback? <a href='enc_err.php'>Drop something here&nbsp;</a></font>
    </span>​
    <br><br>
    <h9><font size="3.5">Thanks for visiting my website.<br>
        Hope you are doing well.<br>
<br    Designed and Developed by <strong>Gulfarogh Azam</strong></font><br>18CAB105<br>GL0210</h9>
<br><br>
<p align="center">Website Version: <?php echo $curr_version; ?><a href="versions.php"> <br><font size="1.5px">Version Update Info</font></a></p>
<p align="right">Hits Counter: <?php echo $nos_new; ?>&nbsp;&nbsp;&nbsp;</p>
</div>
<!--Footer Ends-->
    </body>
</html>
