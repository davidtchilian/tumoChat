<?php
    session_start();
    require_once("../models/db.php");
    $groupid = $_GET['group_id'];
    $receiver = $_GET['notification_receiver_id'];
    $userid = $_SESSION['user_id'];
    $sqlcont = "SELECT group_name FROM GROUPCHAT WHERE group_id = $groupid";
    $result = $conn->query($sqlcont);
    if($result->num_rows > 0){
        if($row = $result->fetch_assoc()) {
            $content = $row["group_name"];
            
        }else {
            mysqli_close();
            die();
        }
    }
    else{
        mysqli_close();
        die();
    }

        $sql = "INSERT INTO NOTIFICATIONS(notification_sender_id,notification_receiver_id,notification_group_id,notification_content) 
        VALUES($userid,$receiver,$groupid,$content)";
        $result = mysqli_query($conn,$sql);
        mysqli_close();

    
?>