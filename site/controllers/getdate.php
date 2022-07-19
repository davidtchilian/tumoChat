<?php
$groupid = $_GET["id"];
$user_id = 2;
require_once("../models/db.php");
$sql = "
SELECT DISTINCT Date(message_date) AS date
FROM MESSAGE 
WHERE message_sender_id = $user_id
AND message_group_id = $groupid
ORDER BY message_date DESC;";

$res = mysqli_query($conn, $sql);

$dates = array();

while($row = mysqli_fetch_assoc($res)){
	$dates[] = $row['date'];
}

// var_dump(date("d-m-y"));
if ($dates[0] == date('Y-m-d')) {
	// echo (date("d")-1);
	$flames = 1;
	for ($i=1; $i < count($dates); $i++) { 
		if ($dates[$i] == date('Y-m-d', strtotime("-".$i." days"))) {
			//if ($dates[$i] == (date("d")-$i)) {
			$flames += 1;
		}
		else{
			return 0;
		}
	}
	if ($flames >= 5) {
		$arr = array("char" => "⭐");
		echo json_encode($arr);
		
	}
	// echo "flames =".strval($flames);
}else{
	return "flames = 0";
}


?>


