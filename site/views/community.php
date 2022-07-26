<?php
  session_start();
  if (!isset($_SESSION['user_id'])) {
    header('Location: ./login.php?id=4');
    exit();
}
  $user_id = $_SESSION['user_id'];
  require_once("../models/db.php");
  $sql = "SELECT DISTINCT group_id, group_type, group_name, group_icon, group_bio FROM GROUPCHAT WHERE group_type = 1";
  $result = mysqli_query($conn, $sql);
  $sql3 = "SELECT user_icon FROM USERS WHERE user_id = $user_id";
  $result3 = mysqli_query($conn, $sql3);
  if ($result3->num_rows > 0) {
    if($row1 = mysqli_fetch_assoc($result3)) {
        $usricon = $row1['user_icon'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>TUYU | Communities</title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../style/page-accueil.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <style>

        <?php $theme = $_SESSION['user_theme']; ?>
       
        body{
           background-image: url("../assets/images/themes/<?php echo $theme; ?>.jpg");
        }
        
        
        </style>
  </head>
  <body>
    <div class="fixed-top">
      <nav class="navbar navbar-expand-lg" style="background-color: #6c4b93">
        <div class="container">
        <a class="navbar-brand" href="profile.php" style="color :white; flex;display: flex;justify-content: center;align-items: center;"">
            <?php  echo "<img src='../assets/icons/$usricon.png' class='card-img-top' alt='profile_' style='height: 45px; width: 45px; margin-right:10px;'>" ?>
            <span>Profile</span> 
          </a>
          
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarText"
            aria-controls="navbarText"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                
                <li class="nav-item">
                  <a class="nav-link active" href="home.php" style="color :white">Home</a>
                </li>
            <a onClick="notification()" id="infoButton" class="notifications_btn nav-link" style="color : white" href="#">Notifications</a>
            <div id="infoModal" class="modal_user">
                    <div class="modal-content" id="modCont">
                      
                        <div class="groupinfo_div">
                            <p id="groupInfo"></p>
                        </div>
                        <div class="usersinfo_div">
                            <div id="usersInfo">
                              
                            </div>
                            <div id = "modal_buttons" class="userinfo_buttons">
                                <div id="modal-extra-interactions"></div>
                                <div id="modal-default-interactions">
                                    <button id="closeButton" class="close btn modal_interaction">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </ul> 
            <a href ="../controllers/logout.php" class="signout-btn">Sign out</a>
          </div>
        </div>
      </nav>
    </div>
    <br />
    <div class="container" style="margin-top: 4rem;">
      <div class="div-titre" >
        <h1 class="Titre">Communities</h1>
      </div>
      <div class="row">
            <?php
              while($group = mysqli_fetch_assoc($result)){
                ?>
                <div class="col-lg-4 col-sm-12 group-chats mb-5">
                  <div style='width:100%; display: flex; justify-content: center;'>
                  <a href="page-chat.php?id=<?php echo $group["group_id"]; ?>" style="text-decoration :none">
                    <img class="CommImg" style="width:75px" src="../assets/comm_icons/<?php echo $group["group_icon"];?>.png" alt=""></a>
                  </div>
                  <a href="page-chat.php?id=<?php echo $group["group_id"]; ?>" style="text-decoration :none">
                    <div class="card">
                      <ul class="list-group list-group-flush" style="list-style-type: none;">
                        <li class="list-group-item group-name" style="font-size: 0.8vw; display: flex; flex-direction: column; justify-content: center; align-items: center"><h3 class="list-group-item-margin list-title" style="margin-bottom: 0"><?php echo $group["group_name"]; ?></h3></li>
                        <li class="list-group-item list-bottom list-group-item-margin" style="font-size: calc(7px + 0.3vw)">
                          <?php
                            echo  substr($group["group_bio"], 0, 200) . "...";
                          ?>
                        </li>
                      </ul>
                    </div>
                  </a>
                </div>
              <?php
              }
              ?>
      </div>
    </div>
    <script src="../scripts/notifications.js"></script>
  </body>
</html>