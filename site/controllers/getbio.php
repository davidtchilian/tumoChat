<?php

header('Access-Control-Allow-Origin: *');

require_once("../models/db.php");

$userId = $_GET['id'];

$sql = "SELECT user_bio FROM users WHERE user_id=$userId";
$result = mysqli_query($conn, $sql);

echo mysqli_fetch_assoc($result)['user_bio'];


?>