
<?php
$groupid = $_POST[''];
    $sql = 'SELECT group_name, group_bio
    FROM GROUPCHAT
    WHERE group_id = $groupid;

    SELECT isInGroup_user_id
    FROM isInGroup 
    WHERE isInGroup_group_id = $groupid';
?>