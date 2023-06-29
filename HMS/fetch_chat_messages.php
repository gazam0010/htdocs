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

// Function to retrieve chat messages from the database
function getChatMessages($sender, $recipient) {
    global $connection;
    
    // Escape the values to prevent SQL injection
    $sender = mysqli_real_escape_string($connection, $sender);
    $recipient = mysqli_real_escape_string($connection, $recipient);
    
    // Create the SQL query
    $query = "SELECT sender, recipient, message, timestamp
              FROM chat_messages
              WHERE (sender = '$sender' AND recipient = '$recipient')
              OR (sender = '$recipient' AND recipient = '$sender')
              ORDER BY timestamp ASC";
    
    // Execute the query
    $result = mysqli_query($connection, $query);
    
    // Fetch and return the chat messages
    $messages = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $messages[] = $row;
    }
    
    return $messages;
}

// Check if the chat form was submitted
if (isset($_GET['sender'], $_GET['recipient'])) {
    $sender = $_GET['sender'];
    $recipient = $_GET['recipient'];

    // Retrieve the chat messages from the database
    $chatMessages = getChatMessages($sender, $recipient);

    // Return the chat messages as JSON
    header('Content-Type: application/json');
    echo json_encode(['messages' => $chatMessages]);
}

// Close the database connection
mysqli_close($connection);
?>
