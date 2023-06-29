<?php
// Retrieve the sender and recipient usernames from the query parameters
if (isset($_POST['start_chat'])) {
    $sender = $_POST['sender'];
    $recipient = $_POST['recipient'];
}

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
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        #chat-container {
            height: 300px;
            overflow: auto;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }

        .message {
            margin-bottom: 10px;
            padding: 5px;
            border-radius: 4px;
            position: relative;
            animation-duration: 0.5s;
            animation-fill-mode: both;
        }

        .message.sent {
            background-color: #f1f1f1;
            text-align: right;
        }

        .message.received {
            background-color: #e5e5e5;
            text-align: left;
        }


        .message .meta {
            font-size: 12px;
            color: #888;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .message .content {
            font-size: 14px;
        }

        input[type="text"],
        button {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        @keyframes slideInRight {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(0);
            }
        }

        @keyframes slideInLeft {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(0);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Chat Interface</h1>
        <div id="chat-container"></div>
        <input type="text" id="message" placeholder="Message" style="width: calc(100% - 80px);">
        <button onclick="sendChatMessage()">Send</button>

    </div>

    <script>
        // Function to display chat messages
        function displayChatMessages(messages) {
            var chatContainer = document.getElementById('chat-container');
            chatContainer.innerHTML = ''; // Clear previous messages

            for (var i = 0; i < messages.length; i++) {
                var message = messages[i];
                var userOnSide = message.sender;
                var recipient = message.recipient;
                var text = message.message;
                var timestamp = message.timestamp;

                var messageElement = document.createElement('div');
                messageElement.classList.add('message');

                if (userOnSide === '<?php echo $sender; ?>') {
                    messageElement.classList.add('sent');
                } else if (userOnSide === '<?php echo $recipient; ?>') {
                    messageElement.classList.add('received');
                }

                messageElement.innerHTML = `
            <div class="meta"><b>${userOnSide}</b> - ${timestamp}</div>
            <div class="content">${text}</div>
        `;

                chatContainer.appendChild(messageElement);
            }

            // Scroll to the bottom of the chat container
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }


        // Function to send a new chat message
        // Function to send a new chat message
        function sendChatMessage() {
            var sender = '<?php echo $sender; ?>';
            var recipient = '<?php echo $recipient; ?>';
            var message = document.getElementById('message').value.trim();

            // Check if the message is not empty
            if (message !== '') {
                // Send the chat message to the server using AJAX or fetch
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'send_chat_message.php'); // Replace 'send_chat_message.php' with the actual server-side script
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            console.log(xhr.responseText);
                            // Fetch updated chat messages after sending the message
                            fetchChatMessages();
                        } else {
                            console.error('Failed to send chat message.');
                        }
                    }
                };
                var data = 'sender=' + encodeURIComponent(sender) +
                    '&recipient=' + encodeURIComponent(recipient) +
                    '&message=' + encodeURIComponent(message);
                xhr.send(data);
            }

            // Clear the message input field
            document.getElementById('message').value = '';
        }

        // Function to handle the Enter key press event in the message input field
        document.getElementById('message').addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Prevent the default Enter key behavior (e.g., line break)
                sendChatMessage();
            }
        });

        // Function to periodically fetch chat messages from the server
        function fetchChatMessages() {
            var sender = '<?php echo $sender; ?>';
            var recipient = '<?php echo $recipient; ?>';

            // Fetch the chat messages from the server using AJAX or fetch
            var xhr = new XMLHttpRequest();
            xhr.open('GET', `fetch_chat_messages.php?sender=${encodeURIComponent(sender)}&recipient=${encodeURIComponent(recipient)}`); // Replace 'fetch_chat_messages.php' with the actual server-side script

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

        // Periodically fetch chat messages every 5 seconds
        setInterval(fetchChatMessages, 1000);
    </script>
</body>

</html>