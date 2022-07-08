<?php
require_once("../models/db.php");
$groupid = $_GET['id'];
$messageid = $_SESSION['message_id'];
// $sql1 = "SELECT * FROM MESSAGE WHERE message_id = $messageid";
// $result = $conn->query($sql1);
if($result->num_rows > 1){
    if($row = $result->fetch_assoc()) {
        $sql = "DELETE FROM MESSAGE WHERE message_id = $messageid";
        $result = mysqli_query($conn,$sql);
        mysqli_close();
    }
}
?>