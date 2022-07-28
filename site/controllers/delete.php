<?php 

    require_once("../models/db.php");
    $id = $_POST["message_id"];

    $sql = "DELETE FROM `MESSAGE` WHERE `message_id` = $id";
    
    mysqli_query($conn, $sql);
?>