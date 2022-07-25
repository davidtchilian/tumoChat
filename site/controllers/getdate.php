<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once("../models/db.php");
$user_id = $_SESSION['user_id'];
$sql_groupid = "SELECT isInGroup_group_id FROM isInGroup WHERE isInGroup_user_id= $user_id";
$result = mysqli_query($conn,$sql_groupid);
$groupids=array();
if ($result->num_rows > 0) {
	while($row = mysqli_fetch_assoc($result)) {
        $groupids[] = $row;
	}
} else{
	echo "[]";
	exit();
}


$streaks=array();

foreach($groupids as $id){
	$gid = $id['isInGroup_group_id'];
		$sql = "
		SELECT DISTINCT Date(message_date) AS date
		FROM MESSAGE 
		WHERE message_sender_id = $user_id
		AND message_group_id = $gid
		ORDER BY message_date DESC;";

	$res = mysqli_query($conn, $sql);

	$dates = array();

	while($row = mysqli_fetch_assoc($res)){
		$dates[] = $row['date'];
	}
	if ($dates[0] == date('Y-m-d')) {
		
		$flames = 1;
		
		for ($i=1; $i < count($dates); $i++) { 
			if ($dates[$i] == date('Y-m-d', strtotime("-".$i." days"))) {
				$flames += 1;				
			}	
			else{
				$flames = 0;
			}		
		}	
	}else {
		$flames = 0;
	
	}
	$streaks[]=array($id['isInGroup_group_id'],$flames);
	
}

echo json_encode($streaks);
//session_destroy();

?>


