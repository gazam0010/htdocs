<?php

$db = mysqli_connect('localhost', 'root', '', 'site');

$query = 'SELECT * FROM system_gate';
$result = mysqli_query($db,$query);
$row = mysqli_fetch_assoc($result);
$gate_status = $row['gate_status'];

if($gate_status == 0) {
    header('location: http://localhost/MySite/gate_closed.php');
    exit();
}
if($gate_status == 1) {
    header('location: http://localhost/MySite/gate_closed_construction.php');
    exit();
  }

?>
