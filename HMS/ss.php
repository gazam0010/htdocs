<!DOCTYPE html>
<html>
<head>
    <title>Appointment Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            position: relative;
        }

        h1::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            height: 2px;
            background: linear-gradient(to right, transparent, #333, transparent);
        }

        .appointment-details {
            margin-bottom: 30px;
        }

        .appointment-details p {
            margin: 10px 0;
            line-height: 1.5;
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .buttons button {
            padding: 8px 15px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s ease;
            background-color: #4d79ff;
            color: #fff;
        }

        .buttons button:hover {
            transform: scale(1.1);
            background-color: #3352b8;
        }

        .note {
            color: lightgrey;
            text-align: center;
            font-size: 12px;
            margin-top: 20px;
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
        $result = mysqli_query($db1, "UPDATE appointments SET status = 'CLOSE' WHERE aid = '$aid'");
        if ($result) {
            header("location: aa.php?return-msg=Appointment Successfully Deleted!");
        } else {
            header("location: aa.php?return-msg=Error Occurred");
        }
        mysqli_close($db1);
    }

    $aid = $_POST['aid'];
    $resultApt = mysqli_query($db1, "SELECT * FROM appointments app JOIN doctorprofile dr ON app.did = dr.did WHERE app.aid = $aid");

    $row = mysqli_fetch_assoc($resultApt);
    ?>

    <div class="container">
        <h1>Appointment Details</h1>
        <div class="appointment-details">
            <p><strong>Appointment ID:</strong> <?php echo $row['aid']; ?></p>
            <p><strong>Doctor Name:</strong> <?php echo $row['dname']; ?></p>
            <p><strong>Doctor ID:</strong> <?php echo $row['did']; ?></p>
            <p><strong>Specialization:</strong> <?php echo $row['dspecialization']; ?></p>
            <p><strong>Current Status:</strong> <?php echo $row['status']; ?></p>
            <p><strong>Booking Date:</strong> <?php echo $row['book_date']; ?></p>
            <p><strong>Appointment Date Time:</strong> <?php echo $row['apt_date_time']; ?></p>
        </div>
        <div class="buttons">
            <?php if ($row['status'] == 'READY') : ?>
                <button onclick="startAppointment(<?php echo $row['aid']; ?>)">Start Appointment</button>
            <?php endif; ?>
            <form method="post" onsubmit="return onSubmit()" action="">
                <input type="hidden" name="aid" value="<?php echo $row['aid']; ?>">
                <button type="submit" name="delete_apt">Delete Appointment</button>
            </form>
        </div>
        <p class="note">*If Start Appointment is not showing, it means the doctor has not started the appointment yet!</p>
    </div>
    <script>
        function startAppointment(aid) {
            // Placeholder for your logic to start the appointment
            console.log("Start Appointment ID: " + aid);
        }

        function onSubmit() {
            return confirm("Do you really want to cancel your appointment?");
        }
    </script>
</body>
</html>
