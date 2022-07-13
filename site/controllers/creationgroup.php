<?php
require_once '../models/db.php';
session_start();
$user_id = $_SESSION['user_id'];
$name =  $_POST['groupname'];
$bio =  $_POST['groupbio'];
$select = $_POST['select'];

if (count($select) == 0) {
  header("Location: ../views/creategroup2.php?err=1");
}


$sql = "INSERT INTO GROUPCHAT(group_name, group_bio, group_admin_id)
VALUES ('$name', '$bio', $user_id)";


if ($conn->query($sql) === TRUE) {
  // echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$groupid = "";
$sql = "SELECT MAX(group_id) AS group_id FROM GROUPCHAT";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
  if($row = $result->fetch_assoc()) {
      $groupid = $row["group_id"];
      }
}
else{
  die();
}

$insert="INSERT INTO isInGroup(isInGroup_user_id, isInGroup_group_id) VALUES('$user_id','$groupid')";

mysqli_query($conn,$insert);

foreach ($select as $key => $receiver) {
  $notif = "INSERT INTO NOTIFICATIONS(notification_sender_id,notification_receiver_id,notification_group_id,notification_content) VALUES($user_id, $receiver, $groupid, '$name')";
  mysqli_query($conn,$notif);
}
header('Location: ../views/page-accueil.php');
// echo "hello";





// header("Location: ../views/page-accueil.php");
$conn->close();
    
?>


