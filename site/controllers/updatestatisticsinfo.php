<?php
    
    function addStatistic($userId, $statisticTypeId, $conn) {
        $sql = "SELECT * FROM Statistics_Main WHERE statistic_user_id=$userId AND statistic_type_id=$statisticTypeId";
        $row_cnt = $result->num_rows;
        $result = mysqli_query($conn, $sql);
        if ($result -> num_rows > 0) {
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

    function getUserbadges($conn, $userId){
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
                    array_push($owned_badges[0], $badgeInfo);
                }
            }
            
        }
        return $owned_badges;
    }

?>