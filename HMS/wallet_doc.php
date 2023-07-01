<!DOCTYPE html>
<html>

<head>
    <title>Wallet Management</title>
    <link rel="stylesheet" href="wallet.css?">
    <style>
        .withdraw_funds label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .withdraw_funds input[type="text"],
        .withdraw_funds input[type="number"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s ease-in-out;
        }

        .withdraw_funds input[type="text"]:focus,
        .withdraw_funds input[type="number"]:focus {
            border-color: #6c63ff;
            outline: none;
        }
    </style>

</head>

<body>
    <div class="wallet-container">

        <!-- Popup Message -->
        <?php
        if (isset($_GET['success'])): ?>

            <div class="popup" id="popup-container">
                <?php
                $message = $_GET['success'];
                echo "<p>$message</p>";
                ?>
            </div>
        <?php endif; ?>
        <?php
        // Database configuration
        include('config.php');
        $userId = 9001;

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


        // Get the user ID in config file
        
        // Get the wallet balance for the user
        $stmt = $connection->prepare("SELECT balance FROM doctorprofile WHERE did = ?");
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
        <h3>Transaction History</h3>
        <div class="transaction-table-container">';

        // Fetch transaction history for the user
        $stmt = $connection->prepare("SELECT * FROM transactions WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $transactions = $result->fetch_all(MYSQLI_ASSOC);

            // Pagination settings
            $perPage = 4; // Number of transactions per page
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
            echo '<th>Remark</th>';
            echo '</tr>';

            for ($i = $startIndex; $i < $endIndex; $i++) {
                $row = $transactions[$i];
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['amount'] . '</td>';
                echo '<td>' . $row['type'] . '</td>';
                echo '<td>' . $row['remark'] . '</td>';
                echo '</tr>';
            }

            echo '</table></div>';

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


        
        

        // Withdraw funds from the wallet
        if (isset($_POST['withdraw_amount'])) {
            $amount = sanitizeInput($_POST['amount']);
            $account_number = sanitizeInput($_POST['account_number']);
            $ifsc = sanitizeInput($_POST['ifsc']);
            $remark = 'Ac/No: ' . $account_number . '. IFSC: ' . $ifsc;
            if ($amount && validateInt($amount)) {
                // Check if the user has sufficient balance
                $stmt = $connection->prepare("SELECT balance FROM doctorprofile WHERE did = ?");
                $stmt->bind_param("i", $userId);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $balance = $row['balance'];

                    if ($balance >= $amount) {
                        // Sufficient balance, proceed with the withdrawal
                        $stmt = $connection->prepare("UPDATE doctorprofile SET balance = balance - ? WHERE did = ?");
                        $stmt->bind_param("ii", $amount, $userId);
                        if ($stmt->execute()) {
                            // Insert transaction record into the transactions table
                            $stmt = $connection->prepare("INSERT INTO transactions (user_id, amount, type, remark) VALUES (?, ?, 'debit', ?)");
                            $stmt->bind_param("iis", $userId, $amount, $remark);
                            $stmt->execute();
                            header("Location: wallet_doc.php?success=Amount successfully withdrawn.");
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
            <br>
            <h3>Withdraw Funds</h3>
            <form class="wallet-form" method="POST" action="" onsubmit="return validateForm()">
                <div class="input-container">
                    <input type="number" id="amount" name="amount" placeholder="Enter amount">
                </div>

                <div class="withdraw_funds">
                    <label for="account_number">Account Number:</label>
                    <input type="text" id="account_number" name="account_number" placeholder="Account Number">

                    <label for="ifsc">IFSC:</label>
                    <input type="text" id="ifsc" name="ifsc" placeholder="IFSC">
                </div>

                <input name="withdraw_amount" type="submit" value="Withdraw">
            </form>

        </div>

    </div>


    <script>
        setTimeout(function () {
            var popupContainer = document.getElementById('popup-container');
            popupContainer.style.opacity = '0';
        }, 5000);

        function validateForm() {
            var amountInput = document.getElementById('deposit_amount');
            var amount = amountInput.value;
            if (amount <= 0) {
                alert('Deposit amount must be greater than zero.');
                return false;
            }
            return true;
        }
    </script>
</body>

</html>