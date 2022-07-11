<?php
    require_once("../models/db.php");
    $user_id = $_GET["id"];
    $sql = "SELECT user_icon FROM USERS WHERE user_id = $user_id";
    $icon_ = mysqli_query($conn, $sql);
    $icon = mysqli_fetch_assoc($icon_);
    echo $icon["user_icon"];
    mysqli_close($conn);
?>