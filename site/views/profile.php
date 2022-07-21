<?php

    session_start();
    $userId = $_SESSION['user_id'];

    if (!isset($userId)) {
        header('Location: ./login.php?id=4');
        exit();
    }

    $guestId = $_GET['id'];
    $isGuest = true;

    if (!isset($guestId)) {
        $isGuest = false;
        $guestId = $userId;
    }

    $isGuest = $guestId != $userId;

    require('../models/db.php');
    include("../controllers/updatestatisticsinfo.php");

    $sql = "SELECT user_email, user_icon FROM USERS WHERE user_id=$guestId";
    $result = mysqli_query($conn, $sql);

    if ($result -> num_rows > 0) {
        if($row = mysqli_fetch_assoc($result)) {
            $usrmail = $row['user_email'];
            $usricon = $row['user_icon'];
            
        }
    } else{
        header('Location: ./login.php?id=4');
        exit();
    }

    if (!$isGuest) {
        $friends = file_get_contents($domain_name."/controllers/getfriends.php?user_id=$userId");
        $friends = json_decode($friends);
    }

?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>TUYU | profil </title>
    <link rel="icon" type="image/png" href="../assets/images/logo_tuyu-sm.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="../style/style.css">
    <script src="../scripts/changetheme.js"></script>
    <style>
        <?php $theme=$_SESSION['user_theme'];

        ?>body {
            background-image: url("../assets/images/themes/<?php echo $theme; ?>.jpg");
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg light-nav">
        <div class="container mt-5">
            <div class="container-fluid mt-5">
                <a href="<?php echo $isGuest ? "profile.php" : "page-accueil.php" ?>"><img src="../assets/images/flèche_retour3.png" alt="Retour"style="width : 35px; height: 35px; margin-left: 10px" /></a>
                <button class="navbar-toggler" type="button" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                </button>
                <?php
                if (!$isGuest) {
                ?>
                <div class="navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <div class="navigation modes">
                            <ul>
                                <?php
                                    $str = array();
                                    for ($i=0; $i < 4; $i++) {
                                        if ((int)$theme == $i) {
                                            $str[] = "list active";
                                        }else {
                                           $str[] = "list";
                                        }
                                    }
                                ?>
                                <li class="<?php echo $str[0]; ?>">
                                    <a onclick="changetheme(0)" href="#">
                                        <span class="icon">
                                            <ion-icon name="sunny-outline"></ion-icon>
                                        </span>
                                        <span class="text"> Light </span>
                                    </a>
                                </li>
                                <li class="<?php echo $str[1]; ?>">
                                    <a onclick="changetheme(1)" href="#">
                                        <span class="icon">
                                            <ion-icon name="moon-outline"></ion-icon>
                                        </span>
                                        <span class="text"> Dark </span>
                                    </a>
                                </li>
                                <li class="<?php echo $str[2]; ?>">
                                    <a onclick="changetheme(2)" href="#">
                                        <span class="icon">
                                            <ion-icon name="radio-button-off-outline"></ion-icon>
                                        </span>
                                        <span class="text"> Beige </span>
                                    </a>
                                </li>
                                <li class="<?php echo $str[3]; ?>">
                                    <a onclick="changetheme(3)" href="#">
                                        <span class="icon">
                                            <ion-icon name="radio-button-on-outline"></ion-icon>
                                        </span>
                                        <span class="text"> Violet </span>
                                    </a>
                                </li>
                                <div class="indicator"></div>
                            </ul>
                        </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div style="margin-top: 20px; ">
                <div class="card centered-card" style="  width: 400px; height: 300px;  ">
                    <div class="card-body">
                        <?php  echo "<img src='../assets/icons/$usricon.png' class='card-img-top' alt='profile_' style='height: 100px; width: 100px; margin-bottom:10px'>" ?>
                        <h3><span class="badge bg-secondary"><?php echo explode("@",$usrmail)[0];?></span></h5>
                            <h5 class="card-subtitle mb-2 text-muted">
                                <?php echo $usrmail;?>
                                </h5>
                                <div class="achievments">
                                <?php
                                    foreach (getUserbadges($conn, $guestId) as $badge) {
                                        echo "<img title='".$badge[1]."' src='../assets/badge/".$badge[0].".png' style='margin: 0 5px 0 5px;'>";
                                    }
                                ?>

                                </div>
                                <p class="card-text">
                                <?php 
                                    $bio = file_get_contents($domain_name."/controllers/getbio.php?id=".$guestId);
                                    echo $bio;
                                ?>
                                </p>
                                <?php  
                                if ($isGuest) { 
                                ?>
                                    <div class="profile-interactions">
                                        <?php
                                        $friends = file_get_contents($domain_name."/controllers/getfriends.php?user_id=$guestId");
                                        $friends = json_decode($friends);
                                        if (in_array(strval($userId), $friends)) { ?>
                                        <div class="user-profile-friend-status">
                                            <p>Friends</p>
                                            <img src="../assets/images/friend.png" alt="Friends">
                                        </div>
                                        <a href="../controllers/removefriend.php?user_id=<?php echo $userId; ?>&delete_id=<?php echo $guestId; ?>"
                                            class="user-profile-status friends-deactive">Remove Friend</a>
                                        <?php
                                        }
                                        else { 
                                            $sql = "SELECT notification_id FROM notifications WHERE notification_sender_id=$userId AND notification_receiver_id=$guestId AND notification_type_id=2";
                                            $result = mysqli_query($conn, $sql);
                                            $isRequested = $result->num_rows > 0;
                                            if ($isRequested) { ?>
                                                <a href="../controllers/removefriendrequest.php?requested_user_id=<?php echo $guestId ?>" class="user-profile-status friends-cancel">Cancel Request</a>
                                            <?php }
                                            else { ?>
                                                <a href="../controllers/sendfriendrequest.php?receiver_id=<?php echo $guestId ?>" class="user-profile-status friends-active">Add Friend</a>
                                            <?php
                                                }
                                            }
                                            ?>
                                    </div>
                                    <?php
                                } else { 
                                ?>
                                    <a href="editProfile.php" class="card-link" style="font-size: 20px; color: gray;">Edit Profile</a><br>
                                    <button type="button" class="btn btn-outline-secondary"><a href="../controllers/delete_acc.php" class="delete_acc"> Delete Account</a></button>
                                <?php 
                                }
                                ?>
                    </div>
                </div>

                <div id = "badges_div">
                    <?php
                        // include("../controllers/updatestatisticsinfo.php");
                        // $badges_info = getBadgesInfo($conn);
                        // $all_badges_info = array();
                        // while ($badge = mysqli_fetch_assoc($badges_info)) {
                        //     $badge_info = array();
                        //     array_push($badge_info,$badge);
                        //     array_push($all_badges_info,$badge_info);
                        // }
                        // $user_statistics = getUserStatistics($guestId, $conn);
                        // while ($stats = mysqli_fetch_assoc($user_statistics)) {
                        //     $individual_id = $stats["statistic_user_id"];
                        //     $statistic_type_id = $stats["statistic_type_id"];
                        //     $badge_requirement = $stats["statistic_count"];

                        //     foreach($all_badges_info as $individual_badge){
                        //         if ($individual_badge[0]["badge_id"] !== $statistic_type_id){ continue; };

                        //         if ($badge_requirement >= $individual_badge[0]["badge_requirement_count"]){
                        //             ?>
                        <!-- //             <div class="div">
                       //                 <?php echo $individual_id . " " . $statistic_type_id . " " . $badge_requirement ; ?> -->
                        <!-- //             </div> -->
                    <?php
                        //         }
                        //     }

                        // }
                    ?>
                </div>

            </div>
        </div>
    </div>
    <?php  
    if (!$isGuest) { 
    ?>
    <div class="div-titre" style="margin-top: 6rem; text-align: center;">
        <h1 class="Titre">Friends</h1>
    </div>
    <div class="container friends-container">
        <?php
        if (empty($friends)) { ?>
        <h3>You dont have any friends.</h3>
        <?php }
        foreach ($friends as $friend) {
            $friendId = intval($friend);
            $sql = "SELECT user_email, user_icon FROM USERS WHERE user_id = $friendId";
            $result = mysqli_query($conn,$sql);
            if ($result -> num_rows > 0) {
                if($row = mysqli_fetch_assoc($result)) {
                    $friendMail = $row['user_email'];
                    $friendIcon = $row['user_icon'];
                }
            }
            else {
                continue;
            }
        ?>
        <div class="row">
            <div style="margin-top: 20px; ">
                <div class="card centered-card" style="  width: 400px; height: 300px;  ">
                    <div class="card-body">
                        <?php echo "<img src='../assets/icons/$friendIcon.png' class='card-img-top' alt='profile_' style='height: 100px; width: 100px; margin-bottom:10px'>" ?>
                        <h3><span class="badge bg-secondary"><?php echo explode("@",$friendMail)[0];?></span></h5>
                            <h5 class="card-subtitle mb-2 text-muted">
                                <?php echo $friendMail;?>
                                </h5>
                                <div class="div"></div>

                                <p class="card-text">
                                    <?php 
                                    $bio = file_get_contents($domain_name."/controllers/getbio.php?id=".$friendId);
                                    echo $bio;
                                ?>
                                </p>
                                <a href="profile.php?id=<?php echo $friendId; ?>" class="card-link" style="font-size: 20px; color: gray;">View Profile</a>
                                
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
    <?php } ?>
    
    <script>
        const list = document.querySelectorAll('.list');

    function activeLink() {
        list.forEach((item) => item.classList.remove('active'));
        this.classList.add('active');
    }
    list.forEach((item) => item.addEventListener('click', activeLink))

    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>