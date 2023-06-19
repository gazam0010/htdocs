<?php
$db = mysqli_connect('localhost', 'root', '', 'site');
if (isset($_POST['err_enc'])) {
 $email = mysqli_real_escape_string($db, $_POST['email']);
$msg = mysqli_real_escape_string($db, $_POST['msg']);
$query = "INSERT INTO err_enc (email, msg) VALUES('$email', '$msg')";
$result = mysqli_query($db, $query);
if($result)
{
    echo '<html> <body onload=alert("Your message has been submitted") </body></html>';
}
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>
            Encountered Error
        </title>
        <style>
            </style>
    </head>
    <body>
        <br><br>
        <fieldset>
            <legend>Register Error Encountered/Feedback</legend>
            <form align="center" method="post" action="">
                <label>Email ID: </label>
                <input type="email" name="email" placeholder="Enter your Email ID"><br><br>
                <label>Message: </label>
                <input type="text" name="msg" placeholder="Message"><br><br>
                <input type="submit" value="Submit" name="err_enc">
            </form>
        </fieldset>
    </body>
</html>