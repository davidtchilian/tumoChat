<?php
    $messages = array();
    require_once("../models/db.php");
    $groupId = $_GET["id"];
    $sql = "SELECT message_content FROM message WHERE message_group_id=$groupId ORDER BY message_date DESC LIMIT 2";
    $lastMessages = mysqli_query($conn, $sql);
    while ($message = mysqli_fetch_assoc($lastMessages)) {
        array_push($messages,$message["message_content"]);
    }
    $temp = $messages[0];
    $messages[0] = $messages[1];
    $messages[1] = $temp;

    // Sticker sort
    for ($i = 0; $i <= 1; $i++) {
        if (explode("_", $messages[$i])[0] == "STICKER") {
            $messages[$i] = "Sent sticker";
        }
    }

    echo json_encode($messages);
    mysqli_close($conn);
?>