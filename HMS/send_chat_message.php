<?php
$host = 'localhost';
$database = 'test';
$username = 'root';
$password = '';

$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die("Failed to connect to the database: " . mysqli_connect_error());
}
// Function to encrypt a message
function encryptMessage($message, $key)
{
    $ivLength = openssl_cipher_iv_length('AES-256-CBC');
    $iv = openssl_random_pseudo_bytes($ivLength);
    $encryptedMessage = openssl_encrypt($message, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
    $encryptedData = base64_encode($iv . $encryptedMessage);
    return $encryptedData;
}

function insertChatMessage($chatId, $sender, $recipient, $message, $encryptionKey)
{
    global $connection;

    $sender = mysqli_real_escape_string($connection, $sender);
    $recipient = mysqli_real_escape_string($connection, $recipient);

    $encryptedMessage = encryptMessage($message, $encryptionKey);

    $query = "INSERT INTO chat_messages (chat_id, sender, recipient, message, timestamp)
              VALUES ('$chatId','$sender', '$recipient', '$encryptedMessage', NOW())";

    mysqli_query($connection, $query);

    if (mysqli_affected_rows($connection) > 0) {
        echo "Message sent successfully!";
    } else {
        echo "Failed to send message.";
    }
}

if (isset($_POST['sender'], $_POST['recipient'], $_POST['message'])) {
    $sender = $_POST['sender'];
    $recipient = $_POST['recipient'];
    $message = $_POST['message'];
    $chatId = $_POST['chatId'];
    // Encryption key for message encryption and decryption
    $encryptionKey = "FreakAzam9xbdxf5Gx1e8lxf8xc7A23b8C19d6E47F5"; 

    insertChatMessage($chatId, $sender, $recipient, $message, $encryptionKey); // Pass the chatId as a parameter
}


mysqli_close($connection);
?>
