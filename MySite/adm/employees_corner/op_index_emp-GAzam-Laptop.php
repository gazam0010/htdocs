<?php
include('op_afterlogin_emp.php');
?>
<?php
if (isset($_GET['logout'])) {
    unset($_SESSION['cf40c61e54a706033144ba6a76fa7fce_opusername']);
    unset($_SESSION['b35d1ea7a896f20de51e7ab5038ed614_opfname']);
    unset($_SESSION['04a725b8d543725b399199a3ea65f8f8_opemail']);
    header("location: /MySite/adm/operator.php");
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>
        Welcome Admin
    </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIS Admin</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        .vl {
            border-left: 2px solid grey;
            height: 15px;
        }
        

    </style>
</head>

<body>
    <div class="header-nav">
        <div class="w3-container w3-teal">
            <h1 align='center'>CIS Admin Panel</h1>
            <h6 align='center'>Employees Control</h6>
        </div>
        <div class="w3-contianer">
            <div class="w3-bar w3-border w3-light-grey w3-card-4">
                <a href="#" class="w3-bar-item w3-button w3-red">Home</a>
                <a href="op_empinfo.php" class="w3-bar-item w3-button">Search Account</a>
                <a href="requests_resolution.php" class="w3-bar-item w3-button">Requests</a>
                <a href="?logout='1'" class="w3-bar-item w3-button"> Logout</a>
                <a href="../op_index.php" class="w3-bar-item w3-button w3-border w3-round"> User Control</a>
                <a href="op_profile.php" class="w3-bar-item w3-button w3-right"><span class="vl"></span>
                &nbsp;&nbsp;<?php echo $_SESSION['b35d1ea7a896f20de51e7ab5038ed614_opfname']
                                                                . ", <font size='3'>" . $_SESSION['8454f46898d7c94cff04ff0f78674193_opdesig'] . "</font>"; ?></a>
            </div>
        </div>
    </div>
</body>

</html>