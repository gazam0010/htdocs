<?php
include('../op_afterlogin.php');
$eid = $_SESSION['cf40c61e54a706033144ba6a76fa7fce_opusername'];
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
if (isset($_POST['close_user_session'])) {
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
<?php
$adm_username = $_SESSION['cf40c61e54a706033144ba6a76fa7fce_opusername'];
$query = "SELECT desig FROM adm WHERE username = '$adm_username'";
$result = mysqli_query($db, $query);
$desig = mysqli_fetch_assoc($result);
$designation = $desig['desig'];
mysqli_close($db);
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIS Admin</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="usersinfo.css?version=1">
    </link>
</head>

<body>
    <div class="header-nav">
        <div class="w3-container w3-teal">
            <h1 align='center'>CIS Admin Panel</h1>
        </div>
        <div class="w3-contianer">
            <div class="w3-bar w3-border w3-light-grey w3-card-4">
                <a href="#" class="w3-bar-item w3-button w3-red">Search Account</a>
                <?php if ($designation == "System Administrator") : ?>
                    <a href="../system_upd.php" class="w3-bar-item w3-button">System Security</a>
                    <a href="../tickets_resolution.php" class="w3-bar-item w3-button">Tickets Resolution</a>
                    <a href="../employees_corner/op_index_emp.php" class="w3-bar-item w3-button w3-border w3-round">Employees Corner</a>
                <?php endif ?>
                <?php if ($designation == "Customer Support") : ?>
                    <a href="../raise_request.php" class="w3-bar-item w3-button">Raise Request</a>
                <?php endif ?>
                <a href="?logout='1'" class="w3-bar-item w3-button"> Logout</a>
                <a href="../op_profile.php" class="w3-bar-item w3-button w3-right"><span class="vl"></span>
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
                                <input type="radio" name="strict_filter" value="id" id="1"> <label for="1">ID</label>
                                &nbsp;<input type="radio" name="strict_filter" value="email" id="2"> <label for="2">Email</label>
                                &nbsp;<input type="radio" name="strict_filter" value="fname" id="3"> <label for="3">Full Name</label>
                                &nbsp;<input type="radio" name="strict_filter" value="mobile" id="4"> <label for="4">Mobile</label>
                                &nbsp;<input type="radio" name="strict_filter" value="acc_status" id="5"> <label for="5">Status</label>
                                &nbsp;<input type="radio" name="strict_filter" value="balance" id="6"> <label for=6>Balance</label>
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
                        $query = $db_conn_user->prepare("SELECT * FROM users WHERE id=? OR email=? OR fname=? OR mobile=? OR balance=? OR acc_status=?");
                        $query->bind_param(
                            "ssssss",
                            $data->search_param,
                            $data->search_param,
                            $data->search_param,
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
                        <th>ID</th>
                        <th>Mobile</th>
                        <th>Account Status</th>
                        <th>User Control</th>
                    </tr>';
                            while ($fetch = $output->fetch_assoc()) {

                                $id = $fetch['id'];
                                $fname = $fetch['fname'];
                                $email = $fetch['email'];
                                $mobile = $fetch['mobile'];
                                $status = $fetch['acc_status'];
                                $balance = $fetch['balance'];

                                echo '<tr>';
                                echo '<td>' . $id . '</td>';
                                echo '<td align="center">' . $mobile . '</td>';
                                if ($status == 'Disabled') {
                                    echo '<td align="center"><font color="orange"><strong>' . $status . '</strong></font></td>';
                                } else if ($status == 'Deleted') {
                                    echo '<td align="center"><font color="red"><strong>' . $status . '</strong></font></td>';
                                } else {
                                    echo '<td align="center"><font color="green"><strong>' . $status . '</strong></font></td>';
                                }
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
                                    <h2>User Control</h2>
                                 </header>';
                            include('../alert.php');
                            echo '<div class="w3-container">';

                            echo '<br>';
 

                            //Fetch ticket START
                            $db = mysqli_connect('localhost', 'root', '', 'site');
                            $query = "SELECT * FROM query WHERE customer_id='$id'";
                            $tkt_id = array();
                            $tkt_status = array();
                            $result = mysqli_query($db, $query);

                            while ($tkt = mysqli_fetch_array($result)) {
                                $tkt_id[] = $tkt['ticket_id'];
                                $tkt_status[] = $tkt['ticket_status'];
                            }
                            //Fetch ticket END

                            
                            if ($designation == "System Administrator") {

                                include('usersinfo_if_sys_adm.php');

                            } else {

                                include('usersinfo_if_cust_serv.php');

                            }
                            
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
               echo  '<hr><p align="center"><font size="2" color="grey">Designed and Developed by Gulfarogh Azam<br>Faculty Number: 18CAB105 Enrollment Number: GL0210</font></p>';

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