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
        header("Location: ../views/page-chat.php?id=$groupid");
    }
}
else{
    mysqli_close();
    header("Location: ../views/page-chat.php?id=$groupid");
}
if($groupadminid == $userid){
    
    $sql = "DELETE FROM GROUPCHAT WHERE group_id = $groupid";
    $sql2 = "DELETE FROM MESSAGE WHERE message_group_id = $groupid";
    $sql3 = "DELETE FROM isInGroup WHERE isInGroup_group_id = $groupid";
    $result = mysqli_query($conn,$sql);
    $result2 = mysqli_query($conn,$sql2);
    $result3 = mysqli_query($conn,$sql3);
    mysqli_close();
}
?>