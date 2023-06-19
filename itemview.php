<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
img {
    max-width: 100%;
    height: auto;
}

div {
    max-width: 100%;
    height: auto;
}
</style>
</head>





<?php 
session_start();

$ro = array();
$db = mysqli_connect('localhost','root','','site');


// Retrieve the score data from MySQL
$query = "SELECT * FROM versions";


$data = mysqli_query($db, $query);
$count = mysqli_num_rows($data);
echo '<table border="0px" width="100%">';
while($count>0){
echo '<tr>';

  while ($row = mysqli_fetch_array($data)) {

    for($i=0;$i<=1;$i++){
    
     
  



echo '<td  bgcolor="#FFFFFF" align="center" >';
        echo $row['version'];
        echo '</td>';




               
    
  
}
}
echo '</tr>';
$count--;
}

echo '  </table><hr width="600px" />';
  ?>
  <?php
    // Display the data
        $mob = $row['phone'];
        echo '<div class="w3-container w3-center">'
                ."<p>".'<font color="#00A651">'."<b>".'₹'.$row['price']."</b>".'<br />'.'<b><font color="Black">'.'Contact no:-'."</b>".$row['phone'].'<br /><b>'.'Category:-'."</b>".$row['Category'].'<br /><b>'.'Location:-'."</b>".$row['Location'].'<br /><b>'.'Date:-'."</b>".$row['date']."</p>".
                "<p><wbr>"."<b>".'Description:-'."</b>".$row['Description']."</p></wbr>".
                "<b><h4>".'<font color="Red">'.'Posted by - '."</b>".$row['Name']."</h4>".
                '<a href="tel:+91".$phone>'.$row['phone'].'</a>'.
                 '<a href="https://wa.me/'.$mob.'" target="_blank">'.'<i class= "fa fa-whatsapp"></i></a>
                </div>
             </div>';
    ?>
 



