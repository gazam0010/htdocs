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
            <li><a style="color: aliceblue;"href="register.php">Create Profile</a></li>
            <li><a class="active"  href="search.php">Search Profile</a></li>
        </ul>
    </nav>
    <div class="content">
<form action="" method="post">
<input type="text" class="w3-input" name="search_key" value="" placeholder="Search..." required />
                <br>
                    
                <label for="option">Choose an option:</label>
<br>
<select style="width: 50%;" class="w3-select" name="option" id="option" required>
  <option>------</option>
  <option value="fname">First Name</option>
  <option value="lname">Last Name</option>
  <option value="enroll">Enrollment Number</option>
  <option value="roll">Roll Number</option>
  <option value="email">Email</option>
  <option value="program">Program of Study</option>
</select>
                        
<br><br>
<button class="w3-btn w3-blue w3-large" type="submit" name="submit">Click here to search</button>
<br><br>
<button class="w3-btn w3-blue w3-large" type="reset">Reset</button>
</form>
   
<br><br>
<table border="1px" style="border-collapse: collapse; border: 1px solid black; width: 100%;">
                    <tr>
                        <th>Name</th>
                        <th>Enrollment No.</th>
                        <th>Roll No.</th>
                        <th>Email</th>
                        <th>Program of Study</th>
                    </tr>


            <?php
            class fetch {
                public $search_key;
                public $option;
                
                public function set_data($p1, $p2) {
                    $this->search_key = $p1;
                    $this->option = $p2;
                }
            }

            if (isset($_POST['submit'])) {
                $servername = 'localhost';
                $username = 'root';
                $password = '';
                $database = 'db';
                
                $x = new fetch();
                $search_key = $_POST['search_key'];
                $option = $_POST['option'];
                $x->set_data($search_key, $option);

                $conn = new mysqli($servername, $username, $password, $database);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                        $stmnt = $conn->prepare("SELECT * FROM data WHERE $x->option = ?");
                        $stmnt->bind_param("s", $x->search_key);
                        $stmnt->execute();
                        $result = $stmnt->get_result();
                   
                
                    if ($result->num_rows > 0) {

                        

                        while ($row = $result->fetch_assoc()) {

                            echo "<tr>";
                            echo "<td>";
                            echo $row['fname']." ".$row['lname'];
                            echo "</td>";
                            echo "<td>";
                            echo $row['enroll'];
                            echo "</td>";
                            echo "<td>";
                            echo $row['roll'];
                            echo "</td>";
                            echo "<td>";
                            echo $row['email'];
                            echo "</td>";
                            echo "<td>";
                            echo $row['program'];
                            echo "</td>";
                            
                            echo "</tr>";
                        }
                        
                    } else {
                        echo "<p align='center'>No Result</p><br>";
                    }
                    echo '</table>';
                
            }
            
            
            ?>
            </table>
            </div>
            <footer style="text-align: center; background-color: lightgrey; padding: 2%;">
            Name: Tausif Anwar (18CAB103) (GL0230)
        </footer>
        </body>
        </html>