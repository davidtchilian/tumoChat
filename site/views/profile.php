<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ./login.php?id=4');
    exit();
}
$usrid = $_SESSION['user_id'];
if (!isset($_GET['id'])) {
    $guestid = $usrid;
}else {
    $guestid = $_GET['id'];
}
require_once('../models/db.php');

include("../controllers/updatestatisticsinfo.php");

if ($notme = $guestid != $usrid) {
    $id = $guestid;
}else {
    $id = $usrid;
}

$sql = "SELECT user_email, user_icon FROM USERS WHERE user_id = $id";


$result = mysqli_query($conn,$sql);
if ($result->num_rows > 0) {
    if($row1 = mysqli_fetch_assoc($result)) {
        $usrmail = $row1['user_email'];
        $usricon = $row1['user_icon'];
        
    }
}else{
    header('Location: ./login.php?id=4');
    exit();
}

echo $ids ;

$friends = file_get_contents($domain_name."/controllers/getfriends.php?user_id=$usrid");
$friends = json_decode($friends);

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
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style/style.css">
    <script src="../scripts/changetheme.js"></script>
    <style>

        <?php $theme = $_SESSION['user_theme']; ?>
       
        body{
           background-image: url("../assets/images/themes/<?php echo $theme; ?>.jpg");
        }
        
        </style>
</head>

<body>
<nav class="navbar navbar-expand-lg light-nav" >
        <div class="container mt-5">
            <div class="container-fluid mt-5">
                <a href="page-accueil.php"
          ><img
            src="../assets/images/flèche_retour3.png"
            alt="Retour"
            style="width : 35px; height: 35px; margin-left: 10px"
        /></a>
                <button class="navbar-toggler" type="button" 
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                </button>
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

                                <li class="<?php echo $str; ?>">
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
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div style ="margin-top: 20px; ">
                <div class="card centered-card" style = "  width: 400px; height: 300px;  ">
                    <div class="card-body">
                        <?php  echo "<img src='../assets/icons/$usricon.png' class='card-img-top' alt='profile_' style='height: 100px; width: 100px; margin-bottom:10px'>" ?>
                        <h3><span class="badge bg-secondary"><?php echo explode("@",$usrmail);?></span></h5>
                        <h5 class="card-subtitle mb-2 text-muted"><?php echo $usrmail;?></h4>
                        <p class="card-text" > 
                            <?php 
                                $bio = file_get_contents($domain_name."/controllers/getbio.php?id=".$usrid);
                                echo $bio;
                            ?> 
                        </p>
                        <a  href="editProfile.php" class="card-link" style="font-size: 20px; color: gray;">Edit Profile</a>
                    </div>
                </div>

                <div id = "badges_div">
                    <?php
                        require_once('../models/db.php');
                        $badges_info = GetBadgesInfo($conn);
                        $user_statistics = get_user_statistics($usrid);
                        for ($i = 0 ; $i < count($badges_info) ; $i++){
                            $badge_id = $badges_info[$i]["badge_id"];
                            $badge_name = $badges_info[$i]["badge_name"];
                            $badge_count = $badges_info[$i]["badge_requirement_count"];

                            echo $badge_id . " : " . $badge_name . " : " . $badge_count;
                        }
                        var_dump($user_statistics);
                        for ($i = 0 ; $i < count($user_statistics) ; $i++){
                            $statistic_type_id = $badges_info[$i]["badge_name"];
                            $badge_count = $badges_info[$i]["badge_requirement_count"];

                            echo $badge_id . " : " . $badge_name . " : " . $badge_count;
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    // function follow(){
    //     $id
    // }
    ?>

    <?php  
    if ($notme) {
        ?>
        <button onclick="follow()">Follow</button>
        <?php
        
    }else {
        
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
                if($row1 = mysqli_fetch_assoc($result)) {
                    $friendMail = $row1['user_email'];
                    $friendIcon = $row1['user_icon'];
                }
            }
            else {
                continue;
            }
        ?>
            <div class="row">
                <div style ="margin-top: 20px; ">
                    <div class="card centered-card" style = "  width: 400px; height: 300px;  ">
                        <div class="card-body">
                            <?php echo "<img src='../assets/icons/$friendIcon.png' class='card-img-top' alt='profile_' style='height: 100px; width: 100px; margin-bottom:10px'>" ?>
                            <h3><span class="badge bg-secondary"><?php echo explode("@",$friendMail);?></span></h5>
                            <h5 class="card-subtitle mb-2 text-muted"><?php echo $friendMail;?></h4>
                            <p class="card-text" > 
                                <?php 
                                    $bio = file_get_contents($domain_name."/controllers/getbio.php?id=".$usrid);
                                    echo $bio;
                                ?> 
                            </p>
                            <a href="user-profile.php?id=<?php echo $friendId; ?>" class="card-link" style="font-size: 20px; color: gray;">View Profile</a>
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