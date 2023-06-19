<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Document</title>
    <style>
        nav{
            margin: 0;
            margin-right: 0px;
            background-attachment: fixed; 
            background-color: lightseagreen;
            }
            li{
            margin: 0;
            padding: 0;
            list-style-type: none; 
            display: inline-block;   
            margin: 10px;
            padding: 10px 10px;      
            text-align: center;   
            font-size: 25px; 
             }
       .active {
           background-color: red;
           color: black;
       }
       a {
           text-decoration: none;
       }
       td{
           margin: 0;
           padding: 5px;
           font-size: x-large;
       }
       .text{
           padding: 5px 20px;
           font-size: large;
       }
       .button{
           padding: 5px 8px;
           cursor: pointer;
       }
       .content {
           background-color: lightblue;
           margin-top: 3%;
           margin-left: 8%;
           margin-right: 8%;
           margin-bottom: 3%;
           padding: 5%;
       }
       footer {
           position: fixed;
           bottom: 0;
           width: 100%
       }
    </style>
</head>
<body bgcolor="whitesmoke">
    <nav>
        <ul>
        <li><a class="active" href="home.php">Home</a></li>
            <li><a  style="color: aliceblue;"  href="register.php">Create Profile</a></li>
            <li><a style="color: aliceblue;" href="search.php">Search Profile</a></li>
        </ul>
    </nav>
    <footer style="text-align: center; background-color: lightgrey; padding: 2%;">
            Name: Tausif Anwar (18CAB103) (GL0230)
        </footer>
</body>
</html>