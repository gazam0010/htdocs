<?php

//We create our own function to submit our link
//Certain hosts do not support the usage of "fopen"
function ismscURL($link){

    $http = curl_init($link);

    curl_setopt($http, CURLOPT_RETURNTRANSFER, TRUE);
    $http_result = curl_exec($http);
    $http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
    curl_close($http);

    return $http_result;
}



   
   $mobiles = urlencode($_POST["mobile"]);
   $OTP = urlencode($_POST["token"]);

  
   

   $fp = "https://control.msg91.com/api/sendhttp.php?authkey=341807A9JXmCCtkKUu5f61cc72P1&message=Your verification code is: ".$OTP.". &sender=DRSLVE&route=4";
   $fp .= "&mobiles=$mobiles";
   //echo $fp;
   $result = ismscURL($fp);
  

?>
