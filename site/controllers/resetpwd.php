<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../models/db.php");
$user_id = $_POST["user_id"];
$new_pwd = $_POST["reset_pass"];
$new_pwd_confirm = $_POST["confirm_pass"];
echo $new_pwd;
// if ($new_pwd == $new_pwd_confirm) {
//     $sql = "UPDATE user_password FROM USERS WHERE user_id == $user_id";
//     header('Location: ../views/logIn.php?id=5');
//     exit();
// }
header('Location: ../views/reset_pwd_form.php?id=1');
exit();


?>