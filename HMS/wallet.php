<!DOCTYPE html>
<html>

<head>
    <title>Wallet Management</title>
    <style>
        /* Styles for the wallet container */
        .wallet-container {
            width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            border-radius: 5px;
            animation: fade-in 0.5s ease-in-out;
        }

        @keyframes fade-in {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Add animation and motion to the popup message */
        .popup {
            position: fixed;
            top: 50px;
            right: 10px;
            transform: translate(-50%, -50%);
            background-color: lightgreen;
            padding: 8px;
            font-weight: 550;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            opacity: 1;
            transition: opacity 0.5s;
            z-index: 9999;
            animation: shake 0.5s ease-in-out;
        }

        .error-message {
            color: red;
            margin-bottom: 20px;
        }

        /* Add animation and motion to the transaction history table */
        .transaction-history table {
            width: 100%;
            border-collapse: collapse;
            animation: slide-up 0.5s ease-in-out;
        }

        @keyframes slide-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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

        .wallet-form .input-container {
            position: relative;
        }

        .wallet-form .input-container input[type="number"] {
            width: 80%;
            padding: 10px 10px 10px 30px;
            /* Adjust the padding to create space for the Rupees sign */
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .wallet-form .input-container::before {
            content: "₹";
            /* Add the Rupees sign */
            position: absolute;
            left: 10px;
            /* Adjust the left position as needed */
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            color: #555;
        }



        /* Styles for the form button */
        .wallet-form input[type="submit"] {
            width: auto;
            padding: 8px 13px;
            font-size: 14px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            float: right;
            margin-right: 10px;
        }

        .wallet-form input[type="submit"]:hover {
            background-color: #45a049;
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

        .transaction-table-container {
            height: 180px;
            overflow-y: auto;
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
        /* Styles for the deposit options */
        .deposit-options {
            margin-top: 20px;
        }

        .deposit-options h3 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .deposit-options input[type="radio"] {
            display: none;
        }

        .deposit-options label {
            display: inline-block;
            margin-right: 10px;
            padding: 5px 10px;
            font-size: 14px;
            background-color: #f2f2f2;
            color: #333;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
        }

        .deposit-options label:hover {
            background-color: #e0e0e0;
        }

        .deposit-options input[type="radio"]:checked+label {
            background-color: #4CAF50;
            color: #fff;
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
        <h3>Transaction History</h3>
        <div class="transaction-table-container">';

        // Fetch transaction history for the user
        $stmt = $connection->prepare("SELECT * FROM transactions WHERE pid = ?");
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


        // Deposit funds into the wallet
        

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
            <br>
            <form class="wallet-form" method="POST" action="pay_gateway.php" onsubmit="return validateForm()">
                <div class="input-container">
                    <input type="number" id="deposit_amount" name="deposit_amount" placeholder="Enter deposit amount">
                </div>

                <div class="deposit-options">
                    <h3>Deposit Options</h3>
                    <input type="radio" name="deposit_option" id="upi_option" value="UPI">
                    <label for="upi_option">UPI</label>
                    <br>
                    <input type="radio" name="deposit_option" id="credit_card_option" value="Credit Card" required>
                    <label for="credit_card_option">Credit Card</label>
                    <br>
                    <input type="radio" name="deposit_option" id="debit_card_option" value="Debit Card" required>
                    <label for="debit_card_option">Debit Card</label>
                    <br>
                    <input type="radio" name="deposit_option" id="net_banking_option" value="Net Banking" required>
                    <label for="net_banking_option">Net Banking</label>
                </div>
                <input name="deposit" type="submit" value="Deposit">
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