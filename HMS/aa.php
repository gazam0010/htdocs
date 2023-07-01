<?php
session_start();

$pid = 5001;
date_default_timezone_set('Asia/Kolkata');
$date = date('d/m/Y h:i:s a', time());

$db1 = mysqli_connect("localhost", "root", "", "test");

// Fetching wallet balance
$queryWalletBal = mysqli_query($db1, "SELECT balance FROM patient WHERE pid = $pid");
$walletBalArray = mysqli_fetch_assoc($queryWalletBal);
$wallet_balance = $walletBalArray['balance'];

if (isset($_POST['apt_book'])) {
    $aid = getLastAppointmentId($db1) + 1;
    $did = $_POST['radio-option'];
    $apt_dt = $_POST['date'] . ' ' . $_POST['time'];
    $status = 'OPEN';
    $description = $_POST['description'];
    $bp = $_POST['bp'];
    $glucose = $_POST['glucose'];
    $pulse = $_POST['pulse'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $bmi = $weight / ($height * $height);

    //Fetching last transaction ID
    function fetchLastTxId($db)
    {
        $txnIDsql = mysqli_query($db, "select MAX(`id`) as max_id FROM transactions");
        $row = mysqli_fetch_assoc($txnIDsql);
        return $row["max_id"] + 1;
    }

    //If wallet balance is greater than or equal to appointment fees
    if ($wallet_balance >= 300) {
        $result = insertAppointment(fetchLastTxId($db1), $db1, $aid, $pid, $did, $apt_dt, $status, $description, $date, $glucose, $bp, $pulse, $weight, $height, $bmi, $wallet_balance);
        if ($result) {
            header("location: aa.php?success-booked=1&aid=" . $aid . "");
            exit();
        } else {
            echo "Some error occurred";
        }
    } else {
        header("location: aa.php?return-msg=ERROR: Wallet balance insufficient");
        exit();
    }
}

function getLastAppointmentId($db)
{
    $lastidSql = mysqli_query($db, "SELECT max(aid) AS max_aid FROM `appointments`");
    $fetchId = mysqli_fetch_assoc($lastidSql);
    return $fetchId['max_aid'];
}

function insertAppointment($tx_id, $db, $aid, $pid, $did, $apt_dt, $status, $description, $book_date, $bp, $glucose, $pulse, $weight, $height, $bmi, $wallet_balance)
{
    mysqli_begin_transaction($db);

    $query3 = "UPDATE patient SET balance = balance - 300 WHERE pid = ?";
    $query5 = "UPDATE doctorprofile SET balance = balance + 300 WHERE did = ?";
    $query4 = "INSERT INTO transactions (user_id, type, amount, remark) VALUES (?, 'debit', '300', CONCAT('Appointment (ID - ', ?, ')'))";
    $query6 = "INSERT INTO transactions (user_id, type, amount, remark) VALUES (?, 'credit', '300', CONCAT('Appointment (ID - ', ?, ')'))";
    $query1 = "INSERT INTO appointments (aid, pid, did, apt_date_time, status, description, book_date, transaction_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $query2 = "INSERT INTO vitals (pid, bp, pulse, glucose, weight, height, bmi, aid) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt3 = mysqli_prepare($db, $query3);
    $stmt4 = mysqli_prepare($db, $query4);
    $stmt6 = mysqli_prepare($db, $query6);
    $stmt1 = mysqli_prepare($db, $query1);
    $stmt2 = mysqli_prepare($db, $query2);
    $stmt5 = mysqli_prepare($db, $query5);

    mysqli_stmt_bind_param($stmt3, 'i', $pid);
    mysqli_stmt_bind_param($stmt5, 'i', $did);
    mysqli_stmt_bind_param($stmt4, 'ii', $pid, $aid);
    mysqli_stmt_bind_param($stmt6, 'ii', $did, $aid);
    mysqli_stmt_bind_param($stmt1, 'iiissssi', $aid, $pid, $did, $apt_dt, $status, $description, $book_date, $tx_id);
    mysqli_stmt_bind_param($stmt2, 'issssssi', $pid, $bp, $pulse, $glucose, $weight, $height, $bmi, $aid);

    $success = true;

    if (
        !mysqli_stmt_execute($stmt3) ||
        !mysqli_stmt_execute($stmt4) ||
        !mysqli_stmt_execute($stmt6) ||
        !mysqli_stmt_execute($stmt1) ||
        !mysqli_stmt_execute($stmt2) ||
        !mysqli_stmt_execute($stmt5)
    ) {
        $success = false;
    }

    if ($success) {
        mysqli_commit($db);
        return true;
    } else {
        mysqli_rollback($db);
        return false;
    }
}


?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="appt.css?">
</head>

<body style="background-color: #f7f7f7;">
    <?php
    if (isset($_GET['success-booked'])) {
        echo '<div class="alert">
Appointment successfully booked with Appointment ID: ' . $_GET['aid'] . '
</div>';
    }
    if (isset($_GET['return-msg'])) {
        echo '<div class="alert">' . $_GET['return-msg'] . '</div>';
    }
    ?>

    <div id="formContainer">
        <div id="firstHalf">
            <div class="bodyX">
                <h4 align="left" id="toggleButton">
                    Show/hide previous appointments ⬇
                </h4>
                <div id="hiddenDiv" class="hidden">
                    <div class="table-container">
                        <table class="custom-table">
                            <tr>
                                <th>Appointment ID</th>
                                <th>Booking Date</th>
                                <th>Specialization</th>
                                <th>Doctor</th>
                                <th>App. Date & Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tbody>
                                <?php
                                // Fetching Previous Appointments
                                $resultApt = mysqli_query($db1, "SELECT * FROM appointments app JOIN patient p ON app.pid = p.pid JOIN doctorprofile dr ON app.did = dr.did WHERE app.pid = $pid");

                                while ($row = mysqli_fetch_assoc($resultApt)) {
                                    echo '
                              <tr>
                                <td>' . $row['aid'] . '</td>
                                <td>' . $row['book_date'] . '</td>
                                <td>' . $row['dspecialization'] . '</td>
                                <td>' . $row['dname'] . '</td>
                                <td>' . $row['apt_date_time'] . '</td>
                                <td>' . $row['status'] . '</td>
                                <td>
                                    <form method="POST" action="appt_details.php" target="_blank">
                                        <input type="hidden" name="aid" value="' . $row['aid'] . '">
                                        <input type="hidden" name="did" value="' . $row['did'] . '">
                                        <input type="hidden" name="pname" value="' . $row['pname'] . '">
                                        <input type="submit" class="action-button" value="Open" name="access_apt">
                                    </form>
                                </td>
                              </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <h2 align="center">Book a new Appointment</h2>
                <label for="firstSelect">
                    <h2 align="center">
                        <h3 align="center">Select a Specialization: </h3>
                </label>
                <select id="firstSelect" name="specialization" onchange="fetchData()">
                    <option value="">Select an option</option>
                    <option value="Cardiologist">Cardiologist</option>
                    <option value="Pathologist">Pathologist</option>
                    <option value="Pediatrician">Pediatrician</option>
                    <option value="Neurologist">Neurologist</option>
                    <option value="Psychiatrist">Psychiatrist</option>
                    <option value="Dermatologist">Dermatologist</option>
                    <option value="Surgeon">Surgeon</option>
                    <option value="Gestreonterologist">Gestreonterologist</option>
                    <option value="Orthopedic">Orthopedic</option>
                    <option value="Opthalmology">Opthalmology</option>
                </select>
                <div id="selectedSpec"></div>

                <!--Initializing the form for appointment booking-->
                <form id="appointmentForm" method="POST" action="">
                    <div id="printArea" class="containerData"></div>
                    <button type="button" class="but" onclick="showSecondHalf()">Next</button>
                </form>
            </div>
        </div>

        <!--Second Half-->
        <div id="secondHalf" class="bodyX hidden">
            <h3 align="center">Step 2</h3>
            <button type="button" class="but" style="background-color: red; float: left;"
                onclick="goBack()">Back</button>
            <br><br><br><br>
            <hr><br><br><br>
            <form id="secondHalfForm" method="POST" action="">
                <input type="hidden" name="radio-option" value="">

                <div style="margin-bottom: 20px;">
                    <h3>Vitals:</h3>
                    <label for="bp">Blood Pressure: </label>
                    <input type="text" id="bp" style="font-size: 180%" name="bp" required><br><br>

                    <label for="glucose">Glucose: </label>
                    <input type="text" id="glucose" style="font-size: 180%" name="glucose" required><br><br>

                    <label for="pulse">Pulse: </label>
                    <input type="text" id="pulse" style="font-size: 180%" name="pulse" required><br><br>

                    <label for="weight">Weight (kg): </label>
                    <input type="text" id="weight" style="font-size: 180%" name="weight" required><br><br>

                    <label for="height">Height (m): </label>
                    <input type="text" id="height" style="font-size: 180%" name="height" required><br><br>
                </div>

                <div style="margin-bottom: 20px;">
                    <h3>Date, Time, and Description:</h3>
                    <label for="date">Select a date: </label>
                    <input type="date" id="date" style="font-size: 180%" name="date" required><br><br>

                    <label for="time">Select a time: </label>
                    <input type="time" style="font-size: 180%" id="time" name="time" required><br><br><br>

                    <label for="description">Description: </label>
                    <textarea id="description" name="description" type="textarea" rows="4" cols="40"></textarea><br><br>
                    Appointment Charge: <strong>Rs. 300</strong> <br>
                    Wallet Balance: <strong>
                        <?php echo $walletBalArray['balance']; ?>
                    </strong>
                    <br>
                </div>

                <input class="but" type="submit" name="apt_book" value="Book Appointment">
            </form>

        </div>
    </div>

    <script>
        // Main form hide/show
        function showSecondHalf() {
            var firstHalf = document.getElementById('firstHalf');
            var secondHalf = document.getElementById('secondHalf');
            var drSelected = document.querySelector('input[name="radio-option"]:checked').value;
            var secondHalfForm = document.getElementById('secondHalfForm');
            var drSelectedInput = secondHalfForm.querySelector('input[name="radio-option"]');
            drSelectedInput.value = drSelected;
            firstHalf.style.display = 'none';
            secondHalf.style.display = 'block';
        }

        function goBack() {
            var firstHalf = document.getElementById('firstHalf');
            var secondHalf = document.getElementById('secondHalf');
            firstHalf.style.display = 'block';
            secondHalf.style.display = 'none';
        }

        // AJAX fetch data from doctor tbl
        function fetchData() {
            var selectElement = document.getElementById('firstSelect');
            var selectedOption = selectElement.value;
            if (selectedOption !== "") {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var response = xhr.responseText;
                            var printArea = document.getElementById('printArea');
                            selectedSpec.innerHTML = '<h3>List of Doctors under specialization: ' + selectedOption + '</h3>';
                            printArea.innerHTML = response;
                        } else {
                            console.log('Error: ' + xhr.status);
                        }
                    }
                };
                xhr.open('GET', 'fetch_data.php?option=' + selectedOption, true);
                xhr.send();
            } else {
                var printArea = document.getElementById('printArea');
                printArea.innerHTML = '';
            }
        }

        // Show or hide Div
        const toggleButton = document.getElementById('toggleButton');
        const hiddenDiv = document.getElementById('hiddenDiv');

        toggleButton.addEventListener('click', function () {
            if (hiddenDiv.classList.contains('hidden')) {
                hiddenDiv.classList.remove('hidden');
                setTimeout(function () {
                    hiddenDiv.style.opacity = 1;
                    hiddenDiv.style.visibility = 'visible';
                }, 10);
            } else {
                hiddenDiv.style.opacity = 0;
                hiddenDiv.style.visibility = 'hidden';
                setTimeout(function () {
                    hiddenDiv.classList.add('hidden');
                }, 500);
            }
        });
    </script>
</body>

</html>