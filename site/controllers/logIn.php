<?php 
require_once('../models/db.php');
session_start();


$user_email = $_POST['user_email'];
$user_pwrd = md5($_POST['user_pass']);

// var_dump($user_email);
// var_dump($user_pwrd);

$sql = "SELECT user_id FROM USERS WHERE user_email = '$user_email' AND user_password = '$user_pwrd'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    while($row = $result->fetch_assoc()) {
        $_SESSION['user_id'] = $row["user_id"];
    }
  } 
  else {
    header("Location: ../views/logIn.php?err=1");
  }

var_dump($_SESSION);
$conn->close();
?>
