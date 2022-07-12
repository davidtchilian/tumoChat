<?php
session_start();
require_once("../models/db.php");
$groupid = $_GET['id'];
$sql2 = "DELETE FROM MESSAGE WHERE message_group_id = $groupid";
$result2 = mysqli_query($conn,$sql2);
$sql3 = "DELETE FROM isInGroup WHERE isInGroup_group_id = $groupid";
$result3 = mysqli_query($conn,$sql3);
$sql = "DELETE FROM GROUPCHAT WHERE group_id = $groupid";
$result = mysqli_query($conn,$sql);
mysqli_close();
header("Location: ../views/page-accueil.php")
?>