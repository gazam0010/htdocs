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

function getChatMessages($chatId, $sender, $recipient)
{
    global $connection;

    $query = "SELECT sender, recipient, message, timestamp
              FROM chat_messages
              WHERE (sender = ? AND recipient = ? AND chat_id = ?)
              OR (sender = ? AND recipient = ? AND chat_id = ?)
              ORDER BY timestamp ASC";

    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 'ssssss', $sender, $recipient, $chatId, $recipient, $sender, $chatId);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    // Fetch and return the chat messages
    $messages = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $row['message'] = decryptMessage($row['message'], 'FreakAzam9xbdxf5Gx1e8lxf8xc7A23b8C19d6E47F5');
        $messages[] = $row;
    }

    mysqli_stmt_close($stmt);

    return $messages;
}

if (isset($_GET['chatId'], $_GET['sender'], $_GET['recipient'])) {
    $sender = $_GET['sender'];
    $recipient = $_GET['recipient'];
    $chatId = $_GET['chatId'];

    $chatMessages = getChatMessages($chatId, $sender, $recipient);

    header('Content-Type: application/json');
    echo json_encode(['messages' => $chatMessages]);
}

mysqli_close($connection);
?>