<?php
if (isset($_GET['did'])) {

    $selectedDid = $_GET['did'];
    $name = $_GET['name'];
    $specialization = $_GET['spec'];

} else {
    header("location:appointment.php");
    exit();
}
?>
<html>

<head>
    <title>
        Book appointment
    </title>
    <style>
        #form {
            margin: 50px 100px 100px 100px;
      padding: 20px 50px 50px 50px;
      background-color: lightblue;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .but {
            display: inline-block;
            float: right;
            padding: 6px 12px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
            border: none;
        }
    </style>
</head>

<body>
    <div id="form">
        <h3 align="center">Step 2</h3>
        <br><br>
        <p>Specialization: <strong>
                <?php echo $specialization; ?>
            </strong></p>
        <p>Doctor Name: <strong>
                <?php echo $name; ?>
            </strong></p>
        Date: <input type="text"><br><br>
        Time: <input type="text"><br><br>
        Description: <input type="text"><br><br><br>
        <input class="but" type="submit" value="Book Appointment">
    </div>

</body>

</html>