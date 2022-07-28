<?php
session_start();
require_once("../models/db.php");
$userId = $_SESSION['user_id'];
$groupId = $_GET['group_id'];

if(isset($_POST['select'])){
    $select = $_POST['select'];
    // var_dump($select);
    if($select == []) {
        header('Location: ../views/page-chat.php?id='.$groupId);
        exit();
    }

    
    $name = $_POST['groupname'];
    $groupId = $_GET['group_id'];

    $sql = "SELECT user_email FROM USERS WHERE user_id = $userId";
    $result = mysqli_query($conn,$sql);

    if($result->num_rows == 1){
    $row = $result->fetch_assoc();
    $user_email = $row['user_email'];
    }

    $userName = strstr($user_email, '@', true);
    $notifContent = "$userName wants to invite you to $name";

            $notif = "INSERT INTO NOTIFICATIONS(notification_sender_id,notification_receiver_id,notification_group_id,notification_content,notification_type_id) 
            VALUES($userId, $select, $groupId, '$notifContent', 1)";
            mysqli_query($conn,$notif);
        
    mysqli_close($conn);
    
}

header('Location: ../views/page-chat.php?id='.$groupId);
exit();



?>