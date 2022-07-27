<?php

session_start();
$messagecontent = strip_tags(htmlspecialchars($_POST['message_content']));
$groupId = $_POST["group_id"];


if ($messagecontent != "" && !ctype_space($messagecontent)) {
    
    $userId = $_SESSION["user_id"];

    require_once('../models/db.php');
    include("../models/functions.php");

    addStatistic($userId, 2, $conn);


    $replaced_message = str_replace("'", "\'", $messagecontent); // ' -> \'

    $sql = "INSERT INTO message (message_content,message_sender_id,message_group_id,message_date) VALUES ('$replaced_message', $userId, $groupId, NOW());";

    mysqli_query($conn, $sql);



    $sql2 = "SELECT MAX(message_id) as message_id FROM MESSAGE";
    $result0 = mysqli_query($conn, $sql2);
    $result1 = mysqli_fetch_assoc($result0);
    mysqli_close($conn);
    echo $result1['message_id'];


}

?>