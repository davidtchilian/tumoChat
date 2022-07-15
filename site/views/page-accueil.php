<?php
  session_start();
  $user_id = $_SESSION['user_id'];
  $theme = $_SESSION['user_theme'];
  require_once("../models/db.php");
  $sql = "SELECT DISTINCT group_id, group_type, group_name FROM GROUPCHAT JOIN isInGroup ON isInGroup_group_id = group_id WHERE isInGroup_user_id = ".$user_id;
  $result = mysqli_query($conn, $sql);

  $sql2 = "SELECT user_icon FROM USERS WHERE user_id = $user_id";
  $result2 = mysqli_query($conn, $sql2);
  if ($result2->num_rows > 0) {
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <link rel="stylesheet" href="../style/page-accueil.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../scripts/jquery.js"></script>
    <script type="text/javascript">

    // Jquery Method
    $(function (){
        $.ajax({
            url: '../controllers/getnotifications.php',       
            data: "",
            dataType: 'json', //data format      
            success: function (data) {
                let modal = document.getElementById("modal-content");
                data.forEach(element => {
                  // console.log(element);
                let notif_id = document.createElement("div");
                let notif_group_id = document.createElement("div");
                let notif_content = document.createElement("div");
                let notif_sender_id = document.createElement("div");
                let notif_accept_btn = document.createElement("a");
                let notif_decline_btn = document.createElement("a");
                let btns_form = document.createElement("FORM");
                notif_accept_btn.href = "../controllers/notificationdecision.php?dec=1&gID=" + element.notification_group_id ;
                notif_accept_btn.innerHTML = "Accept";
                notif_decline_btn.href = "../controllers/notificationdecision.php?gID=" + element.notification_group_id;
                notif_decline_btn.innerHTML = "decline";
                notif_id.innerHTML = element.notification_id;
                modal.appendChild(notif_id);
                modal.appendChild(notif_accept_btn);
                modal.appendChild(notif_decline_btn);
              }
              )
              let notif_close_btn = document.createElement("button");
              let modalInfo = document.getElementById("infoModal");
                notif_close_btn.id = "closeButton";
                notif_close_btn.className = "close btn modal_interaction";
                notif_close_btn.onclick = function(){
                  modalInfo.style.display = "none";
                }
                notif_close_btn.innerHTML = "Close";
                modal.appendChild(notif_close_btn); 
            }
        });
    });
</script>
    <style>
    body {
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
                  >Create group</a>
                
              </li>
                
            <a onClick="notification()" id="infoButton" class="notifications_btn nav-link" style="color : white" href ="#">Notifications</a>
            <li class="nav-item">
              <a class="nav-link active" href="community.php" style="color :white">Community</a>
            </li>
            <div id="infoModal" class="modal_user">
                    <div id="modal-content" class="modal-content">
                      <!-- <div class="notifInfo_div">
                        <p id="notifInfo"></p>
                      </div>
                        <div class="notif_group_div">
                            <p id="notification_group"></p>
                        </div>
                        <div class="Notif_sender_div">
                            <p id="notif_sender_info"></p>
                        </div>
                        <div class="notif_content_div">
                            <p id="notification_content"></p>
                        </div>
                            <div id = "modal_buttons" class="userinfo_buttons">
                                <div id="modal-extra-interactions"></div>
                                <div id="modal-default-interactions">
                                    
                                </div>
                            </div>
                        </div> -->
                        <!-- <button id="closeButton" class="close btn modal_interaction">Close</button> -->
                    </div>
                </div>
                </ul>

                <form class="d-flex searchform" role="search">

                    <input class="form-control me-2 srch-input" type="search" placeholder="Search group"
                        aria-label="Search" />
                    <button class="btn search">
                        <img src="../assets/images/loupe.png" alt="Rechercher"
                            style="width : 20px; height: 30px; margin-top : 3px" />
                    </button>
                </form>
                <a href="../controllers/logout.php" class="signout-btn">Sign out</a>
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