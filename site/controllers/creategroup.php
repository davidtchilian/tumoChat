<?php

$name =  $_POST['name'];
$bio =  $_POST['bio'];
$select = $_POST['select'];

include '../models/db.php';
$sql = "INSERT INTO GROUPCHAT(group_name, group_bio)
VALUES ('$name', '$bio')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
    
?>


