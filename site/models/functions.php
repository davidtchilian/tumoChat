<?php

    function curl($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $return = curl_exec($ch);
        curl_close($ch);
        return $return;
    }

    function getUserInfo($conn, $userId) {
        $sql = "SELECT * FROM users WHERE user_id=$userId";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows <= 0) {
            return null;
        }
        return mysqli_fetch_assoc($result);
    }

    function getFriends($conn, $userId) {
        $friendsList = array();

        $sql = "SELECT DISTINCT * FROM friends WHERE user_id_1=$userId";
        $friends = mysqli_query($conn, $sql);

        if (mysqli_num_rows($friends) > 0) {
            while ($friend = mysqli_fetch_assoc($friends)) {
                array_push($friendsList, $friend['user_id_2']);
            }
        }

        $sql = "SELECT DISTINCT * FROM friends WHERE user_id_2=$userId";
        $friends = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($friends) > 0) {
            while ($friend = mysqli_fetch_assoc($friends)) {
                array_push($friendsList, $friend['user_id_1']);
            }
        }
        
        return $friendsList;
    }

    function hasFriendRequest($conn, $requester, $receiver){
        $sql = "SELECT notification_id FROM notifications WHERE notification_sender_id=$requester AND notification_receiver_id=$receiver AND notification_type_id=2";
        $result = mysqli_query($conn, $sql);
        return $result->num_rows > 0;
    }

    function getgroupinfo($conn, $groupId){
        $sql = "SELECT * FROM GROUPCHAT WHERE group_id = $groupId";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows <= 0) {
            return null;
        }
        return mysqli_fetch_assoc($result);
    }

    function getGroupUsersId($conn, $groupId) {
        $users = array();
        $sql = "SELECT DISTINCT user_id
            FROM USERS INNER JOIN isInGroup ON isInGroup.isInGroup_user_id = USERS.user_id
            WHERE isInGroup_group_id = $groupId";
        $result = mysqli_query($conn, $sql);
        
        while ($user = mysqli_fetch_assoc($result)) {
            $users[] = $user['user_id'];
        }
        
        return $users;
    }

    function getGroupUsersEmail($conn, $groupId) {
        $users = array();
        $sql = "SELECT user_email
            FROM USERS INNER JOIN isInGroup ON isInGroup.isInGroup_user_id = USERS.user_id
            WHERE isInGroup_group_id = $groupId";
        $result = mysqli_query($conn, $sql);
        while ($user = mysqli_fetch_assoc($result)) {
            $users[] = $user['user_email'];
        }
        return $users;
    }

  

    function getLastMessages($conn, $groupId) {
        $messages = array();
        $sql = "SELECT message_content FROM message WHERE message_group_id = $groupId ORDER BY message_date DESC LIMIT 2";
        $lastMessages = mysqli_query($conn, $sql);

        while ($message = mysqli_fetch_assoc($lastMessages)) {
            array_push($messages, $message["message_content"]);
        }

        array_reverse($messages);

        // Sticker sort
        foreach ($messages as $m) {
            if (explode("_", $m)[0] == "STICKER") {
                $m = "Sent sticker";
            }
        }
        return $messages;
    }

    function getNotifications($conn, $userId) {
        $sql = "SELECT notification_id, notification_sender_id, notification_group_id, notification_content, typeName
            FROM NOTIFICATIONS JOIN typeNotification ON notification_type_id = typeNotification_id WHERE notification_receiver_id = $userId";
        $notifs = array();

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $notifs[] = $row;
            }
        }
        return $notifs;
    }

    function getbio($conn, $userId){
        $userId = $_GET['id'];

        $sql = "SELECT user_bio FROM users WHERE user_id=$userId";
        $result = mysqli_query($conn, $sql);

        return mysqli_fetch_assoc($result)['user_bio'];
    }

    function getGroupAdmin($conn, $gid){
        $adminid = "SELECT group_admin_id FROM GROUPCHAT WHERE group_id = $gid";
        $result = mysqli_query($conn, $adminid);
        return mysqli_fetch_assoc($result)['group_admin_id'];
    }

    function getMessages($conn, $groupId){
        $all = array();
        $sql = "SELECT * FROM message WHERE message_group_id=$groupId";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $all[] = $row;
        }
        return $all;
    }

    function addStatistic($userId, $statisticTypeId, $conn) {
        $sql = "SELECT * FROM Statistics_Main WHERE statistic_user_id=$userId AND statistic_type_id=$statisticTypeId";
        $result = mysqli_query($conn, $sql);
        $row_cnt = mysqli_num_rows($result);
        if ($row_cnt > 0) {
            $count = mysqli_fetch_assoc($result)['statistic_count'] + 1;
            $sql = "UPDATE Statistics_Main SET statistic_count=$count WHERE statistic_user_id=$userId AND statistic_type_id =$statisticTypeId ";
            mysqli_query($conn, $sql);
        } else {
            $sql = "INSERT INTO Statistics_Main (statistic_user_id,statistic_type_id,statistic_count) VALUES ($userId,$statisticTypeId,1)";
            mysqli_query($conn, $sql);
        }
    
    }

    function getBadgesInfo($conn){
        $sql = "SELECT * FROM Badges";
        $result = mysqli_query($conn, $sql);
        return $result;
    }

    function getUserStatistics($userId, $conn){
        $sql = "SELECT * FROM Statistics_Main WHERE statistic_user_id=$userId";
        $result = mysqli_query($conn, $sql);
        return $result;
    }

    function getUserBadges($conn, $userId){
        $badges_info = getBadgesInfo($conn);
        $all_badges_info = array();
        $owned_badges = array();
        while ($badge = mysqli_fetch_assoc($badges_info)) {
            $badge_info = array();
            array_push($badge_info,$badge);
            array_push($all_badges_info,$badge_info);
        }
        $user_statistics = getUserStatistics($userId, $conn);
        while ($stats = mysqli_fetch_assoc($user_statistics)) {
            $individual_id = $stats["statistic_user_id"];
            $statistic_type_id = $stats["statistic_type_id"];
            $badge_requirement = $stats["statistic_count"];

            foreach($all_badges_info as $individual_badge){
                if ($individual_badge[0]["badge_id"] !== $statistic_type_id){ continue; };

                if ($badge_requirement >= $individual_badge[0]["badge_requirement_count"]){
                    $badgeInfo = array();
                    array_push($badgeInfo, $individual_badge[0]["badge_id"]);
                    array_push($badgeInfo, $individual_badge[0]["badge_name"]);
                    array_push($owned_badges, $badgeInfo);
                }
            }
            
        }
        return $owned_badges;
    
}

function getStreakIcon($streak)
{

              if ($streak >= 3 && $streak < 7) {
                return $streak."⭐";
              }
              else if ($streak >= 7 && $streak < 21) {
                return $streak."🌟";

              }
              else if ($streak >= 21 && $streak < 42) {
                return $streak."💫";
              }

              else if ($streak >= 42 && $streak < 126) {
                return $streak."✨";
              }

              else if ($streak >= 126 && $streak < 182) {
                return $streak."🌠";
              }

              else if ($streak >= 182 ) {
                return $streak."🌌";
              }

}
function getStreaks($conn,$user_id){

    $sql_groupid = "SELECT isInGroup_group_id FROM isInGroup WHERE isInGroup_user_id= $user_id";
    $result = mysqli_query($conn,$sql_groupid);
    $groupids=array();
    if ($result->num_rows > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $groupids[] = $row;
        }
    } else{
        return $groupids;
    }


    $streaks = array();

    foreach($groupids as $id){
        $gid = $id['isInGroup_group_id'];
            $sql = "
            SELECT DISTINCT Date(message_date) AS date
            FROM MESSAGE 
            WHERE message_sender_id = $user_id
            AND message_group_id = $gid
            ORDER BY date DESC;";

        $result = mysqli_query($conn, $sql);
        $dates = array();

        while($row = mysqli_fetch_assoc($result)){
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
        $streaks[$id['isInGroup_group_id']]=$flames;

    }

    return $streaks;
}


