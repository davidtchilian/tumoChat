<?php


  require_once("../models/db.php");

  $message_conntent = $_POST["message_content"];
  $message_id = $_GET["id"];
  $groupId = $_POST["group_id"];
  $userId = $_POST["user_id"];


  $sql2 = "SELECT `message_sender_id` FROM `MESSAGE` WHERE `message_id` = $message_id";
  $result = mysqli_fetch_assoc(mysqli_query($conn, $sql2));
  $message_sender_id = $result["message_sender_id"];



 if($message_sender_id == $userId){
    $sql = "UPDATE `MESSAGE` SET `message_content`='$message_conntent' WHERE `message_id` = $message_id AND `message_group_id` = $groupId";
    mysqli_query($conn, $sql);
    mysqli_close($conn);

  
    header('Location: ../views/page-chat.php?id='.$groupId);
  }else{
    header('Location: ../views/page-chat.php?id='.$groupId);
  }

 
?>
