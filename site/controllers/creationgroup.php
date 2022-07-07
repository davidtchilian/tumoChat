<?php

$name =  $_POST['name'];
$bio =  $_POST['bio'];
$select = $_POST['select'];


require_once '../models/db.php';
// $sql = "INSERT INTO GROUPCHAT(group_name, group_bio)
// VALUES ('$name', '$bio')";

// if ($conn->query($sql) === TRUE) {
//   echo "New record created successfully";
// } else {
//   echo "Error: " . $sql . "<br>" . $conn->error;
// }
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
var_dump($groupid);




$isInGroup_user_id = $_POST['select'];
$insert="INSERT INTO isInGroup(isInGroup_user_id, isInGroup_group_id) VALUES ";
for($j = 0; $j<count($isInGroup_user_id); $j++){
  $insert=$insert . "(" . $isInGroup_user_id[$j] . "," . $groupid . ")";
  if($j == count($isInGroup_user_id)-1){
    $insert=$insert  . ";";
  }
  else{
    $insert=$insert  . ",";
  }
  
}
echo $insert;




// $conn->close();
    
?>


