<?php
  $user_id = $_POST["user_id"];
  $groupId = $_POST['group_id'];
  $message_conntent = $_POST["message_content"];
  header("Location: ../views/page-chat.php?id=".$groupId);
?>
