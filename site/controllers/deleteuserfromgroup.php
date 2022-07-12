<?php
session_start();
require_once("../models/db.php");
$groupid = $_GET['id'];
$deletingid = $_GET['delid'];
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
    
    $sql = "DELETE FROM isINGROUP WHERE user_id = $deletingid";
    $result = mysqli_query($conn,$sql);
    mysqli_close();
    
}

?>