<?php

session_start();
$user_id = $_SESSION['user_id'];
$name =  $_POST['groupname'];
$bio =  $_POST['groupbio'];
$select = $_POST['select'];



if (count($select) ==0) {
  header("Location: ../views/creategroup2.php?err=1");
  exit();
}
require_once('../models/db.php');




$sql = "INSERT INTO GROUPCHAT(group_name, group_bio, group_admin_id)
VALUES ('$name', '$bio', $user_id)";


if (mysqli_query($conn,$sql) === TRUE) {
  // echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$groupid = "";
$sql = "SELECT MAX(group_id) AS group_id FROM GROUPCHAT";
$result = mysqli_query($conn,$sql);
if ($result->num_rows == 1) {
  if($row = $result->fetch_assoc()) {
      $groupid = $row["group_id"];
      }
}
else{
  die();
}





$isInGroup_user_id = $_POST['select'];

$insert="INSERT INTO isInGroup(isInGroup_user_id, isInGroup_group_id) VALUES ";
$insert = $insert . "($user_id, $groupid),";
// echo $insert;

  for($j = 0; $j<count($isInGroup_user_id); $j++){
    $insert=$insert . "(" . $isInGroup_user_id[$j] . "," . $groupid . ")";
    if($j == count($isInGroup_user_id)-1){
      $insert=$insert  . ";";
    }
    else{
      $insert=$insert  . ",";
    }
  }



//  echo "<br>".$insert;






mysqli_query($conn, $insert);
mysqli_close($conn);
header('Location: ../views/page-accueil.php');
exit();
// echo "hello";





// header("Location: ../views/page-accueil.php");

    
?>


