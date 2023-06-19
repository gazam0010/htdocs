<!DOCTYPE HTML>
<html>
    <head>
        <title>
            Demonstration of some predefined functions in PHP.
        </title>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script>
        function goto(url)
        {
        window.location=url;
        }
        </script>
    </head>
    <body>
        <p align='center'><font size='5px'>Demonstration of Predefined functions of Array, Math, Data & Regular Expression (RegEx)</font></p><br>
        <div class="w3-form w3-container w3-card w3-padding-16" style="margin-left: 15%; margin-right: 15%; margin-bottom: 2%;">
            <form method="post" action="">
            <p align="center"><u>Array, Math & Data</u></p>
            <input class="w3-input w3-round w3-border" type="text" name="1" placeholder="1st No" required><br>
            <input class="w3-input w3-round w3-border" type="text" name="2" placeholder="2nd No" required><br>
            <input class="w3-input w3-round w3-border" type="text" name="3" placeholder="3rd No" required><br>
            <input type="radio" value="a" name="func" id="a"><label for="a" required> Product - array_product()</label><br>
            <input type="radio" value="b" name="func" id="b"><label for="b" required> Remove duplicate - array_unique()</label><br>
            <input type="radio" value="c" name="func" id="c"><label for="c" required> Round to highest - Math ceil()</label><br>
            <input type="radio" value="d" name="func" id="d"><label for="d" required> Round to lowest - Math floor()</label><br><br>
            <input class="w3-input w3-round w3-border w3-orange" type="submit" name="func1" value="Done"><br>
            <hr>
        </form>
            <form method="post" action="">
            <p align="center"><u>RegEx</u></p>
            <input class="w3-input w3-round w3-border" type="text" name="4" placeholder="Enter Strings" required><br>
            <input class="w3-input w3-round w3-border" type="text" name="5" placeholder="Enter search string" required><br>
            <input type="radio" value="e" name="func" id="e"><label for="e" required> Returns true if a word found in a string - preg_match()</label><br>
            <input type="radio" value="f" name="func" id="f"><label for="f" required> Returns number of matches of a word found in a string - preg_match_all()</label><br><br>
            <input class="w3-input w3-round w3-border w3-orange" type="submit" name="func2" value="Done">
        </form> 
        </div>
        <?php
        if (isset($_POST['func1'])) {
            $num = array();
             $fir = $_POST['1'];
            $sec = $_POST['2'];
            $thi = $_POST['3'];
            $result = array_push($num, $fir, $sec, $thi);
            echo "<html> <body onload=goto('#funcoutput')> <div id='funcoutput' class='w3-card' style='margin-left: 15%; margin-right: 15%; margin-bottom:5%; margin-top:2%; padding:3%;'>";
            echo "<p align='center'><font size='3px'><u>Stored the values in the array using array_push()</u></font></p><br>";
            if ($_POST['func'] == 'a') {
                echo "<p align='center'><font size='3px'>Product of numbers using array_product()</font></p>";
                echo "<p align='center'><font size='3px'>" . $fir . " x " . $sec . " x " . $thi . " = " . (array_product($num)) . "</font></p><br>";
            }
            if ($_POST['func'] == 'b') {
                echo "<p align='center'><font size='3px'>Removed any duplicate value using array_unique()</font></p>";
                print_r(array_unique($num));
            }
            if ($_POST['func'] == 'c') {
                echo "<p align='center'><font size='3px'>Rounded integers to nearest number higher than the integers using Math ceil()</font></p>";
                echo "<p align='center'>" . (ceil($fir) . ", ");
                echo (ceil($sec) . ", ");
                echo (ceil($thi) . "</p>");
            }
            if ($_POST['func'] == 'd') {
                echo "<p align='center'><font size='3px'>Rounded numbers to nearest number lower than the integer using Math floor()</font></p>";
                echo "<p align='center'>" . (floor($fir) . ", ");
                echo (floor($sec) . ", ");
                echo (floor($thi) . "</p>");
            }
            echo "<hr><p align='center'><a href='W14Q7.php'><button style='font-size:16px'>Reload <i class='fa fa-refresh'></i></button></i></a></p> </div> </body> </html>";
        }
        if (isset($_POST['func2'])) {
            $string = $_POST['4'];
            $word = "/" . $_POST['5'] . "/i";
            echo "<html> <body onload=goto('#funcoutput')> <div id='funcoutput' class='w3-card' style='margin-left: 15%; margin-right: 15%; margin-bottom:5%; margin-top:2%; padding:3%;'>";
            if ($_POST['func'] == 'e') {
                echo "<p align='center'><font size='3px'>Returned true or false if word found in the string using RegEx preg_match()</font></p>";
                echo "<p align='center'><font size='3px'>(".$word.") <strong>in</strong> (".$string.")</font></p>";
                $return = preg_match($word, $string);
                if ($return == 1) {
                    echo "<p align='center'><strong>Returned = True</strong></p>";
                } else {
                    echo "<p align='center'><strong>Returned = False</strong></p>";
                }
            }
            if ($_POST['func'] == 'f') {
                echo "<p align='center'><font size='3px'>Returned number of matches of a word found in the string using RegEx preg_match_all()</font></p>";
                echo "<p align='center'><font size='3px'>(".$word.") <strong>in</strong> (".$string.")</font></p>";
                $return = preg_match_all($word, $string);
                echo "<p align='center'><strong>Returned = " . $return . " Match(es)</strong></p>";
            }
            echo "<hr><p align='center'><a href='W14Q7.php'><button style='font-size:16px'>Reload <i class='fa fa-refresh'></i></button></i></a></p> </div> </body> </html>";
        }
        ?>
        
</body>
</html>