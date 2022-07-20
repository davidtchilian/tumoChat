<?php

  session_start();

  if (!isset($_SESSION['user_id'])) {
      header('Location: ./login.php?id=4');
      exit();
  }

  $userId = $_SESSION['user_id'];
  $profileUserId = $_GET['id'];

  if (!isset($profileUserId)) {
    header('Location: ./profile.php');
    exit();
  }

  require_once('../models/db.php');

  $sql = "SELECT user_email, user_icon FROM USERS WHERE user_id = $userId";
  $result = mysqli_query($conn, $sql);
  
  if ($result -> num_rows > 0) {
    if ($row1 = mysqli_fetch_assoc($result)) {
        $profileUserEmail = $row1['user_email'];
        $profileUserIcon = $row1['user_icon'];
    }
  }
  else {
    header('Location: ./profile.php');
    exit();
  }

?>
<!doctype html>
<html lang="en">

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
                <a href="profile.php"><img src="../assets/images/flèche_retour3.png" alt="Retour"
                        style="width : 35px; height: 35px; margin-left: 10px" /></a>
                <button class="navbar-toggler" type="button" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                </button>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div style="margin-top: 20px; ">
                <div class="card centered-card" style="  width: 400px; height: 300px;  ">
                    <div class="card-body">
                        <?php  echo "<img src='../assets/icons/$profileUserIcon.png' class='card-img-top' alt='profile_' style='height: 100px; width: 100px; margin-bottom:10px'>" ?>
                        <h3><span class="badge bg-secondary"><?php echo explode("@",$profileUserEmail)[0];?></span></h5>
                            <h5 class="card-subtitle mb-2 text-muted"><?php echo $profileUserEmail;?></h4>
                                <p class="card-text">
                                    <?php 
                      $bio = file_get_contents($domain_name."/controllers/getbio.php?id=".$profileUserId);
                      echo $bio;
                    ?>
                                </p>
                                <div class="profile-interactions">
                                    <?php
                      $friends = file_get_contents($domain_name."/controllers/getfriends.php?user_id=$profileUserId");
                      $friends = json_decode($friends);
                      if (in_array(strval($userId), $friends)) { ?>
                                    <div class="user-profile-friend-status">
                                        <p>Friends</p>
                                        <img src="../assets/images/friend.png" alt="Friends">
                                    </div>
                                    <a href="../controllers/removefriend.php?user_id=<?php echo $userId; ?>&delete_id=<?php echo $profileUserId; ?>"
                                        class="user-profile-status friends-deactive">Remove Friend</a>
                                    <?php
                      }
                      else { ?>
                                    <a href="editProfile.php" class="user-profile-status friends-active">Add Friend</a>
                                    <?php
                      }
                    ?>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>