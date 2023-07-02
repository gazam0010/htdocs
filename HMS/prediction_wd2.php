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

        input[type="submit"],
        input[type="button"] {
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
            background-color: orangered;
        }

        .negative {
            background-color: #2ecc71;
        }
        .suspicious {
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

        .hidden {
            display: none;
        }

        /* Custom dropdown styles */
        .custom-dropdown {
            position: relative;
            display: inline-block;
        }

        .custom-dropdown select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-color: #fff;
            color: #333;
            padding: 8px;
            border-radius: 3px;
            border: 1px solid #ccc;
            cursor: pointer;
            padding-right: 24px;
            /* Add padding for arrow */
        }

        .custom-dropdown select::-ms-expand {
            display: none;
        }

        .custom-dropdown::after {
            content: '\25BC';
            position: absolute;
            top: 50%;
            right: 8px;
            /* Adjust this value as needed */
            transform: translateY(-50%);
            pointer-events: none;
        }

        /* Custom dropdown styles - hover */
        .custom-dropdown:hover select {
            border-color: #888;
        }

        /* Custom dropdown styles - focus */
        .custom-dropdown select:focus {
            outline: none;
            border-color: #555;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        /* Custom dropdown option styles */
        .custom-dropdown select option {
            font-size: 14px;
            /* Adjust the font size as needed */
            padding: 8px;
            /* Add padding to the options */
        }

        .back-button {
            margin-top: 20px;
        }

        .back-button button {
            background-color: #ddd;
            color: #333;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }

        .back-button button:hover {
            background-color: #ccc;
        }
    </style>
</head>

<body>
    <h1>Diabetes Prediction</h1>

    <?php
  if (isset($_POST['predict'])) {
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $urea = $_POST['urea'];
    $cr = $_POST['cr'];
    $hba1c = $_POST['hba1c'];
    $chol = $_POST['chol'];
    $tg = $_POST['tg'];
    $hdl = $_POST['hdl'];
    $ldl = $_POST['ldl'];
    $vldl = $_POST['vldl'];
    $bmi = $_POST['bmi'];

    // Execute the Python script and pass the user input as command-line arguments
    $command = escapeshellcmd("python diabetes_prediction.py --gender $gender --age $age --urea $urea --cr $cr --hba1c $hba1c --chol $chol --tg $tg --hdl $hdl --ldl $ldl --vldl $vldl --bmi $bmi");
    $output = shell_exec($command);

    if ($output == 0) {
      echo '<div class="result negative">';
      echo "The person is predicted to be diabetes-free.";
      echo '</div>';
    } elseif ($output == 1) {
      echo '<div class="result suspicious">';
      echo "The person is predicted to be in a pre-diabetic state.";
      echo '</div>';
    } elseif ($output == 2) {
      echo '<div class="result positive">';
      echo "The person is predicted to have diabetes.";
      echo '</div>';
    }
  }
  ?>

    <form action="" method="post" class="animate__animated animate__fadeIn">
        <div class="step1">
            <label for="gender">Gender:</label>
            <div class="custom-dropdown">
                <select id="gender" name="gender" required>
                    <option value="0">Female</option>
                    <option value="1">Male</option>
                </select>
            </div><br>

            <label for="age">Age:</label>
            <input type="text" id="age" name="age" required><br>

            <label for="urea">Urea:</label>
            <input type="text" id="urea" name="urea" required><br>

            <label for="cr">Cr:</label>
            <input type="text" id="cr" name="cr" required><br>

            <label for="hba1c">HbA1c:</label>
            <input type="text" id="hba1c" name="hba1c" required><br>
            <br>
            <input type="button" value="Next" onclick="showStep2()">
        </div>

        <div class="step2 hidden">
            <label for="chol">Chol:</label>
            <input type="text" id="chol" name="chol" required><br>

            <label for="tg">TG:</label>
            <input type="text" id="tg" name="tg" required><br>

            <label for="hdl">HDL:</label>
            <input type="text" id="hdl" name="hdl" required><br>

            <label for="ldl">LDL:</label>
            <input type="text" id="ldl" name="ldl" required><br>

            <label for="vldl">VLDL:</label>
            <input type="text" id="vldl" name="vldl" required><br>

            <label for="bmi">BMI:</label>
            <input type="text" id="bmi" name="bmi" required><br>
            <br>
            <input type="submit" name="predict" value="Predict">
        </div>
    </form>

    <div class="info-container">
        This prediction is based on a machine learning model trained using data provided by Rashid, Ahlam (2020),
        “Diabetes Dataset”, Mendeley Data, V1, doi: 10.17632/wj9rwkp9c2.1.<br>
        This model has achieved an accuracy rate of approximately 99%.
        <hr>
        Coded, Trained and Developed by Freak Azam
    </div>

    <script>
        function goBack() {
            document.getElementById('step1-form').style.display = 'block';
            document.getElementById('step2-form').style.display = 'none';
        }
        function showStep2() {
            document.querySelector('.step1').classList.add('hidden');
            document.querySelector('.step2').classList.remove('hidden');
        }
    </script>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.js"></script>


</html>