<?php
    header("Access-Control-Allow-Origin: *");
    
    $group_id = $_GET["id"];
    require_once("../models/db.php");

    echo json_encode($users);
    mysqli_close($conn);
?>