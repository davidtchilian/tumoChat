<?php
session_start();
require_once("../models/db.php");
$groupid = $_GET['id'];
$deletingid = $_GET['delid'];
$sql = "DELETE FROM isINGROUP WHERE isingroup_user_id = $deletingid AND isInGroup_group_id = $groupid";
$result = mysqli_query($conn,$sql);
mysqli_close($conn);
// var_dump($sql);

header("Location: ../views/home.php");
exit();

?>