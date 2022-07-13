<?php 
    header('Access-Control-Allow-Origin: *');
    require_once("../models/db.php");
    session_start();
    $usrid = $_SESSION['user_id'];

    $sql = "SELECT notification_id, notification_sender_id, notification_group_id, notification_content 
    FROM NOTIFICATIONS WHERE notification_receiver_id = $usrid";
    $notifs = array();

    $result = mysqli_query($conn,$sql);
    if($result->num_rows > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $notifs[] = $row;
        }
      } 

    echo json_encode($notifs);
    mysqli_close($conn);
?>