<?php
include('op_afterlogin_emp.php');
$logged_username = $_SESSION['cf40c61e54a706033144ba6a76fa7fce_opusername'];
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
    <link rel="stylesheet" href="../usersinfo/usersinfo.css?version=1">
    </link>
</head>

<body>
    <div class="header-nav">
        <div class="w3-container w3-teal">
            <h1 align='center'>CIS Admin Panel</h1>
            <h6 align='center'>Employees Control</h6>
        </div>
        <div class="w3-contianer">
            <div class="w3-bar w3-border w3-light-grey w3-card-4">
                <a href="op_index_emp.php" class="w3-bar-item w3-button">Home</a>
                <a href="#" class="w3-bar-item w3-button w3-red">Search Account</a>
                <a href="requests_resolution.php" class="w3-bar-item w3-button">Requests</a>
                <a href="?logout='1'" class="w3-bar-item w3-button"> Logout</a>
                <a href="../op_index.php" class="w3-bar-item w3-button w3-border w3-round"> User Control</a>
                <a href="op_profile.php" class="w3-bar-item w3-button w3-right"><span class="vl"></span>
                    &nbsp;&nbsp;<?php echo $_SESSION['b35d1ea7a896f20de51e7ab5038ed614_opfname']
                                    . ", <font size='3'>" . $_SESSION['8454f46898d7c94cff04ff0f78674193_opdesig'] . "</font>"; ?></a>
            </div>
        </div>
    </div>
    <p align="center">
    </p>
    <div class="body-main">
        <div class="body-content">
            <div class="form-content w3-card-4 w3-light-grey" style="padding: 2%;">
                <form action="" method="get">
                    <p align="center">
                        <font size="2" color="lightslategrey">Enter anything to search globally or you may use Strict Filter.</font>
                    </p>
                    <input type="text" class="w3-input w3-border w3-round-large w3-large" name="search_param" value="<?php echo $search_param; ?>" placeholder="Enter required keyword and click Search" required />
                    <div align="left" class="buttonwrapper">
                        <button class="w3-button w3-round-large w3-large" type="submit" name="search"><i class="fa fa-search"></i></button>
                    </div>
                    <p align="center">
                        <font size="2" color="lightslategrey"><a href="#" onclick="useStrictFilter()">Use Strict Filter<a /></font>
                    </p>
                    <div id="strict-filter" style="display:none">
                        <div class="strict-filter">
                            <font size="2px">
                                &nbsp;<input type="radio" name="strict_filter" value="emp_id" id="4"> <label for="4">Employee ID</label>
                                &nbsp;<input type="radio" name="strict_filter" value="email" id="2"> <label for="2">Email</label>
                                &nbsp;<input type="radio" name="strict_filter" value="fname" id="3"> <label for="3">Full Name</label>
                                &nbsp;<input type="radio" name="strict_filter" value="username" id="5"> <label for="5">Username</label>
                            </font>
                            <br>
                            <span class="tooltip"><button class="w3-button w3-border" type="reset"><i class="fa fa-refresh"></i></button><span class="tooltiptext">Click me to Reset</span></span>
                        </div>
                    </div>
                </form>
                <br><br>

                <?php
                class search
                {
                    public $search_param;
                    public $filter;

                    public function set_param($param1, $param2)
                    {
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
                    $db_adm = 'site';
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

                    $db_conn_user = new mysqli($server, $user, $pass, $db_adm);
                    if ($db_conn_user->connect_error) {
                        die("Connection failed: " . $db_conn_user->connect_error);
                    }

                    if (isset($_GET['strict_filter'])) {
                        $query = $db_conn_user->prepare("SELECT * FROM adm WHERE $data->filter = ?");
                        $query->bind_param("s", $data->search_param);
                        $query->execute();
                        $output = $query->get_result();
                    } else {
                        $query = $db_conn_user->prepare("SELECT * FROM adm WHERE emp_id=? OR email=? OR fname=?");
                        $query->bind_param(
                            "sss",
                            $data->search_param,
                            $data->search_param,
                            $data->search_param
                        );
                        $query->execute();
                        $output = $query->get_result();
                    }

                    if (isset($output->num_rows)) {
                        if ($output->num_rows > 0) {

                            echo '<body onload=goto("#table-output")> <table border="1px" id="table-output">
                    <tr>
                        <th>Employee ID</th>
                        <th>Full Name</th>
                        <th>Control</th>
                    </tr>';
                            while ($fetch = $output->fetch_assoc()) {

                                $emp_id = $fetch['emp_id'];
                                $fname = $fetch['fname'];
                                $email = $fetch['email'];
                                $desig = $fetch['desig'];
                                $username = $fetch['username'];
                                $status = $fetch['acc_status'];

                                echo '<tr>';
                                echo '<td align="center">' . $emp_id . '</td>';
                                echo '<td align="center">' . $fname . '</td>';
                                echo '<td align="center">';
                                echo '<button type="button" id="userControlModal" onclick="getUserControlModal()" class="w3-button w3-black">Access</button>';
                                echo '</td>';
                                echo '</form>';
                                echo '</tr>';
                            }
                            echo '</table></html>';

                            echo '<div class="w3-container">
                            <div id="id01" class="w3-modal w3-animate-opacity w3-padding-64">
                              <div class="w3-modal-content w3-card-4">
                                 <header class="w3-container w3-teal">
                                    <span onclick="closeUserControlModal()" class="w3-button w3-large w3-display-topright">&times;</span>
                                    <h2>Control</h2>
                                 </header>';
                            include('../alert.php');
                            echo '<div class="w3-container">';

                            echo '<br>';

                            echo '<table width="100%">';

                            if($username != $logged_username) {
                            
                            echo '<tr>';
                            if ($status == 'Disabled') {
                                echo '<td>Account Status: <font color="orange"><strong>' . $status . '</strong></font></td>';
                            } else if ($status == 'Deleted') {
                                echo '<td>Account Status: <font color="red"><strong>' . $status . '</strong></font></td>';
                            } else {
                                echo '<td>Account Status: <font color="green"><strong>' . $status . '</strong></font></td>';
                            }
                        
                            echo '<td align="right">';
                            echo '<form method="post" action="">
                                 <input type="hidden" name="emp_id" value="' . $emp_id . '">
                                 <input type="hidden" name="return" value="' . $_SERVER['REQUEST_URI'] . '">';
                            if ($status == 'Disabled') {
                                echo '<input type="submit" class="w3-button w3-blue" name="enable_emp" value="Enable Account">';
                            }
                            if ($status == 'Active') {
                                echo '<input type="submit" class="w3-button w3-blue" name="disable_emp" value="Disable Account">';
                            }
                            if ($status == 'Disabled' || $status == 'Active') {
                                echo '&nbsp;<input type="submit" class="w3-button w3-red" name="delete_emp" value="Delete Account">';
                            }
                            if ($status == 'Deleted') {
                                echo '<input type="submit" class="w3-button w3-blue" name="enable_emp" value="Enable Account">';
                            }
                            echo '</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td colspan="2">';
                            echo '<hr>';
                            echo '</td>';
                            echo '</tr>';
                        }
                            echo '<tr>';
                            echo '<td>';
                            echo '<form method="post" action="">
                                 <label>Name: </label>
                                 <input class="w3-input w3-border" style="width: 90%;" name="fname" type="text" value="' . $fname . '" placeholder="Enter Name"/>';
                            echo '</td>';
                            echo '<td>';
                            echo '<label>Email: </label>
                                 <input class="w3-input w3-border" style="width: 90%;" type="email" value="' . $email . '" name="email" placeholder="Enter Email ID"/>';
                            echo '</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td>';
                            if($username != $logged_username) {
                            echo '<label>Username: </label>
                                 <input class="w3-input w3-border" style="width: 90%;" type="text" value="' . $username . '" name="username" placeholder="Enter Mobile/Username"/>';
                                 echo '<input type="hidden" name="emp_id" value="' . $emp_id . '"/>
                                 <input type="hidden" name="return" value="' . $_SERVER['REQUEST_URI'] . '">';
                            echo '</td>';
                            echo '<td>';
                            echo '<label>Designation: </label>
                            <input class="w3-input w3-border" style="width: 90%;" type="text" value="' . $desig . '" name="desig" placeholder="Enter Designation"/>';
                            } else {
                                echo '<label>Username: </label>
                                 <input class="w3-input w3-border" onclick="username_desig_sys_adm()" style="width: 90%; background-color: lightgrey;" type="text" value="' . $username . '" name="username" placeholder="Enter Mobile/Username" readonly/>';
                                 echo '<input type="hidden" name="emp_id" value="' . $emp_id . '"/>
                                 <input type="hidden" name="return" value="' . $_SERVER['REQUEST_URI'] . '">';
                            echo '</td>';
                            echo '<td>';
                            echo '<label>Designation: </label>
                            <input class="w3-input w3-border" onclick="username_desig_sys_adm()" style="width: 90%; background-color: lightgrey;" type="text" value="' . $desig . '" name="desig" placeholder="Enter Designation" readonly/>';
                            }
                            echo '</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td>';
                            echo '<br><input class="w3-button w3-green w3-large" name="update_emp_details" type="submit" value="Save" class="btn-success"/>';
                            echo '</form>';
                            echo '</td>';
                            echo '</tr>';
                            
                            echo '</table>';

                            echo '<br></div>
                              </div>
                           </div>
                          </div>';

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
                echo '<hr><p align="center"><font size="2" color="grey">Designed and Developed by Gulfarogh Azam<br>Faculty Number: 18CAB105 Enrollment Number: GL0210</font></p>';
        

                ?>
                </table>



            </div>
        </div>
    </div>
    <script>
        function openNewWindow(url) {
            window.open(url, "Ratting", "width=600,height=500,left=150,top=200,toolbar=0,status=0,");
            value = "Open Window";
        }
        function  username_desig_sys_adm() {
            alert('Changing your own Username/Designation while logged in might lead in some error, since you are System Administrator you can change those details directly in the Database.')
        }
    </script>
    <footer>

        Designed and Developed by Gulfarogh Azam<br>Faculty Number: 18CAB105<br>Enrollment Number: GL0210
    </footer>

    <?php if (isset($_GET['userControlModalReturn'])) : ?>
        <html>
        <script>
            window.onload = function() {
                document.getElementById("userControlModal").click();
            };
        </script>

        </html>
    <?php endif; ?>
    <script>
        function getUserControlModal() {
            document.getElementById('id01').style.display = 'block'
        }

        function closeUserControlModal() {
            document.getElementById('id01').style.display = 'none'
        }
    </script>
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
    <script>
        function goto(url) {
            window.location = url;
        }
    </script>
    <script>
        function showRaiseRequest() {
            var x = document.getElementById('raiseRequest');
            if (x.style.display == "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        function showRaiseRequestAdm() {
            var x = document.getElementById('raiseRequestAdm');
            if (x.style.display == "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
    <script>
        function confirmEnable() {
            if (confirm("I have raised request before enabling account.")) {
                return true;
            }
            return false;
        }

        function confirmDisable() {
            if (confirm("I have raised request before disabling account.")) {
                return true;
            }
            return false;
        }
    </script>
    <script>
        function genTktSysAdm(url_gentkt) {
            window.open(url_gentkt, "Ratting", "width=450,height=130,left=150,top=200,toolbar=0,status=0,");
            value = "Open Window";
        }
    </script>
</body>

</html>