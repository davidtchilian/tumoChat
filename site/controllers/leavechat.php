<?php
    session_start();
    require_once("../models/db.php");
    $groupid = $_GET['id'];
    $deletingid = $_GET['delid'];
    $userid = $_SESSION['user_id'];
    
    if($deletingid == $userid){
        
        $sql = "DELETE FROM isINGROUP WHERE user_id = $deletingid AND group_id = $groupid";
        $result = mysqli_query($conn,$sql);
        mysqli_close();
        
    }

?>