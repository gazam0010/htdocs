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
      animation: fade-in 0.5s ease;
    }

    @keyframes fade-in {
      0% {
        opacity: 0;
      }
      100% {
        opacity: 1;
      }
    }

    h1 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
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
      display: flex;
      align-items: flex-start;
    }

    strong {
      font-weight: bold;
      color: #333;
      width: 100px;
      margin-right: 10px;
    }

    .contact-info {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
      opacity: 0;
      animation: fade-in 0.5s ease forwards;
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
      <h2 id="name"><?php echo $row['dname']; ?></h2>
      <br><br>
      <p class="contact-info">
        <strong>Email:</strong>
        <img src="email.png" alt="Email Icon" width="20" height="20">
        <a href="mailto:<?php echo $row['email']; ?>"><?php echo $row['email']; ?></a>
      </p>
      <p class="contact-info">
        <strong>Phone:</strong>
        <img src="phone.png" alt="Phone Icon" width="20" height="20">
        <?php echo $row['dcontact']; ?>
      </p>
      <p>
        <strong>Address:</strong> <?php echo $row['daddress']; ?>
      </p>
      <p>
        <strong>Specialty:</strong> <?php echo $row['dspecialization']; ?>
      </p>
      <p class="experience">
        <strong>Experience:</strong> <?php echo $row['exp']; ?> Years
      </p>
    </div>
  </div>

  <script>
    // Fade-in animation for contact-info elements
    const contactInfo = document.querySelectorAll('.contact-info');
    contactInfo.forEach((info, index) => {
      info.style.animationDelay = `${index * 0.1}s`;
      info.style.animationDuration = '0.5s';
    });
  </script>
</body>
</html>
