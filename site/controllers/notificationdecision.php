<?php
    session_start();
    require_once("../models/db.php");
    $user_id = $_SESSION['user_id'];
    $notifId = $_GET['notifId'];
    $decesion = $_GET['dec'];
    $sql = "SELECT notification_group_id FROM NOTIFICATIONS WHERE notification_receiver_id = $user_id";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    if($decesion == 1){
    $groupid = $row['notification_group_id'];
    $insert="INSERT INTO isInGroup(isInGroup_user_id, isInGroup_group_id) VALUES ($user_id, $groupid)";
    mysqli_query($conn,$insert);

    }

    $delete = "DELETE FROM NOTIFICATIONS WHERE notification_receiver_id = $user_id AND notification_id = $notifId";

    mysqli_query($conn,$delete);
    mysqli_close();

    }

    header("Location: ../views/page-accueil.php");
?>