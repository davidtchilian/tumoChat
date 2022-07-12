<?php
session_start();
require_once("../models/db.php");
$groupid = $_GET['id'];
$userid = $_SESSION['user_id'];
$sql1 = "SELECT group_admin_id FROM GROUPCHAT WHERE group_admin_id = $userid AND group_id = $groupid";
$result = $conn->query($sql1);
if($result->num_rows > 0){
    if($row = $result->fetch_assoc()) {
        $groupadminid = $row["group_admin_id"];

        
    }else {
        mysqli_close();
        die();
    }
}
else{
    mysqli_close();
    die();
}
if($groupadminid == $userid){
    $sql2 = "DELETE FROM MESSAGE WHERE message_group_id = $groupid";
    $result2 = mysqli_query($conn,$sql2);
    $sql3 = "DELETE FROM isInGroup WHERE isInGroup_group_id = $groupid";
    $result3 = mysqli_query($conn,$sql3);
    $sql = "DELETE FROM GROUPCHAT WHERE group_id = $groupid";
    $result = mysqli_query($conn,$sql);
    mysqli_close();
}
?>