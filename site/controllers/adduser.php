<?php
session_start();
require_once("../models/db.php");
$groupid = $_GET['group_id'];
$newuserid = $_GET['new_user_id'];
$userid = $_SESSION['user_id'];
$sql1 = "SELECT group_admin_id FROM GROUPCHAT WHERE group_admin_id = $userid AND group_id = $groupid";
$result = $conn->query($sql1);
if($result->num_rows > 0){
    if($row = $result->fetch_assoc()) {
        $groupadminid = $row["group_admin_id"];
        
    }else {
        mysqli_close();
        
    }
}
else{
    mysqli_close();
    
}
if($groupadminid == $userid){
    
    $sql = "INSERT INTO isInGroup(isInGroup_group_id,isInGroup_user_id) VALUES($groupid,$newuserid)";
    $result = mysqli_query($conn,$sql);
    mysqli_close();
    
}

?>