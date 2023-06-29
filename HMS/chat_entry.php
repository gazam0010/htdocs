<?php
session_start();

$host = 'localhost';
$database = 'test';
$username = 'root';
$password = '';

$connection = mysqli_connect($host, $username, $password, $database);

//destroying chat session
if (isset($_POST['unset_session'])) {
    unset($_SESSION['chatId']);
    $chatId = $_POST['chatId'];

    //De-activating current chat status
    $query = "UPDATE chat_status SET status = 'ENDED' WHERE chat_id = '$chatId'";
    mysqli_query($connection, $query);

    mysqli_close($connection);

    session_unset();

    session_destroy();

    header('Location: chat_entry.php?msg=Destroyed');
    exit();
}


$_SESSION['chatId'] = uniqid(); // Generate a unique ID
$chatId = $_SESSION['chatId'];

//Activating current chat status
$query = "INSERT INTO chat_status (chat_id, status)
    VALUES ('$chatId', 'ACTIVE')";
mysqli_query($connection, $query);

mysqli_close($connection);




?>
<!DOCTYPE html>
<html>

<head>
    <title>Chat Entry</title>
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

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"] {
            padding: 10px;
            width: 100%;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        button {
            padding: 10px 20px;
            margin-top: 20px;
            border-radius: 4px;
            border: none;
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Chat Entry</h1>
        <form action="chat.php" method="POST">
            <label for="sender">Your Username:</label>
            <input type="text" id="sender" name="sender" placeholder="Your username" required>

            <label for="recipient">Recipient Username:</label>
            <input type="text" id="recipient" name="recipient" placeholder="Recipient username" required>
            <input type="hidden" value="<?php echo $chatId; ?>" name="chatId">

            <button type="submit" name="start_chat">Start Chat</button>
        </form>
    </div>
</body>

</html>