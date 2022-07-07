<?php 
    require_once '../models/db.php';
    session_start();


    $usricon = $_POST['icon'];
    $usrid = 1;
    // $usrid = $_SESSION['user_id'];

    $sql = "UPDATE USERS SET user_icon = $usricon WHERE user_id = $usrid";
    mysqli_query($sql);
    $mysqli -> close();

?>