<?php
    session_start();
    require_once("../models/db.php");
    require_once("../models/functions.php");
    $user1_id = $_SESSION['user_id'];
    $user2_id = $_GET['id'];
    
    $sql = "SELECT DISTINCT isInGroup_group_id FROM isInGroup WHERE isInGroup_user_id = $user1_id";
    $res = mysqli_query($conn,$sql);
    while ($row = mysqli_fetch_assoc($res)) {
        $groupId = $row['isInGroup_group_id'];
        $users = getGroupUsersId($conn,$groupId);
        if (count($users) == 2) {
            if (($users[0] == $user1_id && $users[1] == $user2_id)|| ($users[1] == $user1_id && $users[0] == $user2_id))  {
                header("Location: ../views/page-chat.php?id=$groupId");
                exit();
            }
        }
    }
    // echo "<pre>";

    $user1_info = getUserInfo($conn, $user1_id);
    // var_dump($user1_info);
    $user2_info = getUserInfo($conn, $user2_id);
    // var_dump($user2_info);
    $user1_name = explode("@",$user1_info['user_email'])[0];
    $user2_name = explode("@",$user2_info['user_email'])[0];
    
    $sql2 = "INSERT INTO `GROUPCHAT`(`group_name`, `group_bio`, `group_admin_id`, `group_type`) VALUES ('$user1_name / $user2_name','DIRECT',$user1_id,2)";
    // echo $sql2."<br>";
    $res2 = mysqli_query($conn,$sql2);
    $sql_gId= "SELECT MAX(group_id) as gId FROM GROUPCHAT";
    $result = mysqli_query($conn,$sql_gId);
    $gId = mysqli_fetch_assoc($result)['gId'];
    $sql3 = "INSERT INTO `isInGroup`(`isInGroup_user_id`, `isInGroup_group_id`) VALUES ($user1_id,$gId)";    
    // echo $sql3."<br>";
    $res3 = mysqli_query($conn,$sql3);
    $sql4 = "INSERT INTO `isInGroup`(`isInGroup_user_id`, `isInGroup_group_id`) VALUES ($user2_id,$gId)";    
    // echo $sql4."<br>";
    $res4 = mysqli_query($conn,$sql4);
    $h = "Location: ../views/page-chat.php?id=$gId";
    // echo $h;
    // echo "</pre>";
    header($h);
    exit();
?>