<?php
$name =  $_POST['name'];
$bio =  $_POST['bio'];
$select = $_POST['select'];
"INSERT INTO GROUPCHAT(group_name, group_bio) VALUES ('$name', '$bio')";
    
?>



<?php


$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('John', 'Doe', 'john@example.com')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
