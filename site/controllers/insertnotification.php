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

       
        mysqli_close();

    
?>