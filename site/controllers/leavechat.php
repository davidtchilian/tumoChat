<?php
    session_start();
    require_once("../models/db.php");
    $groupid = $_GET['id'];
    $userid = $_SESSION['user_id'];

        $sql = "DELETE FROM isINGROUP WHERE user_id = $userid AND group_id = $groupid";
        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);
        

?>