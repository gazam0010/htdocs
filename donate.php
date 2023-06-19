<?php
?>
<html>
<title>Donate</title>
<head>
<style>
{box-sizing: border-box;}

/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 400px;
  right: 950px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>

</head>
<body>
 <p>Donate</p>
  <button class="open-button" onclick="openForm()">Donate Money</button>
   <div class="form-popup" id="myForm">
     <form action="" class="form-container">
       <h1>Help the one in need.</h1>

       <label for="name"><b>Enter Your Name</b></label>
       <input type="text" placeholder="Full Name" name="mbl" required>

       <label for="email"><b>Email</b></label>
       <input type="text" placeholder="Enter Email" name="email" required>

       <label for="mbl"><b>Mobile Number</b></label>
       <input type="text" placeholder="Enter Mobile" name="mbl" required>
   
       <label for="amt"><b>Amount (INR)</b></label>
       <input type="text" placeholder="Amount" name="amt" required>

       <button type="submit" class="btn">Donate</button>
       <button type="submit" class="btn cancel" onclick="closeForm()">Close</button>
     </form>
    
  </div>
 </body>
<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
</html>


        
