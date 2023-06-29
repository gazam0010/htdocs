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
            
            <button type="submit" name="start_chat">Start Chat</button>
        </form>
    </div>
</body>
</html>
