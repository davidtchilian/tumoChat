<?php
session_start();
require_once("../models/db.php");
$groupid = $_GET['id'];

$sql2 = "DELETE FROM MESSAGE WHERE message_group_id = $groupid";
mysqli_query($conn,$sql2);

$sql3 = "DELETE FROM isInGroup WHERE isInGroup_group_id = $groupid";
mysqli_query($conn,$sql3);

$deleteNotifs= "DELETE FROM NOTIFICATIONS WHERE notification_group_id = $groupid";
mysqli_query($conn,$deleteNotifs);

$sql = "DELETE FROM GROUPCHAT WHERE group_id = $groupid";
mysqli_query($conn,$sql);

mysqli_close($conn);
header("Location: ../views/home.php");
exit();
?>