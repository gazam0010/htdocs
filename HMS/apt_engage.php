<?php
if (isset($_GET['aid'])) {
    $aid = $_GET['aid'];
} else {
    header("location: dr_apt.php");
    exit();
}


//fetching appointment details from apt , patients and vitals table.
$db1 = mysqli_connect("localhost", "root", "", "test");
$resultAptEng = mysqli_query($db1, "SELECT * FROM appointments app JOIN patient p ON app.pid = p.pid JOIN vitals v ON app.aid = v.aid WHERE app.aid = $aid");
$row = mysqli_fetch_assoc($resultAptEng);

//updating other_actions status
if (isset($_POST['other_action'])) {
    $other_action = $_POST['other_action'];
    $updateStatus = mysqli_query($db1, "UPDATE appointments SET status = '$other_action' WHERE aid = $aid");
    if ($updateStatus) {
        header("location: apt_engage.php?aid=" . urlencode($aid) . "&updateStatus=" . urlencode("Status updated: $other_action"));
        exit();
    } else {
        header("location: apt_engage.php?aid=$aid&updateStatus=Some error occured");
        exit();
    }
}

//completing apt status
if (isset($_POST['complete_apt'])) {
    $comment = $_POST['comment'];
    $updateStatus = mysqli_query($db1, "UPDATE appointments SET status = 'COMPLETED', comm = '$comment' WHERE aid = $aid");
    if ($updateStatus) {
        header("location: apt_engage.php?aid=" . urlencode($aid) . "&updateStatus=" . urlencode("Status update: Appointment Completed"));
    } else {
        header("location: apt_engage.php?aid=$aid&updateStatus=Some error occured");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            animation: slide-in 0.5s ease-out;
        }

        @keyframes slide-in {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            position: relative;
            font-size: 32px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            padding-bottom: 10px;
            animation: underline-anim 1s ease-in-out infinite;
        }

        @keyframes underline-anim {

            0%,
            100% {
                width: 60px;
            }

            50% {
                width: 80px;
            }
        }

        h1::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background-color: #333;
            border-radius: 2px;
            opacity: 0.6;
            transition: width 0.5s ease-in-out;
        }

        .back-button {
            display: flex;
            justify-content: right;
            align-items: right;
            padding: 10px;
            background-color: #f7f7f7;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .back-button a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            text-transform: uppercase;
            transition: color 0.3s ease-in-out;
        }

        .back-button a:hover {
            color: #888;
        }

        .box {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            margin-bottom: 20px;
            transition: transform 0.5s ease-in-out;
        }

        .box:hover {
            transform: scale(1.02);
        }

        .main-data {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f7f7f7;
            padding: 10px 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .patient-name {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-right: 10px;
        }

        .appointment-date {
            font-size: 18px;
            color: #333;
            text-align: right;
        }

        .appointment-id,
        .booking-date,
        .description,
        .current-status {
            margin-bottom: 10px;
            transition: opacity 0.3s ease-in-out;
        }

        .appointment-id span,
        .booking-date span,
        .description span,
        .current-status span {
            font-weight: bold;
        }

        .vital-info {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 18px;
            text-transform: uppercase;
            color: #333;
            transition: color 0.3s ease-in-out;
        }

        .vital-info-box {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .vital-info-label {
            color: #888;
            font-size: 16px;
        }

        .vital-info-value {
            font-weight: bold;
            font-size: 16px;
        }

        .action-box {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .action-button {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .action-button:hover {
            background-color: #555;
        }

        .primary-action {
            background-color: #007bff;
        }

        .primary-action:hover {
            background-color: #0056b3;
        }

        .comment-box {
            width: 100%;
            max-width: 400px;
            height: 100px;
            padding: 10px;
            border: 1px solid #888;
            border-radius: 5px;
            resize: vertical;
            margin-bottom: 20px;
        }

        .submit-button {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .submit-button:hover {
            background-color: #555;
        }

        .popup {
            position: fixed;
            top: 100px;
            right: -80px;
            transform: translate(-50%, -50%);
            background-color: lightgreen;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            opacity: 1;
            transition: opacity 0.5s;
            z-index: 9999; /* Add a higher z-index value */
        }
    </style>
    <script>
        function confirmAction(action) {
            return confirm(`Are you sure you want to ${action.toLowerCase()} the appointment?`);
        }
        function confirmSubmit() {
            return confirm("By clicking submit, the appointment will end. Are you sure you want to submit?");
        }
        // Fade out the popup after 5 seconds
        setTimeout(function () {
            var popupContainer = document.getElementById('popup-container');
            popupContainer.style.opacity = '0';
        }, 5000);

    </script>
</head>

<body>
<div class="popup" id="popup-container">
        <?php
        if (isset($_GET['updateStatus']) && isset($_GET['aid'])) {
            $message = $_GET['updateStatus'];
            echo "<p>$message</p>";
        }
        ?>
    </div>
    <div class="container">
        <div class="back-button">
            <a href="dr_apt.php">&lt; Back</a>
        </div>

        <h1>Appointment Details</h1>

        <div class="main-data">
            <div class="patient-name">Patient Name: <span id="patient-name">
                    <?php echo $row['pname']; ?>
                </span></div>
            <div class="appointment-date">Appointment Date Time: <span id="appointment-date">
                    <?php echo $row['apt_date_time']; ?>
                </span></div>
        </div>

        <div class="box">

            <div class="appointment-id">Appointment ID: <span id="appointment-id">
                    <?php echo $aid; ?>
                </span></div>
            <div class="booking-date">Booking Date: <span id="booking-date">
                    <?php echo $row['book_date']; ?>
                </span></div>
            <div class="description">Description: <span id="description">
                    <?php echo $row['description']; ?>
                </span></div>
            <div class="current-status">Current Status: <span id="current-status">
                    <?php echo $row['status']; ?>
                </span></div>
        </div>

        <div class="box">
            <div class="vital-info">Vital Information</div>
            <div class="vital-info-box">
                <span class="vital-info-label">Blood Pressure:</span>
                <span class="vital-info-value">
                    <?php echo $row['bp']; ?> mmHg
                </span>
            </div>
            <div class="vital-info-box">
                <span class="vital-info-label">Glucose Level:</span>
                <span class="vital-info-value">
                    <?php echo $row['glucose']; ?> mg/dL
                </span>
            </div>
            <div class="vital-info-box">
                <span class="vital-info-label">Pulse Rate:</span>
                <span class="vital-info-value">
                    <?php echo $row['pulse']; ?> bpm
                </span>
            </div>
            <div class="vital-info-box">
                <span class="vital-info-label">BMI:</span>
                <span class="vital-info-value">
                    <?php echo $row['bmi']; ?>
                </span>
            </div>
        </div>

        <div class="action-box">
            <?php if ($row['status'] != 'COMPLETED' && $row['status'] != 'CLOSED'): ?>
                <div class="action-buttons">
                    <?php if ($row['status'] != 'ONGOING'): ?>
                        <button class="action-button primary-action"
                            onclick="if(confirmAction('Start')){location.href='start_appointment.php';}">Start
                            Appointment</button>
                    <?php endif ?>
                    <?php if ($row['status'] != 'CLOSE'): ?>
                        <form method="POST" action="">
                            <button class="action-button" onclick="if(confirmAction('Close'))" type="submit" name="other_action"
                                value="CLOSED">Close</button>
                        </form>
                    <?php endif ?>
                    <?php if ($row['status'] != 'HOLD'): ?>
                        <form method="POST" action="">
                            <button class="action-button" onclick="if(confirmAction('Hold'))" type="submit" name="other_action"
                                value="HOLD">Hold</button>
                        </form>
                    <?php endif ?>
                </div>
                <form method="POST" action="">
                <textarea name = "comment" class="comment-box" placeholder="Add a comment..."></textarea><br>
                <button type="submit" name="complete_apt" class="submit-button" onclick="return confirmSubmit();">Submit</button>
                </form>
            <?php endif ?>
        </div>
    </div>
</body>

</html>
<?php
mysqli_close($db1);
?>