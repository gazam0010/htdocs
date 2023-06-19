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
        <title>Student Register</title>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            footer {
                text-align: center;
                background-color: whitesmoke;
                padding: 3%;
                width: 100%;
                bottom: 0;
            }
            .header-nav {
                position: fixed;
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
                margin-top: 15%;
                margin-bottom: 6%;
                border-radius: 5px;
            }
            .strict-filter {
                padding-left: 4%;
                padding-right: 4%;
                color: lightslategrey;
                text-size: 5px;
                text-align: center;
            }
            .reset-button:hover {

            }
            input[type="text"] {
                width: 100%;
            }
            .bb {
                margin-top: -43.7px;
                margin-left: 88%;
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
        </style>
    </head>
    <body>
        <div class="header-nav">
            <div class="w3-container w3-teal">
                <h1 align='center'>Student's Register</h1>
            </div>
            <div class="w3-contianer">
                <div class="w3-bar w3-border w3-light-grey w3-large w3-card-4">
                    <a href="index.php" class="w3-bar-item w3-button">Home</a>
                    <a href="enrol.php" class="w3-bar-item w3-button">Create Account</a>
                    <a href="#" class="w3-bar-item w3-button w3-red">Search Account</a>
                </div>
            </div>
        </div>
        <div class="form-content w3-card-4 w3-light-grey">
            <form action="" method="get">
                <p align="center"><font size="2" color="lightslategrey">Enter anything to search globally or you may use Strict Filter.</font></p>
                <input type="text" class="w3-input w3-border w3-round-large w3-large" name="search_param" value="<?php echo $search_param; ?>" placeholder="Enter required keyword and click Search" required>
                <div class="bb">
                    <button class="w3-button w3-round-large w3-large" type="submit" name="search">Search</button>
                </div>
                <p align="center"><font size="2" color="lightslategrey"><a href="#" onclick="useStrictFilter()">Use Strict Filter<a/></font></p>
                <div id="strict-filter" style="display:none">
                    <div class="strict-filter">
                        <font size="2px">
                        <input type="radio" name="strict_filter" value="first_name" id="1"> <label for="1">First Name</label>
                        &nbsp;<input type="radio" name="strict_filter" value="last_name" id="2"> <label for="2">Last Name</label>
                        &nbsp;<input type="radio" name="strict_filter" value="full_name" id="3"> <label for="3">Full Name</label>
                        &nbsp;<input type="radio" name="strict_filter" value="enrl" id="4"> <label for="4">Enrol. Number</label>
                        &nbsp;<input type="radio" name="strict_filter" value="fac" id="5"> <label for="5">Roll Number</label>
                        &nbsp;<input type="radio" name="strict_filter" value="email" id="6"> <label for=6>Email ID</label>
                        &nbsp;<input type="radio" name="strict_filter" value="prog" id="7"> <label for="7">Program of Study</label>
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
                $db_name = 'student';
                
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

                $db_conn = new mysqli($server, $user, $pass, $db_name);
                if ($db_conn->connect_error) {
                    die("Connection failed: " . $db_conn->connect_error);
                }
                
                 if (isset($_GET['strict_filter'])) {
                        $query = $db_conn->prepare("SELECT * FROM details WHERE $data->filter = ?");
                        $query->bind_param("s", $data->search_param);
                        $query->execute();
                        $output = $query->get_result();
                    } else {
                        $query = $db_conn->prepare("SELECT * FROM details WHERE first_name=? OR last_name=? OR full_name=? OR enrl=? OR fac=? OR email=? OR prog=? ");
                        $query->bind_param("sssssss", $data->search_param, $data->search_param, $data->search_param, 
                                $data->search_param, $data->search_param, $data->search_param, $data->search_param);
                        $query->execute();
                        $output = $query->get_result();
                    }
                
                if (isset($output->num_rows)) {
                    if ($output->num_rows > 0) {

                        echo '<table border="1px" id="students">
                    <tr>
                        <th>Enrol. No.</th>
                        <th>Full Name</th>
                        <th>Faculty No.</th>
                        <th>Email ID</th>
                        <th>Program of Study</th>
                    </tr>';

                        while ($fetch = $output->fetch_assoc()) {

                            echo "<tr>";
                            echo "<td>";
                            echo "<strong>" . $fetch['enrl'] . "</strong>";
                            echo "</td>";
                            echo "<td>";
                            echo $fetch['first_name']." ".$fetch['last_name'];
                            echo "</td>";
                            echo "<td>";
                            echo $fetch['fac'];
                            echo "</td>";
                            echo "<td>";
                            echo $fetch['email'];
                            echo "</td>";
                            echo "<td>";
                            echo $fetch['prog'];
                            echo "</td>";
                            echo "</tr>";
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
            Designed and Developed by Gulfarogh Azam
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
