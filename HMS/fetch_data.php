<?php
$selectedOption = $_GET['option'];

$connection = mysqli_connect('localhost', 'root', '', 'test');

$query = "SELECT * FROM doctorprofile WHERE dspecialization = ?";
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, "s", $selectedOption);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$options = '';
while ($row = mysqli_fetch_assoc($result)) {
  $options .= '<div class="itemX"> <strong>Doctor Name: </strong>'
  .$row['dname'].'<br><strong>Email: </strong>'.$row['email'].'<br><strong>City: </strong>'.$row['city'].'<br><br>
  <a href="doctor.php?did=' . $row['did'] . '" target="_blank">Know More</a><br><br>
  
   
  <div class="radio-select">
  <label>
    <input type="radio" name="radio-option" value="'.$row['did'].'" required/>
    <div class="radio-button">Select</div>
  </label>
  </div>
  </div>';
}

mysqli_stmt_close($stmt);
mysqli_close($connection);

echo $options;
?>
