<?php
require_once '../models/db.php';
session_start();
$user_id = $_SESSION['user_id'];
$name =  $_POST['groupname'];
$bio =  $_POST['groupbio'];
$select = $_POST['select'];



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
  die("merav");
}





$isInGroup_user_id = $_POST['select'];

$insert="INSERT INTO isInGroup(isInGroup_user_id, isInGroup_group_id) VALUES ";
$insert = $insert . "($user_id, $groupid);";
// echo $insert;
if(!empty($select)){
  // for($j = 0; $j<count($isInGroup_user_id); $j++){
  //   $insert=$insert . "(" . $isInGroup_user_id[$j] . "," . $groupid . ")";
  //   if($j == count($isInGroup_user_id)-1){
  //     $insert=$insert  . ";";
  //   }
  //   else{
  //     $insert=$insert  . ",";
  //   }
  // }

}
else{
  header("Location: ../views/creategroup2.php?err=1");
}

// echo $insert;


$isInGroup = $insert;



if ($conn->query($isInGroup) === TRUE) {
  header("Location: ../views/page-accueil.php");

} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}




$conn->close();
    
?>


