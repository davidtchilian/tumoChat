<?php
require_once("../models/db.php");
$groupid = $_GET['id'];
$userid = $_GET['user_id'];
$adminid = $_GET['group_admin_id'];
if($adminid == $userid){
    $result = mysqli_query($conn,$sql);
    $sql = "DELETE * FROM isINGROUP WHERE user_id = $id";
    mysqli_close();
}
else{
    echo "you cant delete a user from a group, because you are not the admin";
}
?>