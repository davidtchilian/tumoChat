<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "tumoChat";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];
$password_hash = md5($password);
$confirmPassword = $_POST['confirmPassword'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../views/signUp.php?id=5");
        exit();
    }
    $checkedEmail = mysqli_query($conn, "SELECT user_email FROM USERS WHERE user_email = '$email'");
    if(mysqli_num_rows($checkedEmail)) {
    header("Location: ../views/signUp.php?id=1");
    exit();
    }

else if($password == $confirmPassword){

    if ($password == "gmail") {
        $sql = "INSERT INTO USERS(user_email,user_password,user_bio,user_theme,user_icon) VALUES ('$email', 'gmail', '', 0, 0);";
        $conn->query($sql);
        header("Location: ../views/logIn.php?id=0");
    }
    else if(strlen($password) < 8){
        header("Location: ../views/signUp.php?id=3");
        exit();
    }
    else if(!strlen(str_replace(' ', '', $password)) > 0){
        header("Location: ../views/signUp.php?id=4");
        exit();
    }

    
    else {
        $sql = "
        INSERT INTO USERS(user_email,user_password,user_bio,user_theme,user_icon)
        VALUES ('$email', '$password_hash', '', 0, 0);";
        $conn->query($sql);
        header("Location: ../views/logIn.php?id=0");
        }
    }
    else{    
        header("Location: ../views/signUp.php?id=2");
    } 
    


?>