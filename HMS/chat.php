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
function insertChatMessage($sender, $recipient, $message)
{
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
        return true; // Message inserted successfully
    } else {
        return false; // Failed to insert message
    }
}

// Function to retrieve chat messages from the database
function getChatMessages($sender, $recipient)
{
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
if (isset($_POST['sender'], $_POST['recipient'], $_POST['message'])) {
    $sender = $_POST['sender'];
    $recipient = $_POST['recipient'];
    $message = $_POST['message'];

    // Insert the chat message into the database
    if (insertChatMessage($sender, $recipient, $message)) {
        echo "Message sent successfully!";
    } else {
        echo "Failed to send message.";
    }
}

// Close the database connection
mysqli_close($connection);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Chat Interface</title>
    <style>
        #chat-container {
            height: 300px;
            overflow: auto;
            border: 1px solid #ccc;
            padding: 10px;
        }

        .message {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div id="chat-container"></div>
    <input type="text" id="sender" placeholder="Your username">
    <input type="text" id="recipient" placeholder="Recipient username">
    <input type="text" id="message" placeholder="Message">
    <button onclick="sendChatMessage()">Send</button>

    <script>
        // Function to display chat messages
        function displayChatMessages(messages) {
            var chatContainer = document.getElementById('chat-container');
            chatContainer.innerHTML = ''; // Clear previous messages

            for (var i = 0; i < messages.length; i++) {
                var message = messages[i];
                var sender = message.sender;
                var recipient = message.recipient;
                var text = message.message;
                var timestamp = message.timestamp;

                var messageElement = document.createElement('div');
                messageElement.classList.add('message');
                messageElement.innerHTML = sender + ' to ' + recipient + ': ' + text + ' (' + timestamp + ')';

                chatContainer.appendChild(messageElement);
            }
        }

        // Function to send a new chat message
        function sendChatMessage() {
            var sender = document.getElementById('sender').value;
            var recipient = document.getElementById('recipient').value;
            var message = document.getElementById('message').value;

            // Send the chat message to the server using AJAX or fetch
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'send_chat_message.php'); // Replace 'send_chat_message.php' with the actual server-side script
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText);
                        fetchChatMessages(); // Fetch chat messages after sending the new message
                    } else {
                        console.error('Failed to send chat message.');
                    }
                }
            };
            var data = 'sender=' + encodeURIComponent(sender) +
                '&recipient=' + encodeURIComponent(recipient) +
                '&message=' + encodeURIComponent(message);
            xhr.send(data);

            // Clear the message input field
            document.getElementById('message').value = '';
        }

        // Function to fetch chat messages from the server
        function fetchChatMessages() {
            var sender = document.getElementById('sender').value;
            var recipient = document.getElementById('recipient').value;

            // Fetch the chat messages from the server using AJAX or fetch
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_chat_messages.php?sender=' + encodeURIComponent(sender) + '&recipient=' + encodeURIComponent(recipient));
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        displayChatMessages(response.messages);
                    } else {
                        console.error('Failed to fetch chat messages.');
                    }
                }
            };
            xhr.send();
        }

        // Fetch chat messages initially when the page loads
        fetchChatMessages();

        // Periodically fetch chat messages every 5 seconds
        setInterval(fetchChatMessages, 5000);
    </script>
</body>
</html>
