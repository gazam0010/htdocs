<?php

$to = 'gulfarogh@gmail.com';
    $subject = "Reset your password on examplesite.com";
    $msg = "Hi there, click on this <a href=\"new_password.php?token=>link</a> to reset your password on our site";
    $msg = wordwrap($msg,70);
    $headers = "From: info@freain.com";
    mail($to, $subject, $msg, $headers);
    ?>
