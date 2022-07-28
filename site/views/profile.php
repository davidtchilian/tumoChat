<?php

require_once('../models/db.php');
include('../models/functions.php');

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
} else {
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../scripts/jquery.js"></script>
    <script src="../scripts/changetheme.js"></script>
    <script type="text/javascript" src="../scripts/delete.js"></script>
    <link rel="stylesheet" href="../style/style.css">
    <style>
        body {
            background-image: url("../assets/images/themes/<?php echo $theme; ?>.jpg");
        }
    </style>
</head>
<body>


<!-- Modal
<div class ="container">
<div class ="row">
<div class ="col-md-12">
<div class="modal fade" id="myModal" > 
tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" -->
  <!-- <div class="modal-dialog modal-sm" > -->
  <!-- role="document" -->
    <!-- <div class="modal-content">
      <div class="modal-header">
        <h5 >Modal title</h5> -->
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      <!-- </div>
      <div class="modal-body">
        hhghbg
      </div>
      <div class="modal-footer">
      <input  class="btn btn-default" value="Close"> -->
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> -->
      <!-- </div>
    </div>
  </div>
</div>
</div>
</div>
   </div> -->
   
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="<?php echo $isGuest ? "profile.php" : "home.php" ?>"><img src="../assets/images/flèche_retour3.png" alt="Retour" style="width : 35px; height: 35px;" /></a>
        <?php
        if (!$isGuest) {
        ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex d-flex align-items-center">
                    <div class="navigation modes " style="width: 400px;">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex flex-row ">
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

                <?php
                $users = array();
                $sql = "SELECT user_email, user_id FROM USERS WHERE user_id != $userId AND user_email LIKE '%$txt%'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $temp = array();
                        array_push($temp, $row["user_id"]);
                        array_push($temp, $row["user_email"]);
                        $users[] = $temp;
                    }
                }

                ?>
                <form class="form-inline my-2 my-lg-0 d-flex " role="search" style="width: 400px; margin:auto;">
                    <input class="form-control me-2 srch-input" type="text" id="fname" name="fname" onkeyup="showHint(this.value)">
                    <div id="txtHint"></div>

                    <select id="sel">
                        <!-- <option id="result"></option> -->
                        
                    </select>

                    <button class="btn search btn-search ">
                        <img src="../assets/images/loupe.png" alt="Researcher" style="width : 21px; height: 30px; margin-top : 3px" />
                    </button>
                </form>
            </div>
            <?php
        }
        ?>
        </nav>
</div>
<div class="container">
    <div class="row">

        <div class="card centered-card " style=" width: 400px;">
            <div class="card-body img-shadow">
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
                        echo "<img title='" . $badge[1] . "' src='../assets/badge/" . $badge[0] . ".png' style='margin: 0 5px 0 5px;'>";
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
                            <a href="../controllers/removefriend.php?user_id=<?php echo $userId; ?>&delete_id=<?php echo $guestId; ?>" class="user-profile-status friends-deactive">Remove Friend</a>
                            <?php
                        } else {
                            $sql = "SELECT notification_id FROM notifications WHERE notification_sender_id=$userId AND notification_receiver_id=$guestId AND notification_type_id=2";
                            $result = mysqli_query($conn, $sql);
                            $isRequested = $result->num_rows > 0;
                            if ($isRequested) { ?>
                                <a href="../controllers/removefriendrequest.php?requested_user_id=<?php echo $guestId ?>" class="user-profile-status friends-cancel">Cancel Request</a>
                            <?php } else { ?>
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
                    <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#exampleModal">
  Delete Account
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
          <!-- <span aria-hidden="true">&times;</span> -->
        </button>
      </div>
      <div class="modal-body">
        Deleting your account will remove all of your information permanently. This cannot be undone.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a href="../controllers/delete_acc.php" class="btn btn-danger">Delete Account</a>
      </div>
    </div>
  </div>
</div>
                    
                    <?php }?>
            </div>
        </div>
    </div>

</div>

<?php
if (!$isGuest) {
?>
    
    <div class="container friends-container  d-flex align-content-center flex-wrap">
    <?php 
    if($theme == 1 || $theme == 3){ 
        echo "<h1 class='Titre text-center' style='color:white;'>Friends</h1>";
    }else {
        echo "<h1 class='Titre text-center' >Friends</h1>";
    }
?>
        <?php
        if (empty($friends)) {
        ?>

            <h3 style="text-align:center">You don't have any friends.</h3>

            <?php
        } else {
            foreach ($friends as $friend) {
                $friendId = intval($friend);
                $friend = getUserInfo($conn, $friendId);
                if ($friend == null) {
                    continue;
                }
                $friendMail = $friend['user_email'];
                $friendIcon = $friend['user_icon'];
            ?>
                <div class= "friend-row">
                    <div class="friend-acc">
                        <a href="profile.php?id=<?php echo $friendId; ?>">
                            <img src='../assets/icons/<?php echo $friendIcon; ?>.png' class='card-img-top' alt='profile_' style='height: 75px; width: 75px; margin-right: 10px;'>
                            <h3>
                                <span class="badge bg-secondary"><?php echo explode("@", $friendMail)[0]; ?></span>
                            </h3>
                        </a>
                    </div>
                    <div>
                        <a href="../controllers/direct.php?id=<?= $friendId ?>">
                            <button type="button" class="btn btn-outline-dark">Direct</button>
                        </a>
                    </div>
                </div>
    <?php
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
    <script>
        function showHint(str) {
            if (str.length == 0) {
                document.getElementById("sel").innerHTML = "";
                return;
            } //else {
            //     var xmlhttp = new XMLHttpRequest();
            //     xmlhttp.onreadystatechange = function() {
            //         if (this.readyState == 4 && this.status == 200) {
            //             document.getElementById("txtHint").innerHTML = this.responseText;
            //         }
            //     };
            //     xmlhttp.open("GET", "../controllers/livesearch.php?q=" + str, false);
            //     xmlhttp.send();
            // }

           
            $.ajax({
                type: 'get',
                url: "../controllers/livesearch.php?q=" + str,
                data: {},
                success: function(response) {
                    console.log("Success !!");

                    

                    const arr = JSON.parse(response);
                    const sel = document.getElementById("sel");
                    sel.innerHTML = "";
                    for (let element in arr) {
                        var b = document.createElement("a");
                        b.href = "profile.php?id=" + arr[element][0];
                        var o = document.createElement("option");
                        o.innerHTML = arr[element][1];
                        b.appendChild(o);
                        sel.appendChild(b);
                        
                    }

                    
                },
                error: function() {
                    x
                    console.log("Error !!");
                }
            });
        }
    </script>

    <?php
    mysqli_close($conn);
    ?>

</body>

</body>
</html>