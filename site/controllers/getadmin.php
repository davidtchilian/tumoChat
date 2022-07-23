<?php
    $adminid = "SELECT group_admin_id FROM GROUPCHAT";
    mysqli_query($conn,$adminid);
    mysqli_close($conn);
?>
