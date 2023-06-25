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
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .appointment-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 20px;
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
        }

        .status-style {
            max-width: 600px;
            margin: 0 auto;
            /* Updated to center align horizontally */
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
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
        header('location: aa.php');
        exit();
    }

    if (isset($_POST['delete_apt'])) {
        $aid = $_POST['aid'];
        $result = mysqli_query($db1, "UPDATE appointments SET status = 'CLOSED' WHERE aid = '$aid'");
        if ($result) {
            header("location: aa.php?return-msg=Appointment Successfully Deleted!");
        } else {
            header("location: aa.php?return-msg=Error Occurred");
        }
        mysqli_close($db1);
    }

    $aid = $_POST['aid'];
    $resultApt = mysqli_query($db1, "SELECT * FROM appointments app JOIN doctorprofile dr ON app.did = dr.did JOIN vitals v ON app.aid = v.aid WHERE app.aid = $aid");

    $row = mysqli_fetch_assoc($resultApt);
    ?>

    <div class="container">
        <?php
        $status = $row['status'];
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
        <span class="status-style"><strong>Current Appointment Status:</strong> <span style="color: <?php echo $stat_clr; ?>;"><?php echo $status; ?></span></span>
        <br>

        <div class="buttons">
            <?php if ($status == 'ONGOING'): ?>
                <div id="contentContainer" style="text-align: center;">
                    <!-- FETCHED LINK HERE -->
                </div>
            <?php endif; ?>
            <?php if ($status == 'OPEN'): ?>
                <form method="post" onsubmit="return onSubmit()" action="">
                    <input type="hidden" name="aid" value="<?php echo $row['aid']; ?>">
                    <button type="submit" name="delete_apt">Cancel Appointment</button>
                </form>
            <?php endif; ?>
            <?php if ($status == 'COMPLETED'): ?>
                <div class="comment">
                    <strong>Comment by the Doctor:</strong>
                    <?php echo $row['comm']; ?>
                </div>
            <?php endif ?>
        </div>
        <br>

        <hr>

        <div class="header">
            <h1>Appointment Details</h1>
            <br>
        </div>
        <div class="appointment-details">
            <p><strong>Appointment ID:</strong></p>
            <p><?php echo $row['aid']; ?></p>
            <p><strong>Doctor Name:</strong></p>
            <p><?php echo $row['dname']; ?></p>
            <p><strong>Doctor ID:</strong></p>
            <p><?php echo $row['did']; ?></p>
            <p><strong>Specialization:</strong></p>
            <p><?php echo $row['dspecialization']; ?></p>
            <p><strong>Booking Date:</strong></p>
            <p><?php echo $row['book_date']; ?></p>
            <p><strong>Appointment Date Time:</strong></p>
            <p><?php echo $row['apt_date_time']; ?></p>
            <p><strong>Description:</strong></p>
            <p><?php echo $row['description']; ?></p>
        </div>
        <div class="vitals">
            <h3><strong><u>Vitals</u></strong></h3>
            <p><strong>BP:</strong> <?php echo $row['bp']; ?> mmHg</p>
            <p><strong>Pulse:</strong> <?php echo $row['pulse']; ?> bps</p>
            <p><strong>Glucose:</strong> <?php echo $row['glucose']; ?> mg/dL</p>
            <p><strong>BMI:</strong> <?php echo $row['bmi']; ?></p>
        </div>

        <hr>

        <p class="note">*If Start Appointment is not showing, it means the doctor has not started the video call yet!</p>
    </div>

    <script>
        function startAppointment(aid) {
            // Placeholder for your logic to start the appointment
            console.log("Start Appointment ID: " + aid);
        }

        function onSubmit() {
            return confirm("Do you really want to cancel your appointment?");
        }

        function refreshContent() {
            // Create an AJAX request
            var xhr = new XMLHttpRequest();

            var aid = "<?php echo $aid; ?>";
            xhr.open('GET', 'fetch_updated_status.php?aid=' + aid, true);

            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    // Update the content container with the fetched response
                    if (xhr.responseText !== '') {
                        document.getElementById('contentContainer').innerHTML = "<strong>Here's the link: </strong><br><br><a href=" + xhr.responseText + " target='_blank'><button>Start Appointment</button></a>";
                    } else {
                        document.getElementById('contentContainer').innerHTML = "Doctor has started the appointment, please wait...<br>(link will be updated here automatically)";
                    }
                }
            };

            xhr.send();
        }
        setInterval(refreshContent, 2000);
    </script>
</body>

</html>
