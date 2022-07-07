<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "tumoChat";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// require_once('../models/db.php');
$email = $_POST['email'];
$password = $_POST['password'];
$password_hash = md5($password);
$confirmPassword = $_POST['confirmPassword'];

// echo($email);
// $select = mysqli_query($conn, "SELECT * FROM USERS WHERE user_email = '$email'");
$checkedEmail = mysqli_query($conn, "SELECT user_email FROM USERS WHERE user_email = '$email'");
if(mysqli_num_rows($checkedEmail)) {
    header("Location: ../views/signUp.php?err=1");
}
else{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../views/signUp.php?err=5");
    }
    else if(!strlen(str_replace(' ', '', $password))>0){
        header("Location: ../views/signUp.php?err=4");
    }
    else{
    if($password==$confirmPassword){
        if(strlen($password)<8){
            header("Location: ../views/signUp.php?err=3");
        }else{
        $sql = "
        INSERT INTO USERS(user_email,user_password,user_bio,user_theme,user_icon)
        VALUES ('$email', '$password_hash', '', 0, 0);";
        $conn->query($sql);
        header("Location: ../views/page-accueil.php");
        }
    }
    else{
        header("Location: ../views/signUp.php?err=2");
    }
}
}
?>