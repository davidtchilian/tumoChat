<?php
    header('Access-Control-Allow-Origin: *');
    $groupId = $_GET['id'];
    require_once("../models/db.php");

    $all = array();
    $sql = "SELECT * FROM message WHERE message_group_id='$groupId'";
    $messages = mysqli_query($conn, $sql);
    // while($message = mysqli_fetch_assoc($messages)){
    //     $all[] = $message;
    // }
    // print_r($all);
    echo $messages;
    mysqli_close($conn);
?>