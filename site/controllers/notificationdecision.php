<?php
    session_start();
    require_once("../models/db.php");
    $userId = $_SESSION['user_id'];
    $notifId = $_GET['notifId'];
    $decesion = $_GET['dec'];
    $select = "SELECT * FROM NOTIFICATIONS WHERE notification_id = $notifId";
    $result = mysqli_query($conn,$select);
    if($result->num_rows > 0){
        if($decesion == "1"){
            if(isset($_GET['gID'])){
                $groupId = $_GET['gID'];
                $insert="INSERT INTO isInGroup(isInGroup_user_id, isInGroup_group_id) VALUES ($userId, $groupId)";
                mysqli_query($conn,$insert);
            }
            if(isset($_GET["sender"])){
                $senderId = $_GET["sender"];
                $insert="INSERT INTO friends(user_id_1, user_id_2) VALUES ($userId, $senderId)";
                mysqli_query($conn,$insert);
            }
        }
        $delete = "DELETE FROM NOTIFICATIONS WHERE notification_id = $notifId ";
        mysqli_query($conn,$delete);
    }
    mysqli_close($conn);

    header("Location: ../views/page-accueil.php");
   
    
?>