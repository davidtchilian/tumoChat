<?php
session_start();
require_once("../models/db.php");
$groupid = $_GET['group_id'];
$userid = $_SESSION['user_id'];
$select = $_POST['select'];

if(isset($select)){
    foreach($select as $key => $receiver){
            $notif = "INSERT INTO NOTIFICATIONS(notification_sender_id,notification_receiver_id,notification_group_id,notification_content,notification_type_id) VALUES($user_id, $receiver, $groupid, '$notifContent', 1)";
            mysqli_query($conn,$notif);
        }
    mysqli_close($conn);
}
 

?>