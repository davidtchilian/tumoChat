<?php
header('Access-Control-Allow-Origin: *');
require_once("../models/db.php");
$user_id = 2;
$sql_groupid = "SELECT isInGroup_group_id FROM isInGroup WHERE isInGroup_user_id= $user_id";
$result = mysqli_query($conn,$sql_groupid);
$groupids=array();
if ($result->num_rows > 0) {
	while($row = mysqli_fetch_assoc($result)) {
        $groupids[] = $row;
	}
	// var_dump($groupids);
} else{
	echo "[]";
	exit();
}

// mysqli_close();

$streaks=array();

foreach($groupids as $id){
	// echo "groupid :";
	// var_dump($id);
	// echo "<br>";
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
		
		// if ($flames >= 3) {
		// 	$arr = array("char" => "⭐");
		// 	echo json_encode($arr);
			
		// }
	}else {
		$flames = 0;
	}
	$streaks[]=array($id['isInGroup_group_id'],$flames);
	
}
echo json_encode($streaks);


?>


