<?php

session_start();
$messagecontent = strip_tags(htmlspecialchars($_POST['message_content']));
$groupId = $_POST["group_id"];


if ($messagecontent != "" && !ctype_space($messagecontent)) {
    
    $userId = $_SESSION["user_id"];

    require_once('../models/db.php');

    $replaced_message = str_replace("'", "\'", $messagecontent); // ' -> \'

    $sql = "INSERT INTO message (message_content,message_sender_id,message_group_id,message_date) VALUES ('$replaced_message', $userId, $groupId, NOW());";

    mysqli_query($conn, $sql);
    mysqli_close($conn);

}else{
    echo 1;
}


header("Location: ../views/page-chat.php?id=".$groupId);

?>