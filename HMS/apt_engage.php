<?php
$db1 = mysqli_connect("localhost", "root", "", "test");

if (isset($_POST['unset_session'])) {
   
    $chatId = $_POST['chatId'];
    $aid = $_POST['aid'];

    //De-activating current chat status
    $query = "UPDATE chat_status SET status = 'ENDED' WHERE chat_id = '$chatId'";
    mysqli_query($db1, $query);

    $query1 = mysqli_query($db1, "SELECT * from appointments WHERE aid='$aid'");
    $rowDid = mysqli_fetch_assoc($query1);

    $did = $rowDid['did'];


    mysqli_close($db1);

    header('Location: apt_engage.php?did=' . $did . '&aid=' . $aid);
    exit();
}



if (isset($_GET['aid'])) {
    $aid = $_GET['aid'];
    $did = $_GET['did'];
} else {
    header("location: dr_apt.php");
    exit();
}
//fetching appointment details from apt , patients and vitals table.

$resultAptEng = mysqli_query($db1, "SELECT * FROM appointments app JOIN doctorprofile d ON d.did = app.did JOIN patient p ON app.pid = p.pid JOIN vitals v ON app.aid = v.aid WHERE app.aid = $aid");
$row = mysqli_fetch_assoc($resultAptEng);

if($row['vc_link'] != ''){
    $chatId = $row['vc_link'];
} else {
    $chatId = uniqid();
}

//updating other_actions status
if (isset($_POST['other_action'])) {
    $other_action = $_POST['other_action'];
    $updateStatus = mysqli_query($db1, "UPDATE appointments SET status = '$other_action' WHERE aid = $aid");
    if ($updateStatus) {
        header("location: apt_engage.php?did=" . urlencode($did) . "&aid=" . urlencode($aid) . "&updateStatus=" . urlencode("Status updated: $other_action"));
        exit();
    } else {
        header("location: apt_engage.php?did=" . urlencode($did) . "&aid=$aid&updateStatus=Some error occured");
        exit();
    }
}

//completing apt status
if (isset($_POST['complete_apt'])) {
    $comment = $_POST['comment'];
    $updateStatus = mysqli_query($db1, "UPDATE appointments SET status = 'COMPLETED', comm = '$comment' WHERE aid = $aid");
    if ($updateStatus) {
        header("location: apt_engage.php?did=" . urlencode($did) . "&aid=" . urlencode($aid) . "&updateStatus=" . urlencode("Status update: Appointment Completed"));
    } else {
        header("location: apt_engage.php?did=" . urlencode($did) . "&aid=$aid&updateStatus=Some error occured");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Details</title>
    <link rel="stylesheet" href="apt_engage.css?">
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
            <?php $status = $row['status']; ?>
            <?php if ($status != 'CLOSED'): ?>
                <div class="action-buttons">
                    <?php if ($status == 'In Progress' || $status == 'ONGOING' || $status == 'COMPLETED'): ?>
                        <form method="POST" action="chat.php">
                            <input type="hidden" name="aid" value="<?php echo $aid; ?>">
                            <input type="hidden" name="chatId" value="<?php echo $chatId; ?>">
                            <input type="hidden" name="sender" value="<?php echo $row['dname'] ?>">
                            <input type="hidden" name="recipient" value="<?php echo $row['pname'] ?>">
                            <button name="start_chat" type="submit" class="action-button primary-action"
                                onclick="if(confirmAction('Start'))" target="_blank">Open Chat</button>
                        </form>
                    <?php endif; ?>
                    <?php if ($status != 'CLOSE' && $status != 'COMPLETED'): ?>
                        <form method="POST" action="">
                            <button class="action-button" onclick="if(confirmAction('Close'))" type="submit" name="other_action"
                                value="CLOSED">Close</button>
                        </form>
                    <?php endif; ?>
                    <?php if ($status != 'In Progress'): ?>
                        <form method="POST" action="">
                            <button class="action-button" onclick="if(confirmAction('change status to In Progress '))" type="submit" name="other_action"
                                value="In Progress">Initiate Appointment</button>
                        </form>
                    <?php endif ?>
                </div>
                <form method="POST" action="">
                    <textarea name="comment" class="comment-box" placeholder="Add a comment..."></textarea><br>
                    <button type="submit" name="complete_apt" class="submit-button"
                        onclick="return confirmSubmit();">Submit</button>
                </form>
            <?php endif ?>
        </div>
    </div>
</body>

</html>
<?php
mysqli_close($db1);
?>