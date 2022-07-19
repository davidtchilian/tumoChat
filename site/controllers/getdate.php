<?php
$groupid = $_GET["id"];
$user_id = 6;
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

var_dump($dates);
var_dump(date("dd-mm-yy") - 1);
if ($dates[0] == strtotime(date().'-'.$i.' day')) {
	$flames = 1;
	for ($i=1; $i < count($dates); $i++) { 
		if ($dates[$i] == date() - $i) {
			$flames = $flames + 1;
		}
	}
	echo "flames =".strval($flames);
}else{
	return "flames = 0";
}
?>