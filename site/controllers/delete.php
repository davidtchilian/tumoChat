<?php 

    require_once("../models/db.php");
    $id = $_GET["id"];
    $groupId = $_GET["groupId"];
    $sql = "DELETE FROM `MESSAGE` WHERE `message_id` = $id";
    // var_dump($_GET);
  
    mysqli_query($conn, $sql);
    
    header('Location: ../views/page-chat.php?id='.$groupId); exit();
?>