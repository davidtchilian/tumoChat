<?php
function curl($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    $return = curl_exec($ch);
    curl_close ($ch);
    return $return;
}


function getUserInfo($userid, $conn){
    $sql = "SELECT * FROM users WHERE user_id=$userid";
    $result = mysqli_query($conn, $sql);
    $info = mysqli_fetch_assoc($result);
    
    return $info;
}

function getfriends($userId, $conn){     
    $friendsList = array();
    
    $sql = "SELECT DISTINCT * FROM friends WHERE user_id_1=$userId";
    $friends = mysqli_query($conn, $sql);

    while ($friend = mysqli_fetch_assoc($friends)['user_id_2']) {
        array_push($friendsList, $friend);
    }

    $sql = "SELECT DISTINCT * FROM friends WHERE user_id_2=$userId";
    $friends = mysqli_query($conn, $sql);

    while ($friend = mysqli_fetch_assoc($friends)['user_id_1']) {
        array_push($friendsList, $friend);
    }

    return array_unique($friendsList);
 

}