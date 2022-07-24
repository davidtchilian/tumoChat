<?php
session_start();
require_once("../models/db.php");
$userId = $_SESSION['user_id'];
$select[] = $_POST['select'];

if(isset($select)){

    $groupId = $_GET['group_id'];
    $name = $_POST['groupname'];

    $sql = "SELECT user_email FROM USERS WHERE user_id = $userId";
    $result = mysqli_query($conn,$sql);

    if($result->num_rows == 1){
    $row = $result->fetch_assoc();
    $user_email = $row['user_email'];
    }

    $userName = strstr($user_email, '@', true);
    $notifContent = "$userName wants to invite you to $name";

    foreach($select as $key => $receiver){
            $notif = "INSERT INTO NOTIFICATIONS(notification_sender_id,notification_receiver_id,notification_group_id,notification_content,notification_type_id) VALUES($userId, $receiver, $groupId, '$notifContent', 1)";
            mysqli_query($conn,$notif);
        }
    mysqli_close($conn);
    
}

header('Location: ../views/page-chat.php?id='.$groupId);
exit();

?>