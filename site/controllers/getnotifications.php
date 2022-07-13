<?php 
    require_once("../models/db.php");
    session_start();
    $usrid = $_SESSION['user_id'];

    $sql = "SELECT notification_id,notification_sender_id,	notification_receiver_id,notification_group_id,notification_content 
    FROM  NOTIFICATIONS WHERE notification_receiver_id = $usrid";

    $result = mysqli_query($conn,$sql);
    if($result->num_rows == 1) {
        while($row = $result->fetch_assoc()) {
            session_start();
            $_SESSION['user_id'] = $row["user_id"];
            $_SESSION['user_theme'] = $row["user_theme"];
            header("Location: ../views/page-accueil.php");
        }
      } 
    var_dump($result);

    $info = array();

    echo json_encode($info);

?>