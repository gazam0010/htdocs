<?php
if (isset($_POST['predict'])) {
    $pregnancies = $_POST['pregnancies'];
    $glucose = $_POST['glucose'];
    $blood_pressure = $_POST['blood_pressure'];
    $skin_thickness = $_POST['skin_thickness'];
    $insulin = $_POST['insulin'];
    $bmi = $_POST['bmi'];
    $diabetes_pedigree = $_POST['diabetes_pedigree'];
    $age = $_POST['age'];

    // Execute the Python script and pass the user input as command-line arguments
    $command = escapeshellcmd("python diabetes_prediction.py $pregnancies $glucose $blood_pressure $skin_thickness $insulin $bmi $diabetes_pedigree $age");
    $output = shell_exec($command);

    if ($output == 1) {
        echo "<p>The person is predicted to have diabetes.</p>";
    } else {
        echo "<p>The person is predicted to be diabetes-free.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Diabetes Prediction</title>
</head>
<body>
  <h1>Diabetes Prediction</h1>
  
  <form action="" method="post">
    <label for="pregnancies">Number of Pregnancies:</label>
    <input type="text" id="pregnancies" name="pregnancies" required><br>
    
    <label for="glucose">Glucose Level:</label>
    <input type="text" id="glucose" name="glucose" required><br>
    
    <label for="blood_pressure">Blood Pressure:</label>
    <input type="text" id="blood_pressure" name="blood_pressure" required><br>
    
    <label for="skin_thickness">Skin Thickness:</label>
    <input type="text" id="skin_thickness" name="skin_thickness" required><br>
    
    <label for="insulin">Insulin Level:</label>
    <input type="text" id="insulin" name="insulin" required><br>
    
    <label for="bmi">BMI:</label>
    <input type="text" id="bmi" name="bmi" required><br>
    
    <label for="diabetes_pedigree">Diabetes Pedigree Function:</label>
    <input type="text" id="diabetes_pedigree" name="diabetes_pedigree" required><br>
    
    <label for="age">Age:</label>
    <input type="text" id="age" name="age" required><br>
    
    <input type="submit" name="predict" value="Predict">
  </form>
</body>
</html>

