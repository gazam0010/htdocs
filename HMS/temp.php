<!DOCTYPE html>
<html>

<head>
    <title>Wallet Management</title>
    <style>
        /* Styles for the wallet container */
        .wallet-container {
            width: 500px;
            /* Updated width */
            margin: 0 auto;
            padding: 20px;
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Styles for the wallet balance */
        .wallet-balance {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Styles for the form */
        .wallet-form {
            margin-bottom: 20px;
        }

        /* Styles for the form input */
        .wallet-form input[type="number"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Styles for the form button */
        .wallet-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Styles for the success message */
        .success-message {
            color: green;
            margin-bottom: 20px;
        }

        /* Styles for the error message */
        .error-message {
            color: red;
            margin-bottom: 20px;
        }

        /* Styles for the transaction history */
        .transaction-history {
            margin-top: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            min-height: 200px;
            /* Set a minimum height */
            overflow-y: auto;
            /* Add vertical scroll if needed */
        }

        .transaction-history table {
            width: 100%;
            border-collapse: collapse;
        }

        .transaction-history table th,
        .transaction-history table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .transaction-history table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .pagination {
            margin-top: 10px;
        }

        .page-link {
            display: inline-block;
            padding: 5px 10px;
            margin-right: 5px;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-decoration: none;
            color: #333;
        }

        .current-page {
            display: inline-block;
            padding: 5px 10px;
            margin-right: 5px;
            background-color: #4CAF50;
            color: #fff;
            border: 1px solid #4CAF50;
            border-radius: 4px;
        }

        /* Styles for the deposit options */
        .deposit-options {
            margin-top: 20px;
        }

        .deposit-options label {
            display: block;
            margin-bottom: 5px;
        }

        .deposit-options input[type="radio"] {
            margin-right: 5px;
        }

        .deposit-options button {
            margin-right: 5px;
            padding: 5px 10px;
            font-size: 14px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="wallet-container">
        <?php
        // Database configuration
        include('config.php');

        // Validate and sanitize user input
        if ($connection->connect_error) {
            die('Connection failed: ' . $connection->connect_error);
        }

        // Validate and sanitize user input
        function sanitizeInput($input)
        {
            $input = trim($input);
            $input = stripslashes($input);
            $input = htmlspecialchars($input);
            return $input;
        }

        function validateInt($value)
        {
            return filter_var($value, FILTER_VALIDATE_INT) !== false;
        }


        // Get the user ID from the session
        //ENABLE THE SESSION AFTER INTEGRATION WITH THE WHOLE HMS CODE
        
        // Get the user ID from the session
        // session_start();
        // if (isset($_SESSION['user_id'])) {
        //     $userId = $_SESSION['user_id'];
        
        $userId = 23;

        // Get the wallet balance for the user
        $stmt = $connection->prepare("SELECT balance FROM wallets WHERE pid = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $balance = $row['balance'];
            echo '<div class="wallet-balance">Wallet Balance: ' . $balance . '</div>';
        } else {
            echo '<div class="error-message">No wallet found for the patient.</div>';
        }

        #<---TRANSACTION HISTORY--->
        
        echo '<div class="transaction-history">
        <h3>Transaction History</h3>';

        // Fetch transaction history for the user
        $stmt = $connection->prepare("SELECT * FROM transactions WHERE pid = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $transactions = $result->fetch_all(MYSQLI_ASSOC);

            // Pagination settings
            $perPage = 5; // Number of transactions per page
            $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $totalTransactions = count($transactions);
            $totalPages = ceil($totalTransactions / $perPage);

            // Validate current page
            if ($currentPage < 1 || $currentPage > $totalPages) {
                $currentPage = 1;
            }

            // Calculate the start and end index of transactions to display
            $startIndex = ($currentPage - 1) * $perPage;
            $endIndex = min($startIndex + $perPage, $totalTransactions);

            echo '<table>';
            echo '<tr>';
            echo '<th>Transaction ID</th>';
            echo '<th>Amount</th>';
            echo '<th>Type</th>';
            echo '</tr>';

            for ($i = $startIndex; $i < $endIndex; $i++) {
                $row = $transactions[$i];
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['amount'] . '</td>';
                echo '<td>' . $row['type'] . '</td>';
                echo '</tr>';
            }

            echo '</table>';

            // Pagination links
            echo '<div class="pagination">';
            if ($totalPages > 1) {
                if ($currentPage > 1) {
                    echo '<a class="page-link" href="wallet.php?page=' . ($currentPage - 1) . '">Previous</a>';
                }

                for ($i = 1; $i <= $totalPages; $i++) {
                    if ($i === $currentPage) {
                        echo '<span class="current-page">' . $i . '</span>';
                    } else {
                        echo '<a class="page-link" href="wallet.php?page=' . $i . '">' . $i . '</a>';
                    }
                }

                if ($currentPage < $totalPages) {
                    echo '<a class="page-link" href="wallet.php?page=' . ($currentPage + 1) . '">Next</a>';
                }
            }
            echo '</div>';
        } else {
            echo '<div class="error-message">No transaction history found.</div>';
        }
        echo '</div>';

        // Deposit funds into the wallet
        if (isset($_POST['deposit_amount'])) {
            $amount = sanitizeInput($_POST['deposit_amount']);
            if ($amount && validateInt($amount)) {
                // Update the wallet balance
                $stmt = $connection->prepare("UPDATE wallets SET balance = balance + ? WHERE pid = ?");
                $stmt->bind_param("ii", $amount, $userId);
                if ($stmt->execute()) {
                    // Insert transaction record into the transactions table
                    $stmt = $connection->prepare("INSERT INTO transactions (pid, amount, type) VALUES (?, ?, 'credit')");
                    $stmt->bind_param("ii", $userId, $amount);
                    $stmt->execute();
                    header("Location: pay_gateway.php?amount=$amount");
                    exit();
                } else {
                    echo '<div class="error-message">Error updating wallet balance: ' . $connection->error . '</div>';
                }
            }
        }

        // Withdraw funds from the wallet - POSTED from other page
        if (isset($_POST['withdraw_amount'])) {
            $amount = sanitizeInput($_POST['withdraw_amount']);
            if ($amount && validateInt($amount)) {
                // Check if the user has sufficient balance
                $stmt = $connection->prepare("SELECT balance FROM wallets WHERE pid = ?");
                $stmt->bind_param("i", $userId);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $balance = $row['balance'];

                    if ($balance >= $amount) {
                        // Sufficient balance, proceed with the withdrawal
                        $stmt = $connection->prepare("UPDATE wallets SET balance = balance - ? WHERE pid = ?");
                        $stmt->bind_param("ii", $amount, $userId);
                        if ($stmt->execute()) {
                            // Insert transaction record into the transactions table
                            $stmt = $connection->prepare("INSERT INTO transactions (pid, amount, type) VALUES (?, ?, 'debit')");
                            $stmt->bind_param("ii", $userId, $amount);
                            $stmt->execute();
                            header("Location: wallet.php");
                            exit();
                        } else {
                            echo '<div class="error-message">Error updating wallet balance: ' . $connection->error . '</div>';
                        }
                    } else {
                        echo '<div class="error-message">Insufficient balance.</div>';
                    }
                } else {
                    echo '<div class="error-message">No wallet found for the patient.</div>';
                }
            }
        }
        // } else {
        //     echo '<div class="error-message">User not logged in.</div>';
        // }
        
        // Close the database connection
        
        ?>
        <div>
            <form class="wallet-form" method="POST" action="">
                <input type="number" name="deposit_amount" placeholder="Enter deposit amount" required>
                <input type="submit" value="Deposit">
            </form>
        </div>
        <div>
            <form class="wallet-form" method="POST" action="">
                <input type="number" name="withdraw_amount" placeholder="Enter withdrawal amount" required>
                <input type="submit" value="Withdraw">
            </form>
        </div>
    </div>
</body>

</html>