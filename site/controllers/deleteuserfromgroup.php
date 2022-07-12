<?php
session_start();
require_once("../models/db.php");
$groupid = $_GET['id'];
$deletingid = $_GET['delid'];
$sql = "DELETE FROM isINGROUP WHERE user_id = $deletingid";
$result = mysqli_query($conn,$sql);
mysqli_close();

?>