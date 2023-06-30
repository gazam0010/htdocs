<!DOCTYPE html>
<html>

<head>
    <title>Appointment Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 30px;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: fade-in 0.8s ease;
        }

        .custom-table th,
        .custom-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .custom-table th {
            background-color: #f2f2f2;
            color: #333;
        }

        .custom-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .action-buttons {
            display: flex;
            justify-content: space-around;
        }

        .action-buttons button {
            padding: 8px 15px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .action-buttons button.close {
            background-color: #ff4d4d;
            color: #fff;
        }

        .action-buttons button.start {
            background-color: #66cc66;
            color: #fff;
        }

        .action-buttons button:hover {
            transform: scale(1.1);
        }

        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <script>
        // Add your JavaScript code here
    </script>
</head>

<body>
    <h1>Appointment Page</h1>
    <table class="custom-table">
        <tr>
            <th>Appointment ID</th>
            <th>Booking Date</th>
            <th>Patient Name</th>
            <th>Current Status</th>
            <th>Appointment Date Time</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php
        $did = 9001;
        $db1 = mysqli_connect("localhost", "root", "", "test");
        $resultApt = mysqli_query($db1, "SELECT * FROM appointments app JOIN patient p ON app.pid = p.pid WHERE app.did = $did ORDER BY aid");
        while ($row = mysqli_fetch_assoc($resultApt)) {
      
            echo "<tr>";
            echo "<td>{$row['aid']}</td>";
            echo "<td>{$row['book_date']}</td>";
            echo "<td>{$row['pname']}</td>";
            echo "<td>{$row['status']}</td>";
            echo "<td>{$row['apt_date_time']}</td>";
            echo "<td>{$row['description']}</td>";
            echo "<td class=\"action-buttons\">";
            echo "<a href='apt_engage.php?did=".$row['did']."&aid=".$row['aid']."' target='_blank'>
            <button class=\"start\" >Start</button></a>";
            echo "</td>";
            echo "</tr>";
        }
        mysqli_close($db1);
        ?>
    </table>

    <script>
        function closeAppointment(appointmentId) {
            // Implement logic to close appointment
            console.log("Closing appointment: " + appointmentId);
        }

        function startAppointment(appointmentId) {
            // Implement logic to start appointment
            console.log("Starting appointment: " + appointmentId);
        }
    </script>
</body>

</html>