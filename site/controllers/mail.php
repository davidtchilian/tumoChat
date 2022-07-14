<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../models/db.php");
$to = $_POST['user_email'];
$sql = "SELECT user_id FROM USERS WHERE user_email = '$to'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) == 1){
  $row = mysqli_fetch_assoc($result);
  $user_id = $row['user_id'];
  $hash = md5(date('h-i-s, j-m-y, it is w Day') . rand(0, 1000));
  $subject = 'reset password';
  $message = "<h1> If you want to reset your password click link below </h1> <br>" . $domain_name . "/views/reset_pwd_form.php?h=" . $hash . "&uid=". $user_id;
  $headers = "From: <narek.h30.y@tumo.org>"."\r\n";
  $headers .= "Content-type: text/html\r\n";  
  mail($to,$subject,$message,$headers);

  // insert
  $insert = "INSERT INTO RESET_PWD(reset_pwd_hash, reset_pwd_user_id, reset_pwd_date) VALUES
  ('$hash', $user_id, NOW())";
  $insert = mysqli_query($conn, $insert);
  } 
header('Location:../views/logIn.php?id=3');
exit();
?>



