<?php
session_start();
require_once("../models/db.php");
$groupid = $_POST['group_id'];
$deletingid = $_POST['user_id'];
$sql = "DELETE FROM isINGROUP WHERE isingroup_user_id = $deletingid AND isInGroup_group_id = $groupid";
$result = mysqli_query($conn,$sql);
mysqli_close($conn);
var_dump($_POST);
// header("Location: ../views/page-chat.php?id=".$groupid."&modal=1");
exit();

?>