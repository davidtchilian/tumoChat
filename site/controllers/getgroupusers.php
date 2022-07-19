<?php
    header("Access-Control-Allow-Origin: *");
    $users = array();
    $group_id = $_GET["id"];
    require_once("../models/db.php");
    $sql = "SELECT DISTINCT user_id
    FROM USERS INNER JOIN isInGroup ON isInGroup.isInGroup_user_id = USERS.user_id
    WHERE isInGroup_group_id = $group_id";
    $result = mysqli_query($conn, $sql);
    while($user = mysqli_fetch_assoc($result)){
        $users[] = $user["user_id"];
    }
    echo json_encode($users);
    mysqli_close($conn);
?>