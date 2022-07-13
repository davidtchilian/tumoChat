<?php
require_once("../models/db.php");
$to = $_POST['user_email'];
$sql = "SELECT user_id FROM USERS WHERE user_email = '$to'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)==1){
    $hash = md5(date() + rand(0, 1000));
    $subject = 'Subject';
    $message = "<h1> If you want to reset your password click link below </h1> <br>" . $domain_name . "/controllers/resetpwd.php?h=" . $hash . "&uid=". "$result";
    $headers = "From: <narek.h30.y@tumo.org>"."\r\n";
    $headers .= "Content-type: text/html\r\n";  
    mail($to,$subject,$message,$headers);
  } 
header("Location: ../views/logIn.php?id=3");
?>



