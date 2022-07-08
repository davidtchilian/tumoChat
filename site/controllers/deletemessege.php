<?php
session_start();
require_once("../models/db.php");
$groupid = $_GET['id'];
$messageid = $_GET['message_id'];
$userid = $_SESSION['user_id'];
$sql1 = "SELECT message_sender_id FROM MESSAGE WHERE message_id = $messageid";
 $result = $conn->query($sql1);
if($result->num_rows > 0){
    if($row = $result->fetch_assoc()) {

        $sender = $row["message_sender_id"];
    }
    else {
        mysqli_close();
    }
}
else{
    mysqli_close();
}
if($sender == $userid){
    $sql = "DELETE FROM MESSAGE WHERE message_id = $messageid";
    $result = mysqli_query($conn,$sql);
    mysqli_close();
}
?>