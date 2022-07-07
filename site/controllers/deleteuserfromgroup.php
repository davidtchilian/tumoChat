<?php
require_once("../models/db.php");
$groupid = $_GET['id'];
$userid = $_SESSION['user_id'];
$adminid = $_GET['group_admin_id'];
if($adminid == $userid){
    $result = mysqli_query($conn,$sql);
    $sql = "DELETE * FROM isINGROUP WHERE user_id = $userid";
    mysqli_close();
}

?>