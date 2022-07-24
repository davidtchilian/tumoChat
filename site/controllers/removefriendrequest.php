<?php

$requestedUserId = $_GET['requested_user_id'];

if (!isset($requestedUserId)) {
    header("Location: ../views/profile.php?id=".$requestedUserId);
    exit();
}

session_start();
$userId = $_SESSION['user_id'];

require_once("../models/db.php");

$sql = "DELETE FROM notifications WHERE notification_sender_id=$userId AND notification_receiver_id=$requestedUserId AND notification_type_id=2";
mysqli_query($conn, $sql);
mysqli_close($conn);

header("Location: ../views/profile.php?id=".$requestedUserId);
exit();
?>