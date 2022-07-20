<?php
    session_start();
    require_once("../models/db.php");
    $user_id = $_SESSION['user_id'];
    $senderID = $_GET['sender'];
    $decesion = $_GET['dec'];
    $sql = "SELECT notification_group_id FROM NOTIFICATIONS WHERE notification_receiver_id = $user_id";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    if($decesion == 1){
    $groupid = $row['notification_group_id'];
    $insert="INSERT INTO friends(user_id_1, user_id_2) VALUES ($user_id, $senderID)";
    mysqli_query($conn,$insert);

    }

    $delete = "DELETE FROM NOTIFICATIONS WHERE notification_receiver_id = $user_id AND notification_type_id = 2 AND notification_sender_id = $senderID";

    mysqli_query($conn,$delete);
    mysqli_close();

    }

    header("Location: ../views/page-accueil.php");
?>