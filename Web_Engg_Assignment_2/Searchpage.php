<!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <title>Search Page</title>
    </head>
    <body style="background-color: aqua;">
        <div class="header" style="padding-top: 130px;">
            <div class="fixed-top">
                <div class="bg-success text-center font-weight-bolder col "style="line-height:2; font-size:30px  ">ASSIGNMENT-2</div>
                <nav class="navbar navbar-expand-lg navbar-dark " style="background-color: rgb(12, 84, 94);">
                    <a class="navbar-brand" href="#"><i class="fa fa-search " style="color: black;"></i> Search</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-item nav-link" href="Homepage.html"> Home </a>
                        </div>
                    </div>
                </nav>
            </div>      
        </div>
        <div class="container col-sm">
            <form action="" method="post">
                <div class="form-row">
                    <div class="col-sm-10 my-2">
                        <label for="validationServer01" class="col-sm-2">Program of Study:</label>
                        <input type="text" class="is-valid col-sm-3" placeholder="Search..." name="search_key" value >
<select style="width: 50%;" name="option" id="option" required>
  <option>------</option>
  <option value="firstname">First Name</option>
  <option value="lastname">Last Name</option>
  <option value="enroll">Enrollment Number</option>
  <option value="roll">Roll Number</option>
  <option value="email">Email</option>
  <option value="program">Program of Study</option>
</select>
                        <button class="btn btn-primary" type="submit" name="submit"> Search </button>  
                    </div>
                </div>
            </form>
           
       
       
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
                $database = 'register';
               
                $x = new fetch();
                $search_key = $_POST['search_key'];
                $option = $_POST['option'];
                $x->set_data($search_key, $option);

                $conn = new mysqli($servername, $username, $password, $database);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
               
                        $stmnt = $conn->prepare("SELECT * FROM students WHERE $x->option = ?");
                        $stmnt->bind_param("s", $x->search_key);
                        $stmnt->execute();
                        $result = $stmnt->get_result();
                   
               
                    if ($result->num_rows > 0) {
                       
                    echo '<table>
                         <tr>
                           <th>Name</th>
                           <th>Enrollment No.</th>
                           <th>Roll No.</th>
                           <th>Email</th>
                           <th>Program of Study</th>
                        </tr>';
                        while ($row = $result->fetch_assoc()) {

                            echo "<tr>";
                            echo "<td>";
                            echo $row['firstname']." ".$row['lastname'];
                            echo "</td>";
                            echo "<td>";
                           
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
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div style="padding-top: 90px;">
                <div class="fixed-bottom text-muted text-center" style="background-color: rgb(12, 84, 94);">
                    <div>Waquar Mahboob</div>
                    <div>18CAB018</div>
                    <div>GI9823</div>
                </div>
            </div>
 
    </body>
    </html>