<?php 

    require_once("../models/db.php");
    $id = $_POST["message_id"];
    // $groupId = $_GET["groupId"];
    $sql = "DELETE FROM `MESSAGE` WHERE `message_id` = $id";
    // var_dump($_GET);
   echo $sql;
    mysqli_query($conn, $sql);
    
    // header('Location: ../views/page-chat.php?id='.$groupId); exit();
?>