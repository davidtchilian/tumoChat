<?php
    session_start();
    require_once("../models/db.php");

    $user_id = $_SESSION['user_id'];
    $groupid = $_GET['gID'];

    if($_GET['dec'] == 1){
    $insert="INSERT INTO isInGroup(isInGroup_user_id, isInGroup_group_id) VALUES ($user_id, $groupid)";
    mysqli_query($conn,$insert);

    }

    $sql = "DELETE FROM NOTIFICATIONS WHERE notification_receiver_id = $user_id AND notification_group_id = $groupid";

    mysqli_query($conn,$sql);
    mysqli_close();
    
    header("Location: ../views/page-accueil.php");

?>