<?php 
require_once('../models/db.php');
session_start();

$user_email = $_POST['user_email'];
$user_pwrd = md5($_POST['user_pass']);

$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
if (!preg_match($regex, $user_email)) {
  header("Location: ../views/logIn.php?err=1");
}
$sql = "SELECT user_id FROM USERS WHERE user_email = '$user_email' AND user_password = '$user_pwrd'";
$result = $conn->query($sql);

if($result->num_rows == 1) {
    while($row = $result->fetch_assoc()) {
        $_SESSION['user_id'] = $row["user_id"];
        header("Location: ../views/page-accueil.php");
    }
  } 
  else {
    header("Location: ../views/logIn.php?err=2");
  }

$conn->close();
?>
