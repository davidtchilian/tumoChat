<?php
session_start();
$user_id =$_SESSION['user_id'];
if($_GET['dec'] == 1){
$isInGroup_user_id = $_POST['select'];

$insert="INSERT INTO isInGroup(isInGroup_user_id, isInGroup_group_id) VALUES ";
$insert = $insert . "($user_id, $groupid),";
}

$sql = "DELETE FROM NOTIFICATIONS WHERE notification_receiver_id = $user_id AND notification_group_id = $groupid";

mysqli_query($conn,$sql);
mysqli_close();

?>