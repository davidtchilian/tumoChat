<?php 
    require_once '../models/db.php';
    session_start();

    $usrbio = $_POST['bio'];
    $usrid = $_SESSION['user_id'];

    $sql = "UPDATE users SET user_bio = '$usrbio' WHERE user_id = $usrid";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    header("Location: ../views/profile.php");

?>
