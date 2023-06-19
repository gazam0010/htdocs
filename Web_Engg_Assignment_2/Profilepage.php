   <?php
      class person {
      public $f_name = "";
      public $l_name = "";
      public $enrol = "";
      public $roll = "";
      public $email = "";
      public $program = "";
      function set_value($p1, $p2, $p3, $p4, $p5, $p6) {
          $this->f_name = $p1;
          $this->l_name = $p2;
          $this->enrol = $p3;
          $this->roll = $p4;
          $this->email = $p5;
          $this->program = $p6;
      }
    }
    function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }
          if (isset($_POST['submit'])) {

              $servername = 'localhost';
              $username = 'root';
              $password = '';
              $database = 'db';
            
              $obj = new person();
              $obj->set_value($_POST['firstname'], $_POST['lastname'], $_POST['enroll'], $_POST['roll'], $_POST['email'], $_POST['program']);
              $conn = new mysqli($server, $username, $password, $database);

              $set = $conn->prepare("INSERT INTO data (fname, lname, enroll, roll, email, program)
                                VALUES (?, ?, ?, ?, ?, ?)");
                  $set->bind_param("ssssss", $obj->f_name, $obj->l_name, $obj->enrol, $obj->roll, $obj->email, $obj->program);
                  $set->execute();
                  echo '<script type="text/javascript">alert("Success!")</script>';
          }
?>
 <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <title>Profile Page</title>
    </head>
    <body style="background-color: aqua;">
        <div class="header" style="padding-top: 130px;">
            <div class="fixed-top">
                <div class="bg-success text-center font-weight-bolder col "style="line-height:2; font-size:30px  ">ASSIGNMENT-2</div>
                <nav class="navbar navbar-expand-lg navbar-dark " style="background-color: rgb(12, 84, 94);">
                <a class="navbar-brand" href="#"><i class="fa fa-user " style="color: black;"></i> Profile</a>
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
        <div class="container-fluid">
            <form method="post" action="">
                <div class="form-row">
                    <div class="col-sm-10 my-2">
                        <label for="validationServer01" class="col-sm-2">First Name:</label>
                        <input type="text" class="is-valid col-sm-3" placeholder="Waquar" name="firstname" value required>   
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-10 my-2">
                        <label for="validationServer01" class="col-sm-2">Last Name:</label>
                        <input type="text" class="is-valid col-sm-3" placeholder="Mahboob" name="lastname" value required>   
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-10 my-2">
                        <label for="validationServer01" class="col-sm-2">Enrollment No.:</label>
                        <input type="text" class="is-valid col-sm-3"  placeholder="GI9823" name="enroll" value required>   
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-10 my-2">
                        <label for="validationServer01" class="col-sm-2">Roll No.:</label>
                        <input type="text" class="is-valid col-sm-3"  placeholder="18CAB018" name="roll" value required>   
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-10 my-2">
                        <label for="validationServer01" class="col-sm-2">Email Id:</label>
                        <input type="text" class="is-valid col-sm-3" placeholder="abc@gmail.com" name="email" value required>   
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-10 my-2">
                        <label for="validationServer01" class="col-sm-2">Program of Study:</label>
                        <input type="text" class="is-valid col-sm-3"  placeholder="BSc(Computer Science)" name="program"value required>   
                    </div>
                </div>
                <button class="btn btn-danger" type="submit" name="submit">Submit form</button>
            </form>
            <div style="padding-top: 90px;">
                <div class="fixed-bottom text-muted text-center" style="background-color: rgb(12, 84, 94);">
                    <div>Waquar Mahboob</div>
                    <div>18CAB018</div>
                    <div>GI9823</div>
                </div>
            </div>
        </div>
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   
    </body>
    </html>