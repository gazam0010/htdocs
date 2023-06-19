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
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

#myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 12px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myUL {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

#myUL li a {
  border: 1px solid #ddd;
  margin-top: -1px; /* Prevent double borders */
  background-color: #f6f6f6;
  padding: 12px;
  text-decoration: none;
  font-size: 18px;
  color: black;
  display: block
}

#myUL li a:hover:not(.header) {
  background-color: #eee;
}
</style>
</head>
<body>

<h2>Customers</h2>

<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Enter Registered Mobile/Email">
<ul id="myUL"><li><a href="#">
<?php
    $sno=0;
    $query="SELECT * FROM users GROUP BY id LIMIT 2";
    $result=mysqli_query($db1, $query);
    if ($result->num_rows > 0) {
    // output data of each row
         echo '<hr>';
    while($row = $result->fetch_assoc()) {
        $sno += 1;
        $username = $row['fname'];
        $email = $row['email'];
        
        echo $username;
     }
    }
  ?>
            </a></li></ul>
  <!--<ul id="myUL">
<li><a href='#'>Gulfarogh Azam</a></li>
<li><a href='#'>Gul Ashrafi Azmi</a></li>
</ul>-->
<script>
function myFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>

</body>
</html>
