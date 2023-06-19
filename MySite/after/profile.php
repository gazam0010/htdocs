<?php
include ('afterlogin.php');
$pp = $_SESSION['previous_page'];
?>
<?php
$bal_query = "SELECT balance FROM users WHERE mobile = '$username'";
$out = mysqli_query($db, $bal_query);
$bal = mysqli_fetch_assoc($out);
$balance1 = $bal['balance'];
$len = strlen($balance1);
if ($len > 0 && $len < 4) {
    $balance = $bal['balance'];
} elseif ($len == 4) {
    $bal = $bal['balance'];
    $one_ten_hundred = substr($bal, 1);
    $thousand_tenthousand = substr($bal, 0, -3);
    $balance = $thousand_tenthousand.",".$one_ten_hundred;
} elseif ($len == 5) {
    $bal = $bal['balance'];
    $one_ten_hundred = substr($bal, 2);
    $thousand_tenthousand = substr($bal, 0, -3);
    $balance = $thousand_tenthousand.",".$one_ten_hundred;
} elseif ($len == 6) {
    $bal = $bal['balance'];
    $one_ten_hundred = substr($bal, 3);
    $thousand_tenthousand_1 = substr($bal, 0, -3);
    $thousand_tenthousand_2 = substr($thousand_tenthousand_1, 1);
    $lac = substr($bal, 0, -5);
    $balance = $lac.",".$thousand_tenthousand_2.",".$one_ten_hundred;
} 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Profile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <style>
            .header {
                background-color: #032d54;
                background-size: 100%;
                width: auto;
                color: white;
                text-align: center;
                padding-top: 10px;
                padding-bottom: 8px;
            }
            .back-button {
                margin-left: 8%;
            }
            .body {
                background: white;
                border: 1px solid #ccc;
                height: 400px;
            }
            .body > h2 {
                padding: 1rem;
                margin: 0 0 0.5rem 0;
            }
            .body > p {
                padding: 0 1rem;
            }
            .stripe-4 {
                color: black;
                height: 100%;
                padding-top: 6%;
                background: repeating-linear-gradient(-50deg, #e0f0ff, #e0f0ff 4px, #f3f9ff 4px, #f3f9ff 10px);
            }
            .modal {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z-index: 1; /* Sit on top */
                padding-top: 100px; /* Location of the box */
                left: -1%;
                top: 0;
                width: 100%; /* Full width */
                height: 100%; 
                overflow: no-display;
                background-color: rgb(0,0,0); /* Fallback color */
                background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
                margin: auto;
            }
            .modal-content {
                position: relative;
                background-color: #fefefe;
                margin: auto;
                padding: 0;
                border: 1px solid #888;
                width: 80%;
                box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
                -webkit-animation-name: animatecenter;
                -webkit-animation-duration: 5s;
                animation-name: animatecenter;
                animation-duration: 5s;
            }
            .sclose {
                color: white;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .sclose:hover,
            .sclose:focus {
                color: red;
                text-decoration: none;
                cursor: pointer;
            }

            .modal-header {
                padding: 2px 16px;
                background-color: black;
                color: white;
            }

            .modal-body {
                padding: 2px 16px;
            }
            .backg-profile {
                margin-left: 10%;
                background-color: #cce6ff;
                width: 80%;
                padding: auto;
                height: 250px;
                border-radius: 8px;
                border: 1px solid;
            }
            .backg-profile-data {
                margin-left: 8%;
                font-size: 17px;
                margin-bottom: 15%;
                
            }
            .a {
                background-color: orange;
                width: 10%;
                text-align: center;
                border-radius: 0px 8px 0px 8px;
                box-shadow: 0.5px 0.5px 0px 0px;
                margin-left: 90%;
            }
            .a:hover {
                background-color: red;
            }
            input:read-only {
                background-color: #e6e6e6;
            }
        </style>
    </head>
    <body>
        <div class="header w3-card">
            <h1 align="center">PROFILE<br></h1>
        </div>
        <br>
        <a href="<?php echo $pp; ?>"><div class="back-button"><img src = "../img/back-button.png" width = "42.5" height="37.5" /></div></a>
        <h2 align="center"> <font size="5">Hello, <strong><?php echo $_SESSION['a3da707b651c79ecc39a4986516180b2_fname']; ?></strong></font></h2>
        
         <?php if (isset($_SESSION['change'])) : ?>
                    <div id="myPopup-green" class="container">
                        <div class="alert alert-success alert-dismissible">

                            <?php
                            echo $_SESSION['change'];
                            ?>
                        </div>
                    </div>
                <?php endif ?>
                <?php include ('errafterlogin.php'); ?>
        
        <div class="body w3-card-4"">
            <div class="stripe-4 w3-card-4">
                <div class="backg-profile w3-card">
                    <div class="a"><a style="text-decoration: none" href="#" id="myBtn"><font size="1.5">EDIT PROFILE&nbsp;&nbsp;</font></a></div>
                    <div class="backg-profile-data">
                        <table style="border-collapse: separate; border-spacing: 0 1.5em;">
                            <tr>
                                <td>Full Name: </td>
                                <th align="left">&nbsp;<?php echo $_SESSION['a3da707b651c79ecc39a4986516180b2_fname']; ?></th>
                            </tr>
                            <tr>
                                <td>Mobile Number: </td>
                                <th align="left">&nbsp;<?php echo $_SESSION['532c28d5412dd75bf975fb951c740a30_mobile']; ?></th>
                            </tr>
                            
                            <tr>
                                <td>Email ID: </td>
                                <th align="left">&nbsp;<?php echo $_SESSION['0c83f57c786a0b4a39efab23731c7ebc_email']; ?></th>
                            </tr>
                            <tr>
                                <td>Wallet Balance: </td>
                                <th align="left">&nbsp;₹<?php echo $balance; ?></th>
                            </tr>
                        </table>
                    </div>
                </div>  

                <div id="myModal" class="modal">

                    <!-- Modal content -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="sclose">&times;</span>
                            <h2>Update Profile</h2>
                        </div>
                        <div class="modal-body">
                            <br>
                            <form method="post" action="">
                                &nbsp;&nbsp;<label>Name: </label>&nbsp;&nbsp;
                                <input class="w3-input w3-border" name="fname" type="text" value="<?php echo $_SESSION['a3da707b651c79ecc39a4986516180b2_fname']; ?>" placeholder="Enter Name"/>
                                <br>
                                &nbsp;&nbsp;<label>Email: </label>&nbsp;&nbsp;
                                <input class="w3-input w3-border" type="email" value="<?php echo $_SESSION['0c83f57c786a0b4a39efab23731c7ebc_email']; ?>" name="email" placeholder="Enter your Email ID"/>
                                <br>
                                &nbsp;&nbsp;<label>Mobile: </label>&nbsp;&nbsp;
                                <input class="w3-input w3-border" type="text" value="<?php echo $_SESSION['532c28d5412dd75bf975fb951c740a30_mobile']; ?>"  onclick="myFuncMobileUpdate()" readonly/>
                                <br>
                                <input class="w3-button w3-green w3-large" name="ch_em_nm" type="submit" value="Save" class="btn-success"/>
                                <br><br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("myBtn");
    var span = document.getElementsByClassName("sclose")[0];
    btn.onclick = function() {
      modal.style.display = "block";
    }
    span.onclick = function() {
     modal.style.display = "none";
    }
    </script>
    <script>
    function myFuncMobileUpdate() {
        alert("Hey, you are not allowed to update mobile number. Still want to update, contact customer care.");
        }
    </script>
    <script>
        setTimeout(function() {
          $('#myPopup-green').fadeOut('slow');
        }, 2500);
        setTimeout(function() {
          $('#myPopup').fadeOut('slow');
        }, 2500);
    </script>
    <?php
    include ("footer.php");
    ?>
</html>


