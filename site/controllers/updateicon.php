<?php 
    require_once '../models/db.php';
    session_start();


    $usricon = $_GET['icon'];
    $usrid = $_SESSION['user_id'];

    $sql = "UPDATE USERS SET user_icon = $usricon WHERE user_id = $usrid";

    $result = $conn->query($sql); 
    mysqli_close($conn);
    header("Location: ../views/profile.php");

    

    
?>