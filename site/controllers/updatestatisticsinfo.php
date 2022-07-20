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
        $info = array();
        while ($badge -> mysqli_fetch_assoc($result)) {
            array_push($info, $badge);
        }
        return $info;
    }

    function get_user_statistics($userid,$conn){
        $sql = "SELECT * FROM Statistics_Main WHERE statistic_user_id=$userId";
        $result = mysqli_query($conn, $sql);
        $info = array();
        while ($stat -> mysqli_fetch_assoc($result)) {
            array_push($info, $stat);
        }
        return $info;
    }

?>