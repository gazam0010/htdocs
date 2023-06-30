<?php
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'test');

// Create database connection
$connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

//ENABLE THE SESSION AFTER INTEGRATION WITH THE WHOLE HMS CODE
        
        // Get the user ID from the session
        // session_start();
        // if (isset($_SESSION['user_id'])) {
        //     $userId = $_SESSION['user_id'];
        
        $userId = 5001;
?>