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
echo "Connected successfully";
// require_once('../models/db.php');
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];
echo($password);
echo($confirmPassword);

// echo($email);
// $select = mysqli_query($conn, "SELECT * FROM USERS WHERE user_email = '$email'");
$checkedEmail = mysqli_query($conn, "SELECT user_email FROM USERS WHERE user_email = '$email'");
if(mysqli_num_rows($checkedEmail)) {
    echo('This username already exists');
}
else{
    if($password==$confirmPassword){
        $sql = "
        INSERT INTO USERS(user_email,user_password,user_bio,user_theme,user_icon)
        VALUES ('$email', '$password', '', 0, 0);";
        $conn->query($sql);

    }
    else{
        echo("The passwords dont match!");
    }
}

?>