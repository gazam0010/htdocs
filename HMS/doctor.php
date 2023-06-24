<?php
if(!isset($_GET['did'])){
header("location: index.php");
exit();
}

$did = $_GET['did'];
$connection = mysqli_connect('localhost', 'root', '', 'test');

$query = "SELECT * FROM doctorprofile WHERE did = '$did' LIMIT 1";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html>
<head>
  <style>
    /* CSS Styles */
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      color: #333;
    }

    #profile {
      border-top: 2px solid #333;
      padding-top: 20px;
    }

    h2#name {
      font-size: 28px;
      font-weight: bold;
      color: #333;
      margin-bottom: 10px;
      transition: font-size 0.3s ease;
    }

    h2#name:hover {
      font-size: 32px;
    }

    p {
      margin: 10px 0;
      color: #555;
    }

    strong {
      font-weight: bold;
      color: #333;
    }

    .contact-info {
      display: flex;
      align-items: center;
    }

    .contact-info img {
      margin-right: 10px;
    }

    .contact-info a {
      color: #555;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .contact-info a:hover {
      color: #333;
    }

    .specialty {
      background-color: #333;
      color: #fff;
      padding: 5px 10px;
      border-radius: 5px;
      display: inline-block;
      margin-top: 10px;
    }

    .experience {
      font-size: 14px;
      color: #777;
      margin-top: 5px;
    }

    .qualifications {
      margin-top: 20px;
    }

    .qualifications ul {
      padding-left: 20px;
    }

    .qualifications li {
      list-style-type: disc;
      margin-bottom: 5px;
      color: #555;
    }
  </style>
 
</head>
<body>
  <div class="container">
    <h1>Doctor Profile</h1>
    <div id="profile">
      <h2 id="name"><?php echo $row['dname']; ?></h2><br><br>
      <p class="contact-info">
        <strong>Email: </strong> <?php echo $row['email']; ?> <span id="email"></span>
      </p>
      <p class="contact-info">
        <strong>Phone: </strong> <?php echo $row['dcontact']; ?> <span id="phone"></span>
      </p>
      <p><strong>Address: </strong> <?php echo $row['daddress']; ?><span id="address"></span></p>
      <p><strong>Specialty: </strong> <?php echo $row['dspecialization']; ?> <span id="specialty"></span></p>
      <p class="experience"><strong>Experience: </strong><?php echo $row['exp']; ?> Years<span id="experience"></span></p>
      <div class="qualifications">
        <strong>Qualifications:</strong>
        <ul id="qualifications"></ul>
      </div>
    </div>
  </div>
</body>
</html>
