<?php
$host = 'localhost';
$database = 'test';
$username = 'root';
$password = '';

$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die("Failed to connect to the database: " . mysqli_connect_error());
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

function getChatMessages($sender, $recipient) {
    global $connection;
    
    $sender = mysqli_real_escape_string($connection, $sender);
    $recipient = mysqli_real_escape_string($connection, $recipient);
    
    $query = "SELECT sender, recipient, message, timestamp
              FROM chat_messages
              WHERE (sender = '$sender' AND recipient = '$recipient')
              OR (sender = '$recipient' AND recipient = '$sender')
              ORDER BY timestamp ASC";
    
    $result = mysqli_query($connection, $query);
    
    // Fetch and return the chat messages
    $messages = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $row['message'] = decryptMessage($row['message'], 'FreakAzam9xbdxf5Gx1e8lxf8xc7A23b8C19d6E47F5');
        $messages[] = $row;
    }
    
    return $messages;
}

if (isset($_GET['sender'], $_GET['recipient'])) {
    $sender = $_GET['sender'];
    $recipient = $_GET['recipient'];

    $chatMessages = getChatMessages($sender, $recipient);

    header('Content-Type: application/json');
    echo json_encode(['messages' => $chatMessages]);
}

mysqli_close($connection);
?>
