<?php
header('Access-Control-Allow-Origin: *');
if(!isset($_GET['id'])){
    die("id not found");
}
require_once("../models/db.php");
$groupid = $_GET['id'];
    $type = mysqli_query($conn, "SELECT group_type FROM GROUPCHAT WHERE group_id = $groupid");
    $sql = "SELECT group_name, group_bio FROM GROUPCHAT WHERE group_id = $groupid";
   
    $result = mysqli_query($conn,$sql);
    $groups = array();
    if ($result->num_rows > 0) {
        while($row1 = mysqli_fetch_assoc($result)) {
            $temper = array();
            $temper[] = $row1;
            $groups = $temper;
        }
    } else {
        echo "0 results";
    }
    
    echo json_encode($groups);
    mysqli_close($conn);
?>