<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../models/db.php");
$user_id = $_POST["user_id"];
$new_pwd = $_POST["reset_pass"];
$password_hash = md5($new_pwd);
$new_pwd_confirm = $_POST["confirm_pass"];
$delete = "DELETE FROM RESET_PWD WHERE reset_pwd_user_id = $user_id;";
mysqli_query($conn, $delete);

$sql = "UPDATE USERS SET user_password = '$password_hash' WHERE user_id = $user_id;";
mysqli_query($conn, $sql);

    
mysqli_close($conn);
header('Location: ../views/logIn.php?id=5');
exit();