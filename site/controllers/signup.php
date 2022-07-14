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

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../views/signUp.php?id=5");
        exit();
    }
    $checkedEmail = mysqli_query($conn, "SELECT user_email FROM USERS WHERE user_email = '$email'");
    //Checking mail 
    if(mysqli_num_rows($checkedEmail)) {
    header("Location: ../views/signUp.php?id=1");
    exit();
    }
    //Is Valid Email
else if($password == $confirmPassword){
    //Passwords Match
    if(strlen($password) < 8){
        //Password is too short
        header("Location: ../views/signUp.php?id=3");
        exit();
    }
    else if(!strlen(str_replace(' ', '', $password)) > 0){
        //Password is Empty
        header("Location: ../views/signUp.php?id=4");
        exit();
    }
    //Pass is Correct
    
    else{
        $sql = "
        INSERT INTO USERS(user_email,user_password,user_bio,user_theme,user_icon)
        VALUES ('$email', '$password_hash', '', 0, 0);";
        $conn->query($sql);
        $user_id = mysqli_query($conn, "SELECT user_id FROM USERS WHERE user_email = '$email'"); //NEED TO ADD FETCH
        $row = $user_id->fetch_assoc();
        $userid = $row['user_id'];
        
        for($i = 1; $i <= 14; $i++){
            $sqlAdd = "INSERT INTO isInGroup(isInGroup_user_id, isInGroup_group_id) VALUES ($userid, $i)";
            $conn->query($sqlAdd);
        }
        header("Location: ../views/logIn.php?id=0");
        }
    }
    else{    
        header("Location: ../views/signUp.php?id=2");
    } 
    
// echo($email);
// $select = mysqli_query($conn, "SELECT * FROM USERS WHERE user_email = '$email'");


?>