<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Document</title>
    <style>
        nav{
            margin: 0;
            margin-right: 0px;
            background-attachment: fixed; 
            background-color: lightseagreen;
        
            }
        li{
            margin: 0;
            padding: 0;
            list-style-type: none; 
            display: inline-block;   
            margin: 10px;
            padding: 10px 10px;      
            text-align: center;   
            font-size: 25px; 
             }
       
       .active{
           background-color: red;
           color: black;
       }
       a {
           text-decoration: none;
       }
       td{
           margin: 0;
           padding: 5px;
           font-size: x-large;
       }
       .text{
           padding: 5px 20px;
           font-size: large;
       }
       .button{
           padding: 5px 8px;
           cursor: pointer;
       }
       .content {
           background-color: lightblue;
           margin-top: 3%;
           margin-left: 8%;
           margin-right: 8%;
           margin-bottom: 3%;
           padding: 5%;
       }
    </style>
</head>
<body bgcolor="whitesmoke">
    <nav>
        <ul>
        <li><a style="color: aliceblue;" href="home.php">Home</a></li>
            <li><a class="active" style="color: aliceblue;"  href="register.php">Create Profile</a></li>
            <li><a style="color: aliceblue;" href="search.php">Search Profile</a></li>
        </ul>
    </nav>
    <div class="content">
    <form action="" method="post">
    <table>
        <tr>
            <td>
                First Name:
            </td>
            <td>
                <input name="fname" type="text" placeholder="First Name">
            </td>  
        </tr>
        <tr>
            <td>
                Last Name:
            </td>  
            <td>
                <input name="lname" type="text" placeholder="Last Name" >
            </td>
      </tr>
      <tr>
          <td>
              Enrollment No.:
          </td>
          <td>
              <input name="enrol" type="text" placeholder="Ex. like 'GI-0334'">
          </td>
      </tr>
      <tr>
        <td>
            Roll No.:
        </td>
        <td>
            <input name="roll" type="text" placeholder="Ex. like '18CAB103'" >
        </td>  
    </tr>
    <tr>
        <td>
            Email Id:
        </td>
        <td>
            <input name="email" type="text" placeholder="Email Id" >
        </td>  
    </tr>
    <tr>
        <td>
            Program of Study:
        </td>
        <td>
        <input type="text" name="program" placeholder="choose your program">  
        </td>  
    </tr>
    </table>
<input type="submit" class="w3-btn w3-blue" name="submit">
</form>
 </div>
            <footer style="text-align: center; background-color: lightgrey; padding: 2%;">
            Name: Tausif Anwar (18CAB103) (GL0230)
        </footer>
        </body>
        </html>
        

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
function successAlertMsg($data) {
    echo '<script type="text/javascript">alert("' . $data . '")</script>';
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
        successAlertMsg(   "Account Successfully Registered!"   );
}

?>
        