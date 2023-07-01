<?php
require_once 'config.php';

function sanitizeInput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    if($input > 0){
        return $input;
    }else{
        header ('Location: wallet.php?success=ERROR: Amount must be greater than Rs. 0');
    }
  
}

function validateInt($value)
{
    return filter_var($value, FILTER_VALIDATE_INT) !== false;
}

if (isset($_POST['deposit'])) {
    $amount = sanitizeInput($_POST['deposit_amount']);
    $deposit_option = $_POST['deposit_option'];
    
    if ($amount && validateInt($amount)) {
        $stmt = $connection->prepare("UPDATE patient SET balance = balance + ?  WHERE pid = ?");
        $stmt->bind_param("ii", $amount, $userId);
        
        if ($stmt->execute()) {
            $stmt = $connection->prepare("INSERT INTO transactions (user_id, amount, remark, type) VALUES (?, ?, ?, 'credit')");
            $stmt->bind_param("ids", $userId, $amount, $deposit_option);
            $stmt->execute();

            // Show loading animation for 3 seconds using CSS and JavaScript setTimeout
            echo '<style>
                    .loader {
                        border: 8px solid #f3f3f3;
                        border-top: 8px solid #3498db;
                        border-radius: 50%;
                        width: 60px;
                        height: 60px;
                        animation: spin 2s linear infinite;
                        margin: auto;
                        margin-top: 200px;
                    }
                    
                    @keyframes spin {
                        0% { transform: rotate(0deg); }
                        100% { transform: rotate(360deg); }
                    }
                </style>';

            echo '<div id="loading-div" style="display: flex; justify-content: center; align-items: center; height: 100vh;">
                    <div class="loader"></div>
                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                        Your transaction is being processed, please wait...
                    </div>
                  </div>';

            // Redirect to wallet.php after 3 seconds using JavaScript setTimeout
            echo '<script>
                    setTimeout(function() {
                        window.location.href = "wallet.php?success=Amount successfully deposited.";
                    }, 3000);
                  </script>';

            // Exit the PHP script to prevent further execution
            exit();
        } else {
            echo '<div class="error-message">Error updating wallet balance: ' . $connection->error . '</div>';
        }
    }
}
?>
