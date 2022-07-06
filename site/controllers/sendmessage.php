<?php

require_once('../models/db.php');

$messagecontent = $_POST['message_content'];
$userid = $_POST['user_id'];
$groupid = $_POST['group_id'];

$sql = "INSERT INTO message (message_content,message_sender_id,message_group_id,message_date) 
VALUES ('$messagecontent', 1, 1, NOW());";

mysqli_query($conn, $sql);
mysqli_close($conn);

header('Location: ../views/page-chat.php');

?>