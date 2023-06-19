<?php

class person {

    public $fname = "";
    public $lname = "";
    public $enrol = "";
    public $roll = "";
    public $email = "";
    public $program = "";

    function set_value($p1, $p2, $p3, $p4, $p5, $p6) {
        $this->fname = $p1;
        $this->lname = $p2;
        $this->enrol = $p3;
        $this->roll = $p4;
        $this->email = $p5;
        $this->program = $p6;
    }

}

if (isset($_POST['submit'])) {

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'db';
   
    $obj = new person();
    $obj->set_value($_POST['fname'], $_POST['lname'], $_POST['enrol'], $_POST['roll'], $_POST['email'], $_POST['program']);
    $conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

   $set = $conn->prepare("INSERT INTO data (fname, lname, enroll, roll, email, program)
                      VALUES (?, ?, ?, ?, ?, ?)");
        $set->bind_param("ssssss", $obj->fname, $obj->lname, $obj->enrol, $obj->roll, $obj->email, $obj->program);
        $set->execute();
        echo 'Success!';
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        form{
            background-color: #a94242;
            position: absolute;
            left: 0px;
            align-items: initial;
            display: flex;
            flex-direction: column;
            height: 660px;
            width: 100%;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create profile page</title>
</head>
<body style="background-color: #66d1d5;">
    <h2 style="background-color: #a59a6f; text-align: center; padding-top: 5px; padding-bottom: 5px; margin: 0px;">Second Assignment Format</h2>
    <h4 style="background-color: #607599; margin: 8px 0px 10px 0px; padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">Home</h4>
    <form action="" method="POST">
        <div style="width: 120px; position: absolute; left: 50px; top: 30px;">
        First Name: <input type="text" name="fname" id="fname">
        Last Name:  <input type="text" name="lname" id="lname">
        Enrolment No.: <input type="text" name="enrol" id="enrol">
        Roll No.:  <input type="text" name="roll" id="roll">
        email id:  <input type="email" name="email" id="email">
        Programe of study:  <input type="text" name="program">
        <button type="submit" name="submit">Submit</button>
        </div>
    </form>
</body>
</html>