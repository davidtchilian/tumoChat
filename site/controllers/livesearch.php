<?php
require_once('../models/db.php');

$q = $_GET["q"];
if ($q == "") {
    exit();
}
$a = "SELECT user_id, REPLACE(user_email, '@tumo.org', '') AS mail FROM USERS WHERE REPLACE(user_email, '@tumo.org', '') LIKE '%$q%' LIMIT 10";

$sql = mysqli_query($conn, $a);
$names = array();
while ($row = mysqli_fetch_assoc($sql)) {
    $user = array();
    $user[] = $row['user_id'];
    $user[] = $row['mail'];
    $names[] = $user;
}
echo json_encode($names);
?>