<?php
require_once("../models/db.php");
$groupid = $_GET['id'];
echo "group id :".$groupid."<br>";

    $sql = "SELECT group_name, group_bio FROM GROUPCHAT WHERE group_id = $groupid";
   
    $result = mysqli_query($conn,$sql);
    if ($result->num_rows > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo json_encode($row);
            echo "<br>";
           // echo "<br> group name : ". $row["group_name"]."<br>". "group bio : ". $row["group_bio"]. " " . "<br>";
        }
    } else {
        echo "0 results";
    }
  
    $sql2 = "SELECT isInGroup_user_id FROM isInGroup WHERE isInGroup_group_id = $groupid";
    $result2 = mysqli_query($conn,$sql2);
    if ($result2->num_rows > 0) {
        while($row = mysqli_fetch_assoc($result2)) {
            echo json_encode($row)."<br>";
            //echo "<br> group users id : ". $row["isInGroup_user_id"];
        }
    } else {
        echo "0 results";
    }
    mysqli_close($conn);
?>