<?php

require_once('../models/db.php');

$messagecontent = $_POST['message_content'];
$userid = $_POST['user_id'];
$groupid = $_POST['group_id'];

$replaced_message = str_replace("'", "\'", $messagecontent); // ' -> \'

$sql = "INSERT INTO message (message_content,message_sender_id,message_group_id,message_date) VALUES ('$replaced_message', 1, 1, NOW());";
mysqli_query($conn, $sql);
mysqli_close($conn);

header('Location: ../views/page-chat.php');

?>