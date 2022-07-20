<?php

  session_start();
  $userId = $_SESSION['user_id'];
  $receiverId = $_GET['receiver_id'];

  require_once('../models/db.php');

  $sql = "SELECT user_email FROM USERS WHERE user_id=$userId";
  $userName = mysqli_fetch_assoc(mysqli_query($conn, $sql))['user_email'];

  $friendRequestContent = "$userName sent you friend request.";

  $sql = "INSERT INTO NOTIFICATIONS (notification_sender_id,notification_receiver_id,notification_content,notification_type_id) VALUES($userId, $receiverId, '$friendRequestContent', 2)";
  mysqli_query($conn, $sql);
  mysqli_close($conn);

  header("Location: ../views/profile.php?id=".$receiverId);

?>