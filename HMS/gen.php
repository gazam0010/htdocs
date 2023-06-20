<?php

// Generate synthetic data for diagnosing diabetes using a normal distribution
function generateDiabetesData($numSamples)
{
    $data = [];

    for ($i = 0; $i < $numSamples; $i++) {
        $glucoseMean = 110; // Mean glucose level
        $glucoseStdDev = 10; // Standard deviation of glucose
        $glucose = round(normalDistribution($glucoseMean, $glucoseStdDev)); // Generate glucose level

        $bmiMean = 28; // Mean BMI
        $bmiStdDev = 5; // Standard deviation of BMI
        $bmi = round(normalDistribution($bmiMean, $bmiStdDev)); // Generate BMI

        $ageMean = 45; // Mean age
        $ageStdDev = 10; // Standard deviation of age
        $age = round(normalDistribution($ageMean, $ageStdDev)); // Generate age

        $bloodPressureMean = 120; // Mean blood pressure
        $bloodPressureStdDev = 10; // Standard deviation of blood pressure
        $bloodPressure = round(normalDistribution($bloodPressureMean, $bloodPressureStdDev)); // Generate blood pressure

        $geneticHistory = mt_rand(0, 1); // 0: No genetic history, 1: Has genetic history

        $diabetesRisk = 0;

        // Determine diabetes risk based on various parameters
        if (($glucose > 140 || $bmi > 30 || $age > 40 || $bloodPressure > 140) && mt_rand(1, 100) <= 30) {
            $diabetesRisk = 0.3; // Moderate chance (30%) of getting diabetes
        }

        // Consider genetic history as a factor for diabetes risk
        if ($geneticHistory && mt_rand(1, 100) <= 20) {
            $diabetesRisk = 0.6; // Higher chance (60%) of getting diabetes due to genetic history
        }

        // Increase diabetes risk to 1 (100%) if conditions are met
        if ($glucose > 180 && $bmi > 35 && $age > 50 && $bloodPressure > 150) {
            $diabetesRisk = 1; // 100% chance of getting diabetes
        }

        // Create a data point
        $dataPoint = [
            'glucose' => $glucose,
            'bmi' => $bmi,
            'age' => $age,
            'bloodPressure' => $bloodPressure,
            'geneticHistory' => $geneticHistory,
            'diabetesRisk' => $diabetesRisk,
        ];

        // Add the data point to the dataset
        $data[] = $dataPoint;
    }

    return $data;
}

// Function to generate random numbers following a normal distribution
function normalDistribution($mean, $stdDev)
{
    $x = mt_rand() / mt_getrandmax();
    $y = mt_rand() / mt_getrandmax();
    $z = sqrt(-2 * log($x)) * cos(2 * pi() * $y);
    return $mean + $stdDev * $z;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the number of data points from the form
    $numDataPoints = $_POST['numDataPoints'];

    // Generate synthetic diabetes data
    $syntheticData = generateDiabetesData($numDataPoints);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Synthetic Diabetes Data Generator</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Synthetic Diabetes Data Generator</h2>

    <form method="POST" action="">
        <label for="numDataPoints">Number of Data Points:</label>
        <input type="number" name="numDataPoints" id="numDataPoints" required>
        <button type="submit">Generate Data</button>
    </form>

    <?php if (isset($syntheticData) && !empty($syntheticData)) : ?>
        <h2>Generated Synthetic Data</h2>

        <table>
            <tr>
                <th>Glucose</th>
                <th>BMI</th>
                <th>Age</th>
                <th>Blood Pressure</th>
                <th>Genetic History</th>
                <th>Diabetes Risk</th>
            </tr>

            <?php foreach ($syntheticData as $dataPoint) : ?>
                <tr>
                    <td><?php echo $dataPoint['glucose']; ?></td>
                    <td><?php echo $dataPoint['bmi']; ?></td>
                    <td><?php echo $dataPoint['age']; ?></td>
                    <td><?php echo $dataPoint['bloodPressure']; ?></td>
                    <td><?php echo $dataPoint['geneticHistory'] ? 'Yes' : 'No'; ?></td>
                    <td><?php echo $dataPoint['diabetesRisk'] * 100 . '%'; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>
