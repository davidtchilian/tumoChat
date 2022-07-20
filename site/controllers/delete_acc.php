<?php
session_start();
$userId = $_SESSION['user_id'];
if (!isset($userId)) {
    header('Location: ./login.php?id=4');
    exit();
}
require('../models/db.php');
$sql = "DELETE * FROM NOTIFICATIONS WHERE notification_receiver_id = $userId";
echo $sql;





?>