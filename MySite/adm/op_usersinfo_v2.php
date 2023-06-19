<?php 
include('op_afterlogin.php');
?>
<?php 
  if (isset($_GET['logout'])) {
  	unset($_SESSION['cf40c61e54a706033144ba6a76fa7fce_opusername']);
        unset($_SESSION['b35d1ea7a896f20de51e7ab5038ed614_opfname']);
        unset($_SESSION['04a725b8d543725b399199a3ea65f8f8_opemail']);
  	header("location: /MySite/adm/operator.php");
  }
?>
<?php
if(isset($_POST['close_user_session'])){
    unset($_SESSION['b80bb7740288fda1f201890375a60c8f_id']);
    unset($_SESSION['a3da707b651c79ecc39a4986516180b2_fname']);
    unset($_SESSION['0c83f57c786a0b4a39efab23731c7ebc_email']);
    unset($_SESSION['532c28d5412dd75bf975fb951c740a30_mobile']);
    unset($_SESSION['head_mode']);
}
?>
<?php
if (isset($_GET['search_param'])) {
    $search_param = $_GET['search_param'];
} else {
    $search_param = "";
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CIS Admin</title>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            footer {
                text-align: center;
                background-color: whitesmoke;
                padding: 2%;
                width: 100%;
                bottom: 0;
                position: fixed;
            }
            .header-nav {
                width: 100%;
                top: 0;
            }
            .form-content {
                padding-top: 5%;
                padding-right: 5%;
                padding-left: 5%;
                padding-bottom: 1%;
                margin-left: 13%;
                margin-right: 13%;
                margin-top: 4%;
                margin-bottom: 6%;
                border-radius: 5px;
            }
            body {
                overflow: scroll;
            }
            .strict-filter {
                padding-left: 4%;
                padding-right: 4%;
                color: lightslategrey;
                text-size: 5px;
                text-align: center;
            }
            input[type="text"] {
                width: 100%;
            }
            .buttonwrapper {
                margin-top: -40.7px;
                margin-left: 94%;
                width: 5%;
            }
            #students {
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #students td, #students th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #students tr:nth-child(odd){background-color: white;}

            #students tr:hover {background-color: #ddd;}
            #students th {
                padding-top: 12px;
                padding-bottom: 12px;
                background-color: orange;
                color: white;
            }
            .tooltip {
                position: relative;
                display: inline-block;
            }

            .tooltip .tooltiptext {
                visibility: hidden;
                width: 100px;
                background-color: #555;
                color: #fff;
                text-align: center;
                border-radius: 6px;
                padding: 6px 0;
                position: absolute;
                z-index: 1;
                top: 125%;
                left: 50%;
                margin-left: -48px;
                opacity: 0;
                transition: opacity 0.3s;
                font-size: 10px;
            }

            .tooltip .tooltiptext::after {
                content: "";
                position: absolute;
                bottom: 100%;
                left: 50%;
                margin-left: -5px;
                border-width: 5px;
                border-style: solid;
                border-color: transparent transparent #555 transparent;
            }

            .tooltip:hover .tooltiptext {
                visibility: visible;
                opacity: 1;
            }
             body {
                background: linear-gradient(90deg, white 21px, transparent 1%) center, linear-gradient(white 21px, transparent 1%) center, #66b2b2;
                background-size: 22px 22px;
            }
            
        </style>
    </head>
    <body>
        <div class="header-nav">
            <div class="w3-container w3-teal">
                <h1 align='center'>CIS Admin Panel</h1>
            </div>
            <div class="w3-contianer">
                <div class="w3-bar w3-border w3-light-grey w3-large w3-card-4">
                    <a href="index.php" class="w3-bar-item w3-button">Home</a>
                    <a href="enrol.php" class="w3-bar-item w3-button">Create Account</a>
                    <a href="#" class="w3-bar-item w3-button w3-red">Search Account</a>
                    <a href="?logout='1'" class="w3-bar-item w3-button"> Logout</a>
                    <a class="w3-bar-item w3-button w3-right"><?php echo $_SESSION['b35d1ea7a896f20de51e7ab5038ed614_opfname']
                    .", <font size='3'>".$_SESSION['8454f46898d7c94cff04ff0f78674193_opdesig']."</font>";?></a>
                </div>
            </div>
        </div>
        <p align="center">
        </p>
        <div class="form-content w3-card-4 w3-light-grey">
            <form action="" method="get">
                <p align="center"><font size="2" color="lightslategrey">Enter anything to search globally or you may use Strict Filter.</font></p>
                <input type="text" class="w3-input w3-border w3-round-large w3-large" name="search_param" value="<?php echo $search_param; ?>" placeholder="Enter required keyword and click Search" required />
                <div align="left" class="buttonwrapper">
                    <button class="w3-button w3-round-large w3-large" type="submit" name="search"><i class="fa fa-search"></i></button>
                </div>
                <p align="center"><font size="2" color="lightslategrey"><a href="#" onclick="useStrictFilter()">Use Strict Filter<a/></font></p>
                <div id="strict-filter" style="display:none">
                    <div class="strict-filter">
                        <font size="2px">
                        <input type="radio" name="strict_filter" value="id" id="1"> <label for="1">ID</label>
                        &nbsp;<input type="radio" name="strict_filter" value="email" id="2"> <label for="2">Email</label>
                        &nbsp;<input type="radio" name="strict_filter" value="fname" id="3"> <label for="3">Full Name</label>
                        &nbsp;<input type="radio" name="strict_filter" value="mobile" id="4"> <label for="4">Mobile</label>
                        &nbsp;<input type="radio" name="strict_filter" value="status" id="5"> <label for="5">Status</label>
                        &nbsp;<input type="radio" name="strict_filter" value="balance" id="6"> <label for=6>Balance</label>
                        </font>
                        <br>
                        <span class="tooltip"><button class="w3-button w3-border" type="reset"><i class="fa fa-refresh"></i></button><span class="tooltiptext">Click me to Reset</span></span>
                    </div>
                </div>
            </form>
            <br><br>

            <?php
            class search {
                public $search_param;
                public $filter;
                
                public function set_param($param1, $param2) {
                    $this->search_param = $param1;
                    $this->filter = $param2;
                }
            }
            //Search Time
            $start_time = microtime(true);

            //Main Code
            if (isset($_GET['search'])) {
                $server = 'localhost';
                $user = 'root';
                $pass = '';
                $db_user = 'registration';
                $db_admin = 'site';
                
                if (isset($_GET['strict_filter'])) {
                    $strict_filter = $_GET['strict_filter'];
                } else {
                    $strict_filter = "";
                }
                if (isset($_GET['search_param'])) {
                    $search_param = $_GET['search_param'];
                } else {
                    $search_param = "";
                }
                $data = new search();
                $data->set_param($search_param, $strict_filter);

                $db_conn_user = new mysqli($server, $user, $pass, $db_user);
                if ($db_conn_user->connect_error) {
                    die("Connection failed: " . $db_conn_user->connect_error);
                }
                
                 if (isset($_GET['strict_filter'])) {
                        $query = $db_conn_user->prepare("SELECT * FROM users WHERE $data->filter = ?");
                        $query->bind_param("s", $data->search_param);
                        $query->execute();
                        $output = $query->get_result();
                    } else {
                        $query = $db_conn_user->prepare("SELECT * FROM users WHERE id=? OR email=? OR fname=? OR mobile=? OR acc_status=? OR balance=?");
                        $query->bind_param("ssssss", $data->search_param, $data->search_param, $data->search_param, 
                                $data->search_param, $data->search_param, $data->search_param);
                        $query->execute();
                        $output = $query->get_result();
                    }
                
                if (isset($output->num_rows)) {
                    if ($output->num_rows > 0) {

                        echo '<table border="1px" id="students">
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Full Name</th>
                        <th>Mobile</th>
                        <th>Balance</th>
                        <th>Status</th>
                        <th>Enable/Disable</th>
                        <th>Session</th>
                        <th>Head Mode</th>
                    </tr>';
                        $sno=0;
                        while ($fetch = $output->fetch_assoc()) {

                            $sno += 1;
                            $id = $fetch['id'];
                            $fname = $fetch['fname'];
                            $email = $fetch['email'];
                            $mobile = $fetch['mobile'];
                            $status = $fetch['acc_status'];
                            $balance = $fetch['balance'];
                            
                            echo '<tr>';
                            echo '<td>'.$id.'</td>';
                            echo '<td>'.$email.'</td>';
                            echo '<td>'.$fname.'</td>';
                            echo '<td>'.$mobile.'</td>';
                            echo '<td>'.$balance.'</td>';
                            if ($status == 'Disable') {
                            echo '<td><font color="red"><strong>'.$status.'</strong></font></td>';
                            }
                            else {
                                echo '<td><font color="green"><strong>'.$status.'</strong></font></td>';
                            }
                            echo '<td>';
                            echo '<form align="center" method="post" action="">
                            <input type="hidden" name="username" value="'.$mobile.'"><br><br>';
                             if($status == 'Disable') {
                            echo '<input type="submit" class="w3-button w3-blue" onclick=alert("Do you really want to enable the user?") name="enable_user" value="Enable">';
                             }
                             else {
                            echo '<input type="submit" class="w3-button w3-blue" onclick=confirm("Do you really want to disable the user?") name="disable_user" value="Disable">';
                                }
                                echo '<td>';
                            
                                if(isset($_SESSION['532c28d5412dd75bf975fb951c740a30_mobile'])) {
                                if($_SESSION['532c28d5412dd75bf975fb951c740a30_mobile'] == $mobile) {
                                echo '<font color="green">Active</font><br>';
                                echo '<br><form method="post" action=""><input class="w3-button w3-red" type="submit" value="Close Session" name="close_user_session"></form>';
                                  }
                                }
                               else {
                                    echo '<font color="black">Not Active</font>';
                                 }
                                
                                echo '</td>';    
                            echo '<td>';
                            echo '<form method="post" action=""><input type="hidden" name="username" value="'.$mobile.'"><input class="w3-button w3-green" type="submit" value="Login As" name="head_mode"></form>';
                            echo '</td>';
                            echo '</form>';
                            echo '</tr>';
                        }
                        echo '</table>';
                        //Search Time
                        echo '<br><br><br>';
                        $end_time = microtime(true);
                        $execution_time = ($end_time - $start_time);
                        echo "<p align='right'><font size='1px' color='lightslategrey'>"
                        . $output->num_rows . " result(s) in " . number_format((float) $execution_time, 8, '.', '') . " sec</font></p>";
                    } else {
                        echo "<p align='center'><font color='red'>No result found!</font></p><br>";
                    }
                } else {
                    echo "<p align='center'><font color='red'>Error in connecting to the attribute(s) of the table!</font></p>";
                }
            }
            
            
            ?>
            </table>
        </div>

        <footer class="w3-card-2">
            Designed and Developed by Gulfarogh Azam<br>Faculty Number: 18CAB105<br>Enrollment Number: GL0210
        </footer>
        <script>
            function useStrictFilter() {
                var x = document.getElementById('strict-filter');
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }
        </script>
    </body>
</html>
