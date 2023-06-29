<?php
// Establish database connection
$host = 'localhost';
$database = 'test';
$username = 'root';
$password = '';

$connection = mysqli_connect($host, $username, $password, $database);

// Check if the database connection was successful
if (!$connection) {
    die("Failed to connect to the database: " . mysqli_connect_error());
}

// Function to insert a new chat message into the database
function insertChatMessage($sender, $recipient, $message) {
    global $connection;
    
    // Escape the values to prevent SQL injection
    $sender = mysqli_real_escape_string($connection, $sender);
    $recipient = mysqli_real_escape_string($connection, $recipient);
    $message = mysqli_real_escape_string($connection, $message);
    
    // Create the SQL query
    $query = "INSERT INTO chat_messages (sender, recipient, message, timestamp)
              VALUES ('$sender', '$recipient', '$message', NOW())";
    
    // Execute the query
    mysqli_query($connection, $query);
    
    // Check if the query was successful
    if (mysqli_affected_rows($connection) > 0) {
        echo "Message sent successfully!";
    } else {
        echo "Failed to send message.";
    }
}

// Check if the chat form was submitted
if (isset($_POST['sender'], $_POST['recipient'], $_POST['message'])) {
    $sender = $_POST['sender'];
    $recipient = $_POST['recipient'];
    $message = $_POST['message'];
    
    // Insert the chat message into the database
    insertChatMessage($sender, $recipient, $message);
}

// Close the database connection
mysqli_close($connection);
?>
