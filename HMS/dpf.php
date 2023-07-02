<!DOCTYPE html>
<html>
<head>
  <title>Diabetes Pedigree Function Calculator</title>
</head>
<body>
  <h1>Diabetes Pedigree Function Calculator</h1>
  
  <form action="" method="post">
    <label for="age">Age:</label>
    <input type="text" id="age" name="age" required><br>
    
    <label for="relationship">Relationship (parent, sibling, child):</label>
    <input type="text" id="relationship" name="relationship" required><br>
    
    <label for="ageAtDiagnosis">Age at Diagnosis:</label>
    <input type="text" id="ageAtDiagnosis" name="ageAtDiagnosis" required><br>
    
    <input type="submit" name="dpf" value="Calculate DPF">
  </form>
</body>
</html>

<?php
if (isset($_POST['dpf'])){
function calculateDiabetesPedigreeFunction($age, $relationship, $ageAtDiagnosis) {
  $weights = array(
    "parent" => 1.5,
    "sibling" => 1.0,
    "child" => 0.5
  );

  $dpf = 0;

  if (isset($weights[$relationship])) {
    $weight = $weights[$relationship];
    $dpf += $weight * ($ageAtDiagnosis / 100);
  }

  return $dpf;
}

// Get user input from the $_POST superglobal array

  $age = $_POST["age"];
  $relationship = $_POST["relationship"];
  $ageAtDiagnosis = $_POST["ageAtDiagnosis"];


// Calculate DPF
$dpf = calculateDiabetesPedigreeFunction($age, $relationship, $ageAtDiagnosis);
echo '<p>Diabetes Pedigree Function: '.$dpf.'</p>';
}
?>



