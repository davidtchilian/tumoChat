<?php
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];
if($password==$confirmPassword){
    $sql = "
    INSERT INTO USERS(user_email,user_password,user_bio,user_theme,user_icon)
    VALUES ('$email', '$password', '', 0, 0);";
    execute($sql);
}

?>