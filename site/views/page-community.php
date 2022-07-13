<?php
$communityId = $_GET['id'];
  session_start();
  $isincommunity = false;
  $isincommunity_message = false;

  if (!isset($user_Id)) {
    header("Location: login.php");
    return;
  }

  if (!isset($communityId)) {
    header("Location: community.php");
    return;
  }

  require('../models/db.php');
 
  $sql = "SELECT * FROM message WHERE message_group_id='$communityId'";
  $messages = mysqli_query($conn, $sql);
//   $message = mysqli_fetch_assoc($messages);

  $comm_users = file_get_contents($domain_name."/controllers/getcommusers.php?id=".$communityId);
  $comm_users = json_decode($group_users);

  for ($i=0; $i < count($comm_users); $i++) { 
      if($comm_users[$i] == $userId){
        $isincommunity = true;
      }
  }

  if($isincommunity == false){
      header("Location: community.php");
  }

  $sql = "SELECT community_name FROM community WHERE community_id='$communityId'";
  $commName = mysqli_fetch_assoc(mysqli_query($conn, $sql))["community_name"];
  
  mysqli_close($conn);
  ?>