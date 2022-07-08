<?php
require_once("../models/db.php");
$groupid = $_GET['id'];
$userid = $_SESSION['user_id'];
$sql1 = "SELECT group_admin_id FROM GROUPCHAT WHERE group_admin_id = $userid AND group_id = $groupid";
$result = $conn->query($sql1);
if($result->num_rows > 1){
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
    $result = mysqli_query($conn,$sql);
    mysqli_close();
}
?>