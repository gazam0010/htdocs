<!DOCTYPE html>
<html>

<head>
  <title>Diabetes Prediction</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }

    h1 {
      color: #333;
      text-align: center;
      margin-top: 50px;
    }

    form {
      max-width: 400px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      animation: fade-in 1s ease;
      border-radius: 10px;
    }

    @keyframes fade-in {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    label {
      display: block;
      margin-bottom: 10px;
    }

    input[type="text"] {
      width: 90%;
      padding: 8px;
      border-radius: 3px;
      border: 1px solid #ccc;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      padding: 10px 15px;
      border: none;
      border-radius: 3px;
      cursor: pointer;
      font-size: 16px;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    p {
      margin-top: 20px;
      text-align: center;
      font-size: 18px;
    }

    .result {
      color: #fff;
      padding: 10px;
      text-align: center;
      margin-top: 20px;
      border-radius: 5px;
    }

    .positive {
      background-color: #2ecc71;
    }

    .negative {
      background-color: orange;
    }

    .info-container {
      background-color: #f2f2f2;
      color: #888;
      padding: 20px;
      border-radius: 5px;
      margin-top: 30px;
      text-align: center;
      font-size: 14px;
    }
  </style>
</head>

<body>
  <h1>Diabetes Prediction</h1>

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
    $command = escapeshellcmd("python diabetes_prediction_temp.py --pregnancies $pregnancies --glucose $glucose --blood_pressure $blood_pressure --skin_thickness $skin_thickness --insulin $insulin --bmi $bmi --diabetes_pedigree $diabetes_pedigree --age $age");
    $output = shell_exec($command);

    if ($output == 1) {
      echo '<div class="result negative">';
      echo "The person is predicted to have diabetes.";
      echo '</div>';
    } else {
      echo '<div class="result positive">';
      echo "The person is predicted to be diabetes-free.";
      echo '</div>';
    }
  }
  ?>

  <form action="" method="post" class="animate__animated animate__fadeIn">
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
    <br>
    <input type="submit" name="predict" value="Predict">
  </form>

  <div class="info-container">
    <p>This prediction is based on a machine learning model trained using data provided by the National Institute of
      Diabetes and Digestive and Kidney Diseases (NIDDK), USA. The model has achieved an accuracy rate of approximately
      80.58%.<br>Trained, Coded and Developed by Freak Azam</p>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.js"></script>
</body>

</html>