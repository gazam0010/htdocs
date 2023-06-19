<?php
session_start();
$curr_timestamp = time();
$newTime = $curr_timestamp + (1 * 60);
$_SESSION['EXPtime'] = $newTime;
header ('location: LODA.php');
?>
