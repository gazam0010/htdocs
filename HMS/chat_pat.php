<?php
$host = 'localhost';
$database = 'test';
$username = 'root';
$password = '';

$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die("Failed to connect to the database: " . mysqli_connect_error());
}

if (isset($_POST['start_chat'])) {

    $sender = $_POST['sender'];
    $aid = $_POST['aid'];
    $recipient = $_POST['recipient'];
    $chatId = $_POST['chatId'];
    //check if chat active?
    $chatResult = mysqli_query($connection, "SELECT * FROM chat_status WHERE chat_id = '$chatId'");
    $rowChat = mysqli_fetch_assoc($chatResult);

    $chatStatusRow = $rowChat['status'];
} else {
    header('Location:aa.php');
    exit();
}



// Function to insert a new chat message into the database
function insertChatMessage($chatId, $sender, $recipient, $message)
{
    global $connection;

    $sender = mysqli_real_escape_string($connection, $sender);
    $recipient = mysqli_real_escape_string($connection, $recipient);
    $message = mysqli_real_escape_string($connection, $message);
    $chatId = mysqli_real_escape_string($connection, $chatId);

    $query = "INSERT INTO chat_messages (chat_id, sender, recipient, message, timestamp)
              VALUES ('$chatId', '$sender', '$recipient', '$message', NOW())";

    mysqli_query($connection, $query);

    if (mysqli_affected_rows($connection) > 0) {
        return true;
    } else {
        return false;
    }
}

function decryptMessage($encryptedData, $key)
{
    $data = base64_decode($encryptedData);
    $ivLength = openssl_cipher_iv_length('AES-256-CBC');
    $iv = substr($data, 0, $ivLength);
    $encryptedMessage = substr($data, $ivLength);
    $decryptedMessage = openssl_decrypt($encryptedMessage, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
    return $decryptedMessage;
}

// Check if the chat form was submitted
if (isset($_POST['sender'], $_POST['recipient'], $_POST['message'])) {
    $sender = $_POST['sender'];
    $recipient = $_POST['recipient'];
    $message = $_POST['message'];

    if (insertChatMessage($chatId, $sender, $recipient, $message)) {
        echo "Message sent successfully!";
    } else {
        echo "Failed to send message.";
    }
}

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

        .chat-users-note {
            margin-left: 18%;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php if ($chatStatusRow == 'ACTIVE'): ?>
                    <a href="aa.php"><button class="action-button">Exit Chat</button></a>
              
        <?php endif ?>

        <h1>Appointment Chat</h1>
        <span style="float:left; color:grey; font-size: 10px;">Appointment ID:
            <?php echo $aid; ?>
        </span><br>
        <span class="chat-users-note">
            <?php echo $sender . ' is chatting with ' . $recipient; ?>
        </span><br><br>

        <div id="chat-container"></div>
        <?php if ($chatStatusRow == 'ACTIVE'): ?>
            <input type="text" id="message" placeholder="Message" style="width: calc(100% - 80px);">
            <button onclick="sendChatMessage()">Send</button>
        <?php endif ?>
        <?php
        if ($chatStatusRow != 'ACTIVE') {
            echo '<h5 style="text-align: center;">Chat has been ended!</h5>';
        }
        ?>
        <span style="float:right; color:grey; font-size: 10px;">AES 128-bit Encryption</span>

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

            chatContainer.scrollTop = chatContainer.scrollHeight;
        }


        function sendChatMessage() {
            var sender = '<?php echo $sender; ?>';
            var recipient = '<?php echo $recipient; ?>';
            var chatId = '<?php echo $chatId; ?>';
            var message = document.getElementById('message').value.trim();

            // Check if the message is not empty
            if (message !== '') {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'send_chat_message.php');
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
                    '&chatId=' + encodeURIComponent(chatId) +
                    '&message=' + encodeURIComponent(message);
                xhr.send(data);
            }

            // Clear the message input field
            document.getElementById('message').value = '';
        }

        // Function to periodically fetch chat messages from the server
        function fetchChatMessages() {
            var sender = '<?php echo $sender; ?>';
            var recipient = '<?php echo $recipient; ?>';
            var chatId = '<?php echo $chatId; ?>';

            // Fetch the chat messages from the server using AJAX or fetch
            var xhr = new XMLHttpRequest();
            xhr.open('GET', `fetch_chat_messages.php?sender=${encodeURIComponent(sender)}&recipient=${encodeURIComponent(recipient)}&chatId=${encodeURIComponent(chatId)}`);

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

        // Periodically fetch chat messages every 1 seconds
        setInterval(fetchChatMessages, 1000);
    </script>
</body>

</html>