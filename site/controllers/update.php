<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  require_once("../models/db.php");

  $message_conntent = $_POST["message_content"];
  $message_id = $_POST["message_id"];
  $groupId = $_POST["group_id"];
  $userId = $_POST["user_id"];

 
  
 

  $sql2 = "SELECT `message_sender_id` FROM `MESSAGE` WHERE `message_id` = $message_id";
  $result = mysqli_query($conn, $sql2);
  $row = mysqli_fetch_assoc($result);
  // var_dump($row);
  $message_sender_id = $row["message_sender_id"];
 
  
if(mysqli_num_rows($result) == 1 && $message_sender_id == $userId){

    $sql = "UPDATE `MESSAGE` SET `message_content`='$message_conntent' WHERE `message_id` = $message_id";
    mysqli_query($conn, $sql);
    header('Location: ../views/page-chat.php?id='.$groupId); exit();  
    echo "hello";

  }else {
  
       mysqli_close($conn);
   header('Location: ../views/page-chat.php?id='.$groupId); exit();
  
   
 }
?>
