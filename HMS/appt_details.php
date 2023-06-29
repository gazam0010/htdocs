<!DOCTYPE html>
<html>

<head>
    <title>Appointment Details</title>
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 30px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            animation: fade-in 0.5s ease;
        }

        @keyframes fade-in {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            animation: slide-up 0.5s ease;
        }

        @keyframes slide-up {
            from {
                transform: translateY(20px);
            }

            to {
                transform: translateY(0);
            }
        }

        .appointment-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 20px;
            animation: slide-up 0.5s ease;
        }

        .appointment-details p {
            margin: 0;
            line-height: 1.5;
            font-size: 16px;
            color: #333;
        }

        .appointment-details p strong {
            color: #333;
        }

        .vitals {
            margin-top: 30px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
            animation: slide-up 0.5s ease;
        }

        .vitals p {
            display: inline-block;
            margin: 0;
            line-height: 1.5;
            font-size: 16px;
            width: 50%;
        }

        .buttons {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 30px;
            animation: slide-up 0.5s ease;
        }

        .buttons button {
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: #4d79ff;
            color: #fff;
        }

        .buttons button:hover {
            transform: scale(1.1);
            background-color: #3352b8;
        }

        .note {
            color: #999;
            text-align: center;
            font-size: 14px;
            margin-top: 30px;
            animation: slide-up 0.5s ease;
        }

        .status-style {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            animation: fade-in 0.5s ease;
        }

        .box {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            margin-bottom: 20px;
            transition: transform 0.5s ease-in-out;
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

        .comment {
            max-width: 600px;
            width: 50%;
            background-color: lightcyan;
            padding: 3px;
            border-radius: 3px;
            margin: 0 auto;
            margin-top: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 5px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <?php
    $db1 = mysqli_connect("localhost", "root", "", "test");
    if (!isset($_POST['aid'])) {
        header('Location: aa.php');
        exit();
    }

    if (isset($_POST['delete_apt'])) {
        $aid = $_POST['aid'];
        $result = mysqli_query($db1, "UPDATE appointments SET status = 'CLOSED' WHERE aid = '$aid'");
        if ($result) {
            header("Location: aa.php?return-msg=Appointment Successfully Deleted!");
        } else {
            header("Location: aa.php?return-msg=Error Occurred");
        }
        mysqli_close($db1);
    }

    //data posted from aa.php
    $aid = $_POST['aid'];
    $did = $_POST['did'];
    $pname = $_POST['pname'];
    $resultApt = mysqli_query($db1, "SELECT * FROM appointments app JOIN doctorprofile dr ON app.did = dr.did JOIN vitals v ON app.aid = v.aid WHERE app.aid = $aid");

    $row = mysqli_fetch_assoc($resultApt);
    ?>

    <div class="container">
        <?php
        $status = $row['status'];
        $stat_clr = '';
        if ($status == 'OPEN') {
            $stat_clr = 'orange';
        } elseif ($status == 'ONGOING') {
            $stat_clr = 'green';
        } elseif ($status == 'CLOSED') {
            $stat_clr = 'red';
        } elseif ($status == 'HOLD') {
            $stat_clr = 'darkyellow';
        } else {
            $stat_clr = 'darkgreen';
        }
        ?>
        <span class="status-style"><strong>Current Appointment Status:</strong> <span
                style="color: <?php echo $stat_clr; ?>;"><?php echo $status; ?></span></span>
        <br>

        <div class="buttons">
            <?php if ($status == 'In Progress' || $status == 'ONGOING' || $status == 'COMPLETED'): ?>
                <div id="contentContainer" style="text-align: center;">
                    <!-- FETCHED LINK HERE -->
                </div>
            <?php endif; ?>
            <?php if ($status == 'OPEN' || $status == 'HOLD'): ?>
                <form method="post" onsubmit="return onSubmit()" action="">
                    <input type="hidden" name="aid" value="<?php echo $row['aid']; ?>">
                    <button type="submit" name="delete_apt">Cancel Appointment</button>
                </form>
            <?php endif; ?>

        </div>
        <?php if ($status == 'COMPLETED'): ?>
            <div class="comment">
                <strong>Comment by the Doctor:</strong>
                <?php echo $row['comm']; ?>
            </div>
        <?php endif; ?>
        <br>

        <hr>

        <div class="header">
            <h1>Appointment Details</h1>
            <br>
        </div>
        <div class="appointment-details">
            <p><strong>Appointment ID:</strong></p>
            <p>
                <?php echo $row['aid']; ?>
            </p>
            <p><strong>Doctor Name:</strong></p>
            <p>
                <?php echo $row['dname']; ?>
            </p>
            <p><strong>Specialization:</strong></p>
            <p>
                <?php echo $row['dspecialization']; ?>
            </p>
            <p><strong>Booking Date:</strong></p>
            <p>
                <?php echo $row['book_date']; ?>
            </p>
            <p><strong>Appointment Date Time:</strong></p>
            <p>
                <?php echo $row['apt_date_time']; ?>
            </p>
            <p><strong>Description:</strong></p>
            <p>
                <?php echo $row['description']; ?>
            </p>
        </div>
        <br>
        <hr><br>
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

        <hr>

        <p class="note">*If Start Appointment is not showing, it means the doctor has not started the video call yet!
        </p>
    </div>

    <script>
        function startAppointment(aid) {
            // Placeholder for your logic to start the appointment
            console.log("Start Appointment ID: " + aid);
        }

        function onSubmit() {
            return confirm("Do you really want to cancel your appointment?");
        }

        //AJAX request with loading dot animation
        const animationFrames = ['⣷', '⣯', '⣟', '𝓯', '⢿', '⣻', '⣽', '⣾'];
        let animationIndex = 0;
        let loadingAnimation = '';
        let intervalID;

        function refreshContent() {
            var xhr = new XMLHttpRequest();
            var aid = "<?php echo $aid; ?>";
            xhr.open('GET', 'fetch_updated_status.php?aid=' + aid, true);

            function animateLoading() {
                if (xhr.responseText === '') {
                    loadingAnimation = `Doctor has started the appointment and the link will be updated here automatically<br>Please wait ${animationFrames[animationIndex]}`;
                    animationIndex = (animationIndex + 1) % animationFrames.length;
                }
                setTimeout(animateLoading, 150);
            }

            animateLoading();

            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    if (xhr.responseText !== '') {
                        document.getElementById('contentContainer').innerHTML = `<strong>Here's the link:</strong><br><br>
                        <form method="POST" action="chat_pat.php">
                        <input type="hidden" name="aid" value="<?php echo $aid; ?>">
                            <input type="hidden" name="recipient" value="<?php echo $row['dname'] ?>">
                            <input type="hidden" name="sender" value="<?php echo $pname ?>">
                        <input type="hidden" name="chatId" value="${xhr.responseText}">
                        <button type="submit" name="start_chat">Open Chat</button></a></form>`;
                        clearInterval(intervalID);
                    } else {
                        document.getElementById('contentContainer').innerHTML = loadingAnimation;
                    }
                }
            };

            xhr.send();
        }

        intervalID = setInterval(refreshContent, 1000);
    </script>
</body>

</html>