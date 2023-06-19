<?php
$selectedOption = $_GET['option'];

$connection = mysqli_connect('localhost', 'root', '', 'test');

$query = "SELECT * FROM patient WHERE name = '$selectedOption'";
$result = mysqli_query($connection, $query);

$options = '';
while ($row = mysqli_fetch_assoc($result)) {
  $options .= '<div class="itemX"> <strong>Doctor Name: </strong>'
  .$row['dname'].'<br>Email: '.$row['email'].'<br><br>
  <a href="doctor.php?did=' . $row['phone'] . '" target="_blank">Know More</a><br><br>
 <a href="book_app_step2.php?did=' . $row['did'] . '&spec='.$selectedOption.'&name='.$row['dname'].'" target="_blank"><div class="but">Book Now</div></a>
  </div>';

}

mysqli_close($connection);

echo $options;
?>