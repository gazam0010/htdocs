<?php include ('afterlogin.php') ?>
<?php
$pp = $_SESSION['previous_page'];
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!--Footer Code-->
<style>
    .footer-foo {
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: #2b2b2b;
   color: whitesmoke;
   text-align: center;
}
</style>
<!--End of footer Code--> 
<style>
.bordr{
  border: 2px solid gray;
  padding: 10px;
}


h2 {
  text-align: center;
  font-size: 25px; 
  color: black;
}
h3 {
  text-align: center;
  font-size: 2px; 
  color: red;
}

p1 {
  text-indent: 100px;
  text-align: justify;
  letter-spacing: 3px;
  font-size: 20px;
}

a {
  text-decoration: none;
  color: #008CBA;
}
</style>
<style>
.backg-profile {
background-color: #cce6ff;
height: 220px;
width: 80%;
margin: auto;
padding-bottom: 30px;
border-radius: 8px;
border: 1px solid;
box-shadow: 1px 1px 1px 1px #888888;
}
</style>
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: -1%;
  top: 28%;
  width: 100%; /* Full width */
  height: 100%; 
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0); /* Black w/ opacity */
  margin: auto;
}

.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 80%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}



/* The Close Button */
.close {
  color: black;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: whitesmoke;
  color: white;
}

.modal-body {padding: 2px 16px;}


</style>
<style>
    .header-profile {
        background-color: #032d54;
        background-size: 100%;
        width: auto;
        color: white;
        text-align: center;
        padding-top: 10px;
        padding-bottom: 8px;
    }
</style>
</head>
<body>

<div class="bordr">
    <div class="header-profile">
    <h1>PROFILE<br></h1>
    </div>
    <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="<?php echo $pp; ?>"><img src = "../img/back-button.png" width = "42.5" height="37.5" /></a>
<h2> Hello, <strong><font size="5"><?php echo $_SESSION['a3da707b651c79ecc39a4986516180b2_fname']; ?></font></strong></h2><br><br>
    
    <?php if (isset($_SESSION['change'])) : ?>
<div id="myPopup" class="container">
<div class="alert alert-success alert-dismissible">
 
    <?php 
          	echo $_SESSION['change'];
                unset($_SESSION['change']);
                  
          ?>
</div>
</div>
    <?php endif ?>
        <?php include ('errafterlogin.php');?>

        <div class="backg-profile">
            <a href="#" id="myBtn"><h4 align="right"><font size="2">EDIT PROFILE&nbsp;</font></h4></a>
    <p1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Full Name:<font size="4"> <strong><?php echo $_SESSION['a3da707b651c79ecc39a4986516180b2_fname']; ?></strong>
       <br><br>
    <p>Mobile Number: <strong><font size="4"><?php echo $_SESSION['532c28d5412dd75bf975fb951c740a30_mobile']; ?></font></strong>
           <br><br>
    <p>Email ID: <font size="4"><strong><?php echo $_SESSION['0c83f57c786a0b4a39efab23731c7ebc_email']; ?></strong>
        </div>  
</p1>
    <br><br>
    <br><br>
    <br><br>
    
</div>
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Update Profile</h2>
    </div>
    <div class="modal-body">
        <br>
       <form method="post" action="">
        Name: <input name="fname" type="text" value="<?php echo $_SESSION['a3da707b651c79ecc39a4986516180b2_fname']; ?>" placeholder="Enter Name"/>
        <br><br>     
        Email: <input type="email" value="<?php echo $_SESSION['0c83f57c786a0b4a39efab23731c7ebc_email']; ?>" name="email" placeholder="Enter your Email ID"/>
       <br><br>
        <input name="ch_em" type="submit" value="Save" class="btn-success"/>
        <br><br>
    
     </form>
    </div>
   
  </div>

</div>

    
    
    
    
<script>
function popEmail() {
    var popup = document.getElementById('myEmail');
    popup.classList.toggle('sshow');
}

function popName() {
    var popup = document.getElementById('myName');
    popup.classList.toggle('sshow');
}

setTimeout(function() {
    $('#myPopup').fadeOut('slow');
}, 2500);

</script>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";



}
</script>


</body>
<?php
include ("footer.html");
?>
</html>


