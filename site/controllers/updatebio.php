<?php 
    require_once '../models/db.php';
    session_start();


    $usrbio = $_POST['bio'];
    $usrid = $_SESSION['user_id'];

    $sql = "  UPDATE USERS SET user_bio = '$usrbio' WHERE user_id = $usrid";
    mysqli_query($sql);
    $mysqli -> close();

?>
