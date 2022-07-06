<?php
require_once("../models/db.php");
$groupid = $_POST[''];
    $sql = 'SELECT group_name, group_bio FROM GROUPCHAT WHERE group_id = $groupid';
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<br> group_name: ". $row["group_name"]. " - group_id: ". $row["group_id"]. " " . $row["lastname"] . "<br>";
        }
    } else {
        echo "0 results";
    }
    //$sql2 = 'SELECT isInGroup_user_id FROM isInGroup WHERE isInGroup_group_id = $groupid';
?>