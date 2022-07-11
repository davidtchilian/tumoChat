<?php
    $user_id = $_GET["id"];
    require_once("../models/db.php");
    $sql = "SELECT user_email FROM `users` WHERE user_id = ".$user_id;
    $userEmail = mysqli_query($conn, $sql);
    $user_email = mysqli_fetch_assoc($userEmail)["user_email"];
    echo $user_email;
?>