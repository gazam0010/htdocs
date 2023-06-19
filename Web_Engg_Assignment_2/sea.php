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
        Search Here: <input type="text" name="search_key" placeholder="Search...">
        <select style="width: 50%;" class="w3-select" name="option" id="option" required>
  <option>------</option>
  <option value="fname">First Name</option>
  <option value="lname">Last Name</option>
  <option value="enroll">Enrollment Number</option>
  <option value="roll">Roll Number</option>
  <option value="email">Email</option>
  <option value="program">Program of Study</option>
</select>
        <button type="submit" name="submit">Submit</button>
        
    </form>
<table border="1px" style="border-collapse: collapse">
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
                   
                
            }
            
            
            ?>
            </table>
</div>
</body>
</html>





