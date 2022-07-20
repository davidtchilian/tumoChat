<?php
    session_start();
    require_once("../models/db.php");
    $userId = $_SESSION['user_id'];
    $notifId = $_GET['notifId'];
    $decesion = $_GET['dec'];
    $groupId = $_GET['gID'];
    $senderId = $_GET['Sender'];

    if($decesion == 1){
        if(isset($groupId)){
            $insert="INSERT INTO isInGroup(isInGroup_user_id, isInGroup_group_id) VALUES ($user_id, $groupid)";
            mysqli_query($conn,$insert);
        }
        elseif(isset($senderID)){
            $insert="INSERT INTO friends(user_id_1, user_id_2) VALUES ($user_id, $senderID)";
            mysqli_query($conn,$insert);
        }

    }

    $delete = "DELETE FROM NOTIFICATIONS WHERE notification_id = $notifId ";

    mysqli_query($conn,$delete);
    mysqli_close();

    header("Location: ../views/page-accueil.php");
?>