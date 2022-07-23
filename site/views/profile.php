<?php

    require_once('../models/db.php');
    include('../models/functions.php');
    include("../controllers/updatestatisticsinfo.php");

    session_start();
    $userId = $_SESSION['user_id'];
    $theme = $_SESSION['user_theme'];

    if (!isset($userId)) {
        header('Location: ./login.php?id=4');
        exit();
    }

    $guestId = isset($_GET['id']) ? $_GET['id'] : $userId;
    $isGuest = $guestId != $userId;

    $userInfo = getUserInfo($conn, $guestId);

    if ($userInfo == null) {
        header('Location: ./login.php?id=4');
        exit();
    }
    else {
        $userMail = $userInfo['user_email'];
        $userIcon = $userInfo['user_icon'];
    }

    $friends = getFriends($conn, $userId);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Tumo Chat | Profile </title>
    <link rel="icon" type="image/png" href="../assets/images/logo_tuyu-sm.png" />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>   
    <script src="../scripts/changetheme.js"></script>
    <link rel="stylesheet" href="../style/style.css">
    <style>
        body {
            background-image: url("../assets/images/themes/<?php echo $theme; ?>.jpg");
        }
    </style>
</head>
<body>
    <div class="navigation-bar-themes">
        <div class="navbar-container">
            <a href="<?php echo $isGuest ? "profile.php" : "home.php" ?>"><img src="../assets/images/flèche_retour3.png" alt="Retour" style="width : 35px; height: 35px;" /></a>
        </div>
        <?php
            if (!$isGuest) {
        ?>
        <div class="navbar-container">
            <ul class="">
                <div class="navigation modes">
                    <ul>
                        <?php
                            $classes = array();
                            for ($i = 0; $i < 4; $i++) {
                                $classes[] = ((int) $theme == $i) ? "list active" : "list";
                            }
                        ?>
                        <li class="<?php echo $classes[0]; ?>">
                            <a onclick="changetheme(0)">
                                <span class="icon">
                                    <ion-icon name="sunny-outline"></ion-icon>
                                </span>
                                <span class="text"> Light </span>
                            </a>
                        </li>
                        <li class="<?php echo $classes[1]; ?>">
                            <a onclick="changetheme(1)">
                                <span class="icon">
                                    <ion-icon name="moon-outline"></ion-icon>
                                </span>
                                <span class="text"> Dark </span>
                            </a>
                        </li>
                        <li class="<?php echo $classes[2]; ?>">
                            <a onclick="changetheme(2)">
                                <span class="icon">
                                    <ion-icon name="radio-button-off-outline"></ion-icon>
                                </span>
                                <span class="text"> Beige </span>
                            </a>
                        </li>
                        <li class="<?php echo $classes[3]; ?>">
                            <a onclick="changetheme(3)">
                                <span class="icon">
                                    <ion-icon name="radio-button-on-outline"></ion-icon>
                                </span>
                                <span class="text"> Violet </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </ul>    
        </div>  
        <div class="navbar-container">
            <?php  
                $users = array();
                $sql = "SELECT user_email, user_id FROM USERS WHERE user_id != $userId AND user_email LIKE '%$txt%'";
                $result = $conn-> query($sql);
                if ($result -> num_rows > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $temp = array();
                        array_push($temp, $row["user_id"]);
                        array_push($temp, $row["user_email"]);
                        $users[] = $temp;
                    }
                }

            ?>
            <form class="d-flex searchform" style="margin: auto 0 !important" role="search">
                <select name="id" class="form-select user-search-select" aria-label="Default select example">
                    <option value="<?php echo $userId; ?>" selected>Search User</option>
                    <?php
                        foreach ($users as $user) {
                            echo "<option value='$user[0]'>" . explode("@", $user[1])[0] . "</option>";
                        }
                    ?>
                </select>  
                <button class="btn search btn-search">
                    <img src="../assets/images/loupe.png" alt="Rechercher" style="width : 21px; height: 30px; margin-top : 3px" />
                </button>
            </form>
        </div>  
        <?php
            }
        ?>
    </div>
    <div class="container">
        <div class="row">
            <div style="margin-top: 20px; ">
                <div class="card centered-card" style=" width: 400px; ">
                    <div class="card-body">
                        <?php 
                            echo "<img src='../assets/icons/$userIcon.png' class='card-img-top' alt='profile_' style='height: 100px; width: 100px; margin-bottom:10px'>";
                        ?>
                        <h3>
                            <span class="badge bg-secondary">
                                <?php 
                                    echo explode("@", $userMail)[0];
                                ?>
                            </span>
                        </h3>
                        <h5 class="card-subtitle mb-2 text-muted">
                            <?php 
                                echo $userMail;
                            ?>
                        </h5>
                        <div class="achievments">
                            <?php
                                foreach (getUserBadges($conn, $guestId) as $badge) {
                                    echo "<img title='".$badge[1]."' src='../assets/badge/".$badge[0].".png' style='margin: 0 5px 0 5px;'>";
                                }
                            ?>
                        </div>
                        <p class="card-text">
                            <?php 
                                echo $userInfo['user_bio'];
                            ?>
                        </p>
                        <?php  
                            if ($isGuest) { 
                        ?>
                        <div class="profile-interactions">
                            <?php
                                if (in_array(strval($guestId), $friends)) {
                            ?>
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
                        <a href="../controllers/delete_acc.php" class="delete_acc"> 
                        <button type="button" class="btn btn-outline-secondary">Delete Account</button></a>
                        <?php 
                            }
                        ?>
                    </div>
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
            if (empty($friends)) { 
        ?>
        <h3>You don't have any friends.</h3>
        <?php 
            } else{
                foreach ($friends as $friend) {
                    $friendId = intval($friend);
                    $sql = "SELECT user_email, user_icon FROM USERS WHERE user_id = $friendId";
                    $result = mysqli_query($conn,$sql);
                    if ($result -> num_rows > 0) {
                        if($row = mysqli_fetch_assoc($result)) {
                            $friendMail = $row['user_email'];
                            $friendIcon = $row['user_icon'];
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
                                                        <div class="achievments">
                                                            <?php
                                                                foreach (getUserBadges($conn, $friendId) as $badge) {
                                                                    echo "<img title='".$badge[1]."' src='../assets/badge/".$badge[0].".png' style='margin: 0 5px 0 5px;'>";
                                                                }
                                                            ?>
                                                        </div>
                                                        <p class="card-text">
                                                            <?php 
                                                            // $bio = file_get_contents($domain_name."/controllers/getbio.php?id=".$friendId);
                                                            // echo $bio;
                                                        ?>
                                                        </p>
                                                        <a href="profile.php?id=<?php echo $friendId; ?>" class="card-link" style="font-size: 20px; color: gray;">View Profile</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                    }
                }
            } 
        }
        ?>
    </div>
    <script>
        const list = document.querySelectorAll('.list');
        function activeLink() {
            list.forEach((item) => item.classList.remove('active'));
            this.classList.add('active');
        }
        list.forEach((item) => item.addEventListener('click', activeLink));
    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <?php 
        mysqli_close($conn);
    ?>
</body>
</html>