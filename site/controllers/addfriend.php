<?php

$userId1 = $_GET['user_id_1'];
$userId2 = $_GET['user_id_2'];

if (!isset($userId1) || !isset($userId2)) {
    header('Location: ../views/home.php');
    exit();
}

require_once("../models/db.php");
$sql = "INSERT INTO friends (user_id_1, user_id_2) VALUES ($userId1, $userId2)";
mysqli_query($conn, $sql);

header('Location: ../views/home.php');
exit();
?>