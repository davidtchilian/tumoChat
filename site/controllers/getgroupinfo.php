<?php
header('Access-Control-Allow-Origin: *');
if(!isset($_GET['id'])){
    die("id not found");
}
require_once("../models/db.php");
$groupid = $_GET['id'];

    $sql = "SELECT group_name, group_bio FROM GROUPCHAT WHERE group_id = $groupid";
   
    $result = mysqli_query($conn,$sql);
    $groups = array();
    if ($result->num_rows > 0) {
        while($row1 = mysqli_fetch_assoc($result)) {
            $temper = array();
            $temper[] = $row1;
            $groups = $temper;
            // echo json_encode($row1);
            // echo "<br>";
           // echo "<br> group name : ". $row["group_name"]."<br>". "group bio : ". $row["group_bio"]. " " . "<br>";
        }
    } else {
        echo "0 results";
    }
  
    $sql2 = "SELECT DISTINCT user_id, user_email FROM USERS, isInGroup WHERE isInGroup_group_id = $groupid";
    $result2 = mysqli_query($conn,$sql2);
    $users = array();
    if ($result2->num_rows > 0) {
        while($row2 = mysqli_fetch_assoc($result2)) {
            $temp = array();
            $temp[] =$row2; 
            $users[] = $temp;
           // echo json_encode($row2)."<br>";
            //echo "<br> group users id : ". $row["isInGroup_user_id"];
        }
    } else {
        echo "0 results";
    }
    $all = array();
    array_push($all,$groups);
    array_push($all,$users);
    echo json_encode($all);
    mysqli_close($conn);
?>