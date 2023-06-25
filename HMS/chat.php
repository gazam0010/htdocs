<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $server = "localhost";
    $username = "root";
    $password = "";
    $db = "test";
    $table = "chat";
    $did = 1; // doctor ID
    $pid = 2; // patient ID

    // Create a connection to the database
    $conn = new mysqli($server, $username, $password, $db);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $message = $_POST['message'];

    // Insert the chat message into the database
    $sql = "INSERT INTO $table (did, pid, message) VALUES ($did, $pid, '$message')";
    if ($conn->query($sql) === true) {
        echo $message; // Return the message as a response
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    exit(); // Stop further execution of the PHP code
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'load') {
    $server = "localhost";
    $username = "root";
    $password = "";
    $db = "test";
    $table = "chat";
    $did = 1; // doctor ID
    $pid = 2; // patient ID
    $curr_Usr = 1;

    // Create a connection to the database
    $conn = new mysqli($server, $username, $password, $db);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM $table WHERE (did = $did AND pid = $pid)";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sender = $row['did'] == $curr_Usr ? 'Doctor' : 'Patient';
            $message = $row['message'];
            echo "<div><strong>$sender:</strong> $message</div>";
        }
    }

    $conn->close();
    exit(); // Stop further execution of the PHP code
}
?>
