<?php
  session_start();
  $user_id = $_SESSION['user_id'];
  $theme = $_SESSION['user_theme'];
  require_once("../models/db.php");
  $sql = "SELECT DISTINCT group_id, group_type, group_name FROM GROUPCHAT JOIN isInGroup ON isInGroup_group_id = group_id WHERE isInGroup_user_id = ".$user_id;
  $result = mysqli_query($conn, $sql);

  $notifications = file_get_contents($domain_name."/controllers/getnotifications.php");
  echo $user_id;
  var_dump($notifications);
  $notifications = json_decode($notifs);
  var_dump($notifications);
  

  $sql2 = "SELECT user_icon FROM USERS WHERE user_id = $user_id";
  $result2 = mysqli_query($conn, $sql2);
  if ($result->num_rows > 0) {
    if($row1 = mysqli_fetch_assoc($result2)) {
        $usricon = $row1['user_icon'];
    }
} else {
    // echo "0 results";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>TUYU | Home</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../style/page-accueil.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body{
           background-image: url("../assets/images/themes/<?php echo $theme; ?>.jpg");
        }
        
        
        </style>
  </head>
  <body>
    <div class="fixed-top">
      <nav class="navbar navbar-expand-lg" style="background-color: #6c4b93">
        <div class="container">
          <a class="navbar-brand" href="profile.php" style="color :white">
            <?php  echo "<img src='../assets/icons/$usricon.png' class='card-img-top' alt='profile_' style='height: 45px; width: 45px; margin-bottom:10px;'>" ?>
            Profile
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
                <a
                  class="nav-link active"
                  aria-current="page"
                  href="creategroup.php"
                  style="color : white"
                  >Create group</a
                >
                
              </li>
                
            <a onClick="notification()" id="infoButton" class="notifications_btn nav-link" style="color : white">Notifications</a>
            <li class="nav-item">
              <a class="nav-link active" href="community.php" style="color :white">Community</a>
            </li>
            <div id="infoModal" class="modal_user">
                    <div class="modal-content">
                        <div class="groupinfo_div">
                            <p id="Notification_group"><?php ?></p>
                        </div>
                        <div class="usersinfo_div">
                            <p id="notif_sender_info"><?php ?></p>
                        </div>
                        <div class="notif_content_div">
                            <p id="notification_content"><?php ?></p>
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
            
            <form class="d-flex searchform" role="search">
          
              <input
                class="form-control me-2 srch-input"
                type="search"
                placeholder="Search group"
                aria-label="Search"
              />
              <button class="btn search">
                <img
                  src="../assets/images/loupe.png"
                  alt="Rechercher"
                  style="width : 20px; height: 30px; margin-top : 3px"
                />
              </button>
            </form>
            <a href ="../controllers/logout.php" class="signout-btn">Sign out</a>
          </div>
        </div>
      </nav>
    </div>
    <br />
    <div class="container mt-5">
      <div class="div-titre mt-4">
        <h1 class="Titre">Home</h1>
      </div>
      <div class="row">
            <?php
              while($group = mysqli_fetch_assoc($result)){
                if($group["group_type"]==1){
                ?>
                <div class="col-lg-4 col-sm-12 group-chats">
                  <a href="page-chat.php?id=<?php echo $group["group_id"]; ?>" style="text-decoration :none">
                    <div class="card mt-5">
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item group-name"><?php echo $group["group_name"]; ?></li>
                        <li class="list-group-item">
                          <?php
                            $messages = file_get_contents("http://localhost:8888/site/controllers/getlastmessages.php?id=".$group['group_id']);
                            $message = json_decode($messages);

                            echo $message[0];
                            echo "<br>";
                            echo $message[1];
                          ?>
                        </li>
                      </ul>
                    </div>
                  </a>
                </div>
              <?php
              }}
              ?>
      </div>
    </div>
    <script src="../scripts/search.js"></script>
    <script src="../scripts/notifications.js"></script>
  </body>
</html>