<?php

  $userId = $_GET['user_id'];
  $deleteId = $_GET['delete_id'];

  if (!isset($userId) || !isset($deleteId)) {
    header('Location: ../views/profile.php');
    exit();
  }

  require_once("../models/db.php");
  $sql = "DELETE FROM friends WHERE user_id_1=$userId AND user_id_2=$deleteId OR user_id_2=$userId AND user_id_1=$deleteId";
  mysqli_query($conn, $sql);
  mysqli_close($conn);
  header('Location: ../views/profile.php?id='.$deleteId);
  exit();
?>