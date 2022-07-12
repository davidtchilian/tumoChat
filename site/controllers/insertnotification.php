<?php
    session_start();
    require_once("../models/db.php");
    $groupid = $_GET['group_id'];
    $receiver = $_GET['notification_receiver_id'];
    $userid = $_SESSION['user_id'];
    $sqlcont = "SELECT group_bio FROM GROUPCHAT WHERE group_id = $groupid";
    $result = $conn->query($sql1);
    if($result->num_rows > 0){
        if($row = $result->fetch_assoc()) {
            $content = $row["group_bio"];
            
        }else {
            mysqli_close();
            
        }
    }
    else{
        mysqli_close();
        
    }

        $sql = "INSERT INTO NOTIFICATIONS(notification_sender_id,notification_receiver_id,notification_group_id,notification_content) 
        VALUES($userid,$receiver,$groupid,$contnet)";
        $result = mysqli_query($conn,$sql);
        mysqli_close();

    
?>