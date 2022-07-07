<?php 
    require_once '../models/db.php';
    session_start();


    $usrmail = $_POST['email'];
    $usrid = 1;
    // $usrid = $_SESSION['user_id'];

    $sql = "  UPDATE USERS SET user_email = '$usrmail' WHERE user_id = $usrid";
    mysqli_query($sql);
    $mysqli -> close();

?>
