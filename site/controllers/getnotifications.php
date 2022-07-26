<?php 
    header('Access-Control-Allow-Origin: *');
    require_once("../models/db.php");
    session_start();
    $usrid = $_SESSION['user_id'];

    

    echo json_encode($notifs);
    mysqli_close($conn);
?>