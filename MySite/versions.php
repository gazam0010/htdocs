<!DOCTYPE HTML>
<html>
    <head>
        <title>Versions</title>
        <style>
            p {
                text-align: center;
            }
            h1 {
                text-align: center;
                size: 5px;
                font-family: Algerian;
            }
        </style>
    </head>
    <body>
        <br>
       &nbsp;&nbsp; <a href="start.php"><img src = "img/back-button.png" width = "42.5" height="37.5" /></a>
    <h1> Versions Details </h1>
       
       <br><br>
    <fieldset>
        <legend>Versions</legend>
        <table align="center">
            <thead>
                 </thead>
            <tbody>
                <?php
                $db2 = mysqli_connect('localhost', 'root', '', 'site');
                $query = "SELECT * FROM versions ORDER BY version DESC";
                $result = mysqli_query($db2, $query);   
                if ($result->num_rows > 0) {
                
                  while($row = $result->fetch_assoc()) {
                  echo '<tr>';
                  echo '<th>'.$row['version'].'</th>';
                  echo '<td>'.$row['details'].'</td>';
                  echo '</tr>';
                  }
                }
                ?>
            </tbody>
        </table>
    </fieldset>
    </body>
</html>
        