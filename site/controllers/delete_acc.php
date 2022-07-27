<?php
session_start();
$userId = $_SESSION['user_id'];
if (!isset($userId)) {
    header('Location: ../login.php?id=4');
    exit();
}


require('../models/db.php');
$sql = "DELETE FROM friends WHERE user_id_1 = $userId OR user_id_2 = $userId";
mysqli_query($conn, $sql);
$sql = "DELETE FROM NOTIFICATIONS WHERE notification_receiver_id = $userId OR notification_sender_id = $userId";
mysqli_query($conn, $sql);
$sql = "DELETE FROM isInGroup WHERE isInGroup_user_id = $userId";
mysqli_query($conn, $sql);
$sql = "DELETE FROM MESSAGE WHERE message_sender_id = $userId";
mysqli_query($conn, $sql);
$sql = "DELETE FROM GROUPCHAT WHERE group_admin_id = $userId";
mysqli_query($conn, $sql);
$sql = "DELETE FROM Statistics_Main WHERE statistic_user_id = $userId";
mysqli_query($conn, $sql);
$sql = "DELETE FROM USERS WHERE user_id = $userId";
mysqli_query($conn, $sql);

mysqli_close($conn);
header("Location:../views/logIn.php?id=6");
exit();




?>