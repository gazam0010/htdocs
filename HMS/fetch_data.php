<?php
$selectedOption = $_GET['option'];

$connection = mysqli_connect('localhost', 'root', '', 'test');

$query = "SELECT * FROM doctorprofile WHERE dspecialization = '$selectedOption'";
$result = mysqli_query($connection, $query);

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

mysqli_close($connection);

echo $options;
?>