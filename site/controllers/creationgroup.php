<?php
require_once '../models/db.php';
$user_id = $_SESSION['user_id'];
$name =  $_POST['groupname'];
$bio =  $_POST['groupbio'];
$select = $_POST['select'];



$sql = "INSERT INTO GROUPCHAT(group_name, group_bio, )
VALUES ('$name', '$bio')";


if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
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
$insert = $insert . "(" . $user_id . "," . $groupid . "),";
for($j = 0; $j<count($isInGroup_user_id); $j++){
  $insert=$insert . "(" . $isInGroup_user_id[$j] . "," . $groupid . ")";
  if($j == count($isInGroup_user_id)-1){
    $insert=$insert  . ";";
  }
  else{
    $insert=$insert  . ",";
  }

  
}


$isInGroup = $insert;



if ($conn->query($isInGroup) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}




$conn->close();
    
?>


