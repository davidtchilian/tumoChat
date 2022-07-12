<?php 
require_once('../models/db.php');

$user_email = $_POST['user_email'];
$user_pwrd = md5($_POST['user_pass']);

$sql = "SELECT user_id, user_theme FROM USERS WHERE user_email = '$user_email' AND user_password = '$user_pwrd'";
$result = $conn->query($sql);

if($result->num_rows == 1) {
    while($row = $result->fetch_assoc()) {
        session_start();
        $_SESSION['user_id'] = $row["user_id"];
        $_SESSION['user_theme'] = $row["user_theme"];
        header("Location: ../views/page-accueil.php");
    }
  } 
  else {
    header("Location: ../views/logIn.php?id=1");
  }

$conn->close();
?>
