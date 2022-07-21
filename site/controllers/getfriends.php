<?php
    
    require_once("../models/db.php");

    $userId = $_GET['user_id'];

    $friendsList = array();

    $sql = "SELECT DISTINCT * FROM friends WHERE user_id_1=$userId";
    $friends = mysqli_query($conn, $sql);

    while ($friend = mysqli_fetch_assoc($friends)['user_id_2']) {
        array_push($friendsList, $friend);
    }

    $sql = "SELECT DISTINCT * FROM friends WHERE user_id_2=$userId";
    $friends = mysqli_query($conn, $sql);

    while ($friend = mysqli_fetch_assoc($friends)['user_id_1']) {
        array_push($friendsList, $friend);
    }

    echo json_encode(array_unique($friendsList));
    mysqli_close($conn);

?>