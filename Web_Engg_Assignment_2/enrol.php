<?php

class Students {

    public $first_name = "";
    public $last_name = "";
    public $enrl_no = "";
    public $fac_no = "";
    public $email = "";
    public $prog = "";

    function insert_value($param1, $param2, $param3, $param4, $param5, $param6) {
        $this->first_name = $param1;
        $this->last_name = $param2;
        $this->enrl_no = $param3;
        $this->fac_no = $param4;
        $this->email = $param5;
        $this->prog = $param6;
    }

}

$errors = array();
$success = array();
if (isset($_POST['save_details'])) {
    $server = 'localhost';
    $user = 'root';
    $pass = '';
    $db_name = 'student';


    $reg = new Students();
    $reg->insert_value($_POST['first_name'], $_POST['last_name'], $_POST['enrl'], $_POST['fac'], $_POST['email'], $_POST['prog']);

    $db_conn = new mysqli($server, $user, $pass, $db_name);
    if ($db_conn->connect_error) {
        die("Connection failed: " . $db_conn->connect_error);
    }

    if (empty($reg->first_name)) {
        array_push($errors, 'First Name cannot be left blank');
    }
    if (empty($reg->last_name)) {
        array_push($errors, 'Last Name cannot be left blank');
    }

    //ENROLLMENT NUMBER VALIDATION
    if (empty($reg->enrl_no)) {
        array_push($errors, 'Enrollment Number cannot be left blank');
    } else if (strlen($reg->enrl_no) < 6) {
        array_push($errors, "Enrollment number should be six digits E.g. AA1234");
    } else {
        $enrollment_char = substr($reg->enrl_no, 0, -4);
        $enrollment_num = substr($reg->enrl_no, 2);

        if (is_numeric($enrollment_char) || !is_numeric($enrollment_num)) {
            array_push($errors, "Enter enrollment number in proper format E.g. AA1234");
        }
    }

    if (empty($reg->fac_no)) {
        array_push($errors, 'Faculty Number cannot be left blank');
    }
    if (empty($reg->email)) {
        array_push($errors, 'Email ID cannot be left blank');
    }
    if (empty($reg->prog)) {
        array_push($errors, 'Program cannot be left blank');
    }

    //ENROLLMENT AND FACULTY EXISTENCE CHECK
    $query = $db_conn->prepare("SELECT * FROM details WHERE enrl=? OR fac=? OR email=? LIMIT 1");

    $query->bind_param('sss', $reg->enrl_no, $reg->fac_no, $reg->email);
    $query->execute();
    $output = $query->get_result();
    if ($output->num_rows > 0) {
        while ($data = $output->fetch_assoc()) {
            if ($data['enrl'] == $reg->enrl_no) {
                array_push($errors, 'Enrolment Number already registered');
            }
            if ($data['fac'] == $reg->fac_no) {
                array_push($errors, 'Faculty Number already registered');
            }
            if ($data['email'] == $reg->email) {
                array_push($errors, 'Email ID already registered');
            }
        }
    }

    if (count($errors) == 0) {
        $full_name = $reg->first_name." ".$reg->last_name;
        $store = $db_conn->prepare("INSERT INTO details (first_name, last_name, full_name, enrl, fac, email, prog)
                      VALUES (?, ?, ?, ?, ?, ?, ?)");
        $store->bind_param("sssssss", $reg->first_name, $reg->last_name, $full_name, $reg->enrl_no, $reg->fac_no, $reg->email, $reg->prog);
        $store->execute();
        array_push($success, 'Your Account Has Been Successfully Created!');
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student Register</title>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <style>
            footer {
                text-align: center;
                background-color: whitesmoke;
                padding: 2%;
                width: 100%;
                bottom: 0;
            }
            .form-content {
                padding-top: 2%;
                padding-right: 6%;
                padding-left: 6%;
                padding-bottom: 4%;
                padding-bottom: 7%;
                margin-left: 13%;
                margin-right: 13%;
                margin-top: 4%;
                margin-bottom: 4%;
            }
            .header-nav {
                width: 100%;
                top: 0;
            }
            .msg {
                width: 17%;
                position: fixed;
                right: 0;
            }
            .msg-container {
                padding: 4%;
                border-radius: 10px;
            }
            .closebtn {
                margin-left: 15px;
                color: white;
                font-weight: bold;
                float: right;
                font-size: 22px;
                line-height: 20px;
                cursor: pointer;
                transition: 0.3s;
            }

            .closebtn:hover {
                color: black;
            }
            body {
                overflow: scroll;
                background: linear-gradient(90deg, white 21px, transparent 1%) center, linear-gradient(white 21px, transparent 1%) center, #66b2b2;
                background-size: 22px 22px;
            }
            .next-btn {
                border-radius: 4px;
                background-color: #f4511e;
                border: none;
                color: #FFFFFF;
                text-align: center;
                font-size: 18px;
                padding: 8px;
                width: 100px;
                transition: all 0.5s;
                cursor: pointer;
                margin: 5px;
            }

            .next-btn span {
                cursor: pointer;
                display: inline-block;
                position: relative;
                transition: 0.5s;
            }

            .next-btn span:after {
                content: '\00bb';
                position: absolute;
                opacity: 0;
                top: 0;
                right: -20px;
                transition: 0.5s;
            }

            .next-btn:hover span {
                padding-right: 25px;
            }

            .next-btn:hover span:after {
                opacity: 1;
                right: 0;
            }
            .back-btn {
                border-radius: 4px;
                background-color: #f4511e;
                border: none;
                color: #FFFFFF;
                text-align: center;
                font-size: 18px;
                padding: 8px;
                width: 100px;
                transition: all 0.5s;
                cursor: pointer;
                margin: 5px;
            }

            .back-btn span {
                cursor: pointer;
                display: inline-block;
                position: relative;
                transition: 0.5s;
            }

            .back-btn span:after {
                content: '\00ab';
                position: absolute;
                opacity: 0;
                top: 0;
                left: -20px;
                transition: 0.5s;
            }

            .back-btn:hover span {
                padding-left: 25px;
            }

            .back-btn:hover span:after {
                opacity: 1;
                left: 0;
            }
            .form-part-curr {
                margin-left: 10px;
                border-radius: 50%;
                border: 1px solid grey;
                width: 34px;
                height: 34px;
                padding: 5px 9px 5px 11px;
                background-color: grey;
                color: white;
            }
            .form-part-notcurr {
                margin-left: 10px;
                border-radius: 50%;
                border: 1px solid grey;
                width: 34px;
                height: 34px;
                padding: 5px 9px 5px 11px;
                color: black;
            }
        </style>
    </head>
    <body>
        <div class="header-nav">
            <div class="w3-container w3-position w3-teal">
                <h1 align='center'>Student's Register</h1>
            </div>

            <div class="w3-contianer">
                <div class="w3-bar w3-border w3-light-grey w3-large w3-card-4">
                    <a href="index.php" class="w3-bar-item w3-button">Home</a>
                    <a href="#" class="w3-bar-item w3-button w3-red">Create Account</a>
                    <a href="search.php" class="w3-bar-item w3-button">Search Account</a>
                </div>
            </div>
            <br>
<?php include('alert.php'); ?>
        </div>
        <div class="w3-container">
        <div class="form-content w3-card-4 w3-light-grey">
            <div id="part1">
            <span class="form-part-notcurr w3-right">2</span><span > </span>
            <span class="form-part-curr w3-right"">1</span>
            
            <h2 align="left">Enter Your Details</h2>
            <hr class="w3-grey">
            <form method="post" action="">
                
                    <font color="red" size="2"> <p align="left" id="empty_part1"></p></font>
                    <p>
                        <label>Full Name: </label><br>
                        <input class="w3-input w3-border w3-round-large" id="first_name"  type="text" name="first_name" placeholder=" First Name" required><br>
                        <input class="w3-input w3-border w3-round-large" id="last_name"  type="text" name="last_name" placeholder=" Last Name" required>
                    </p>
                    <p>
                        <label>Enrollment Number: </label>
                        <input class="w3-input w3-border w3-round-large" maxlength="6"  type="text" name="enrl" id="enrl" onblur="return constValidate()" placeholder="GA1111" onkeyup="this.value = this.value.toUpperCase();" required>
                    <p id="error-enrl"></p>
                    </p>

                    <p>
                        <label>Faculty/Roll Number: </label>
                        <input class="w3-input w3-border w3-round-large" id="fac"  type="text" maxlength="9" name="fac" id="fac" 
                               placeholder="18CAB000" onkeyup="this.value = this.value.toUpperCase();" required>
                    </p>

                    <p align="right"><button class="next-btn" onclick="return displayNext()"><span>Next </span></button></p>
                </div>

                <div id="part2">
                    
                    <span class="form-part-curr w3-right">2</span><span > </span>
            <span class="form-part-notcurr w3-right"">1</span>
            
            <h2 align="left">Enter Your Details</h2>
            <hr class="w3-grey">
            <form method="post" action="">

                    <p align="right"><button class="back-btn" onclick="displayBack()"><span> Back</span></button></p>   
                    <p>
                        <label>Email ID: </label>
                        <input class="w3-input w3-border w3-round-large" type="email" name="email" id="email" placeholder="abc@example.com" required>
                    </p>


                    <p>
                        <label>Program of Study: </label>
                        <input class="w3-input w3-border w3-round-large" type="text" name="prog" id="prog" placeholder="Computer Applications" required>
                    </p>
                    <p>
                        <button type="submit" name="save_details" onclick="return confirmSubmit();" class="w3-button w3-black w3-left w3-large">Save</button>
                        <button type="reset" class="w3-button w3-black w3-right w3-large">Reset</button>
                    </p>
                </div>
            </form>
        </div>
        </div>
        <footer class="w3-card-2">
            Designed and Developed by Gulfarogh Azam<br>Faculty Number: 18CAB105<br>Enrollment Number: GL0210
        </footer>
        <script>
            function constValidate() {
                var str = document.getElementById("enrl").value;
                var st = str.charAt(0);
                var st1 = str.charAt(1);
                var st2 = str.charAt(2);
                var st3 = str.charAt(3);
                var st4 = str.charAt(4);
                var st5 = str.charAt(5);
                if (!isNaN(st) || !isNaN(st1)) {
                    document.getElementById("error-enrl").innerHTML = "<font size='2' color='red'>Please enter in proper format. E.g. AA1234</font>";
                    return false;
                } else if (isNaN(st2) || isNaN(st3) || isNaN(st4) || isNaN(st5)) {
                    document.getElementById("error-enrl").innerHTML = "<font size='2' color='red'>Please enter in proper format. E.g. AA1234</font>";
                    return false;
                } else if (str.length < 6) {
                    document.getElementById("error-enrl").innerHTML = "<font size='2' color='red'>Enrollment number should be six digits. E.g. AA1234</font>";
                    return false;
                } else {
                    document.getElementById("error-enrl").innerHTML = "";
                    return true;
                }
            }
        </script>

        <script>
            var x = document.getElementById('part2');
            x.style.display = "none";
        </script>
        <script>
            function displayNext() {
                var x = document.getElementById('part1');
                var y = document.getElementById('part2');
                var a = document.getElementById('first_name').value;
                var aa = document.getElementById('last_name').value;
                var b = document.getElementById('enrl').value;
                var c = document.getElementById('fac').value;
                if (a === "" || aa === "" || b === "" || c === "") {
                    document.getElementById("empty_part1").innerHTML = "*Please fill out every field";
                    return false;
                }
                x.style.display = "none";
                y.style.display = "block";
                document.getElementById("empty_part1").innerHTML = "";
                return true;
            }
        </script>
        <script>
            function displayBack() {
                var x = document.getElementById('part1');
                var y = document.getElementById('part2');
                x.style.display = "block";
                y.style.display = "none";
            }
        </script>
        <script>
            function confirmSubmit() {
                var a = document.getElementById('first_name').value;
                var aa = document.getElementById('last_name').value;
                var b = document.getElementById('enrl').value;
                var c = document.getElementById('fac').value;
                var d = document.getElementById('email').value;
                var e = document.getElementById('prog').value;
                if (confirm("Please Verify Details: \nName: " + a + " " + aa + "\nEnrl. No.: " + b + "\nFaculty No.: " + c
                        + "\nEmail ID.: " + d + "\nProgram: " + e)) {
                    return true;
                }
                return false;
            }
        </script>
    </body>
</html>
