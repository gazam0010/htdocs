<!DOCTYPE html>
<html>
<head>
    <title>Chat System</title>
    <style>
        #chat-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
        }

        #chat-button {
            width: 100px;
            height: 40px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #chat-box {
            display: none;
            width: 300px;
            height: 400px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px;
            box-sizing: border-box;
        }

        #chat-messages {
            height: 80%;
            overflow-y: scroll;
        }

        #chat-form {
            margin-top: 10px;
        }

        #chat-form input[type="text"] {
            width: 80%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 5px;
        }

        #chat-form button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div id="chat-container">
        <button id="chat-button">Chat</button>
        <div id="chat-box">
            <div id="chat-messages"></div>
            <form id="chat-form">
                <input type="text" id="message-input" placeholder="Type your message...">
                <button type="submit">Send</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var chatButton = document.getElementById("chat-button");
            var chatBox = document.getElementById("chat-box");
            var chatForm = document.getElementById("chat-form");
            var messageInput = document.getElementById("message-input");
            var chatMessages = document.getElementById("chat-messages");

            chatButton.addEventListener("click", function() {
                chatBox.style.display = "block";
                chatButton.style.display = "none";
                loadChatMessages(); // Load existing chat messages when the chat box is opened
            });

            chatForm.addEventListener("submit", function(event) {
                event.preventDefault();
                var message = messageInput.value.trim();
                if (message !== "") {
                    sendMessage(message);
                    messageInput.value = "";
                }
            });

            function sendMessage(message) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "chat.php?action=send", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var response = xhr.responseText;
                            displayMessage(response);
                        } else {
                            console.log("Error: " + xhr.status);
                        }
                    }
                };
                xhr.send("message=" + encodeURIComponent(message));
            }

            function displayMessage(message) {
                var messageElement = document.createElement("div");
                messageElement.textContent = message;
                chatMessages.appendChild(messageElement);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            function loadChatMessages() {
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "chat.php?action=load", true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var response = xhr.responseText;
                            chatMessages.innerHTML = response;
                            chatMessages.scrollTop = chatMessages.scrollHeight;
                        } else {
                            console.log("Error: " + xhr.status);
                        }
                    }
                };
                xhr.send();
            }

            // Auto-refresh chat messages every 3 seconds
            setInterval(function() {
                loadChatMessages();
            }, 3000);
        });
    </script>
</body>
</html>
