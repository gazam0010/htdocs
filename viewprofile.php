<?php
session_start();
$db1 = mysqli_connect('localhost', 'root', '', 'site');

// Storing Session
// SQL Query To Fetch Complete Information Of User


//Query for view user_info
$query = "SELECT * FROM versions";
$data  = mysqli_query($db1,$query);

  while ($row = mysqli_fetch_array($data)) {
    $name = $row['version'];
  echo $name;
  }


$sql = "SELECT * FROM hits";
$data = mysqli_query($db1,$sql);

  while ($row = mysqli_fetch_array($data)) {
    ?>
      <table border="solid 1px" width="100%">


<td width="25%" bgcolor="white" align="left" >


     <?php

    $id = $row["nos"];


    echo "<table>
         
        <tr><td>Product Name</td><td> : </td><td>$id</td></tr>
        
        
    </table>
    ";
?>
 </td>
  <td width="20%" ></td>
  </table><hr width="600px" />
  <?php
}
?>
