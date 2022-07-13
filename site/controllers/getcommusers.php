<?php
    $users = array();
    $community_id = $_GET["id"];
    require_once("../models/db.php");
    $sql = "SELECT DISTINCT user_id
    FROM USERS INNER JOIN isInCommunity ON isInCommunity.isInCommunity_user_id = USERS.user_id
    WHERE isInCommunity_community_id = $community_id";
    $result = mysqli_query($conn, $sql);
    while($user = mysqli_fetch_assoc($result)){
        $users[] = $user["user_id"];
    }
    echo json_encode($users);
    mysqli_close($conn);
?>