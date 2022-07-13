<?php
header('Access-Control-Allow-Origin: *');
if(!isset($_GET['id'])){
    die("id not found");
}
require_once("../models/db.php");
$groupid = $_GET['id'];

    $sql = "SELECT group_name, group_bio FROM GROUPCHAT WHERE group_id = $groupid";
   
    $result = mysqli_query($conn,$sql);
    $groups = array();
    if ($result->num_rows > 0) {
        while($row1 = mysqli_fetch_assoc($result)) {
            $temper = array();
            $temper[] = $row1;
            $groups = $temper;
        }
    } else {
        echo "0 results";
    }
  
    $sql2 = "SELECT DISTINCT user_id, user_email 
    FROM USERS INNER JOIN isInGroup ON isInGroup.isInGroup_user_id = USERS.user_id
    WHERE isInGroup_group_id = $groupid";
    $result2 = mysqli_query($conn,$sql2);
    $users = array();
    if ($result2->num_rows > 0) {
        while($row2 = mysqli_fetch_assoc($result2)) {
            $temp = array();
            $temp[] = $row2; 
            $users[] = $temp;
        }
    } else {
        echo "0 results";
    }
    s
    array_push($all,$groups);
    array_push($all,$users);
    echo json_encode($all);
    mysqli_close($conn);
?> 