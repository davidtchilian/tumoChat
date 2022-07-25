<?php
require_once('../models/db.php');

$q = $_GET["q"];
$a = "SELECT user_id, user_email FROM USERS WHERE user_email LIKE '%$q%' LIMIT 10";

$sql = mysqli_query($conn, $a);
$row = mysqli_fetch_assoc($sql);
$names = array();
while ($row = mysqli_fetch_assoc($sql)) {
    $user = array();
    $user[] = $row['user_id'];
    $user[] = $row['user_email'];
    $names[] = $user;
}

echo json_encode($names);
?>