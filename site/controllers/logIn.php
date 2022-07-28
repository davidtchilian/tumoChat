<?php 
require_once('../models/db.php');
include("../models/functions.php");

$user_email = $_POST['user_email'];
$user_password = $_POST['user_pass'];
$user_password_hash = md5($_POST['user_pass']);
if(isset($_POST['gmail_pass'])){
  $gmail_pass = $_POST['gmail_pass'];

  if ($gmail_pass == "1") {
    if ($user_password == "gmail") {
      $user_password_hash = "gmail";
    }
  }
}


$sql = "SELECT user_id, user_theme FROM USERS WHERE user_email = '$user_email' AND user_password = '$user_password_hash'";
$result = $conn->query($sql);

if($result->num_rows == 1) {
    while($row = $result->fetch_assoc()) {
        session_start();
        $_SESSION['user_id'] = $row["user_id"];
        $_SESSION['user_theme'] = $row["user_theme"];
        addStatistic($row["user_id"], 1, $conn);

        header("Location: ../views/home.php");
        exit();
    }
  } 
  else {  
    header("Location: ../views/logIn.php?id=1");
    exit();
  }

mysqli_close($conn);
?>
