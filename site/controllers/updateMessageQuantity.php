<?php 
     $limit = $_POST['limitCount'];
 
     $sql = "SELECT q.* FROM 
     (SELECT * 
      FROM message 
      WHERE message_group_id=$groupId
      ORDER BY `message_id` DESC LIMIT $limit) 
     q ORDER BY q.`message_id` ASC";
     $messages = mysqli_query($conn, $sql);
     mysqli_close($conn);
    
   

?>