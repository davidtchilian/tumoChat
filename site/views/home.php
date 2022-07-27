<?php
  session_start();
  if (!isset($_SESSION['user_id'])) {
    header('Location: ./login.php?id=4');
    exit();
}
  $user_id = $_SESSION['user_id'];
  $theme = $_SESSION['user_theme'];
  require_once("../models/db.php");
  require_once("../models/functions.php");
  $sql = "SELECT DISTINCT group_id as gID, group_type, group_name FROM GROUPCHAT JOIN isInGroup ON isInGroup_group_id = group_id WHERE group_type = 2 AND isInGroup_user_id = " . $user_id;
  $result = mysqli_query($conn, $sql);

  $sqlGroup = "SELECT DISTINCT isInGroup_group_id, COUNT(*) FROM isInGroup GROUP BY isInGroup_group_id";
  $resultG = mysqli_query($conn, $sqlGroup);

  $groupsArray = array();
  while($groupsRow = mysqli_fetch_assoc($result)) {
    $groupsArray[] = $groupsRow;
  }

  $sql2 ="SELECT COUNT(notification_id) as nb FROM NOTIFICATIONS WHERE notification_receiver_id = $user_id";
  $result2 = mysqli_query($conn, $sql2);
  if($row2 = mysqli_fetch_assoc($result2)){
    $notif_count = $row2['nb'];
  }

   //$flames=file_get_contents("../controllers/getdate.php");
  // $flames=getStreaks($conn,$user_id);
  $flames = array();
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
    <title>TUYU | Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../style/page-accueil.css" />
    <script src="../scripts/jquery.js"></script>

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
          <a class="navbar-brand" href="profile.php" style="color: white; display: flex; justify-content: center; align-items: center;">
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
            <?php
            $notifs = getNotifications($conn,$user_id);
             if($notif_count != 0)
            {?>
            <div class="notifs_nb"> <?php if($notif_count > 100) {  echo "<p class='notif_limit'>" ?>  <?php echo "99+ </p>";} else{echo "<p class='notif_basic'>".$notif_count."</p>";}?></div>
            <?php } ?>
            <div id="infoModal" class="modal_user">
                    <div id="modal-content" class="modal-content">
                      <h3>Notifications</h3>
                    <?php foreach ($notifs as $notif) { ?>
                      <div class="notif_content_div">
                        <p><?=$notif['notification_content']?></p>
                        <div class="notif_buttons">
                          <?php if($notif['typeName'] == "GroupInvite") {?>

                            <a href="../controllers/notificationdecision.php?dec=1&notifId=<?=$notif['notification_id']?>&gID=<?=$notif['notification_group_id']?>" class="notif_decesion_btn">✅</a>
                            <a href="../controllers/notificationdecision.php?notifId=<?=$notif['notification_id']?>&gID=<?=$notif['notification_group_id']?>" class="notif_decesion_btn">❌</a>

                          <?php }elseif($notif['typeName'] == "FriendRequest"){ ?>

                          <a href="../controllers/notificationdecision.php?dec=1&notifId=<?=$notif['notification_id']?>&sender=<?=$notif['notification_sender_id']?>" class="notif_decesion_btn">✅</a>
                          <a href="../controllers/notificationdecision.php?notifId=<?=$notif['notification_id']?>&sender=<?=$notif['notification_sender_id']?>" class="notif_decesion_btn">❌</a>

                          <?php } ?>
                        </div>  
                      </div>
                     <?php } ?>
                      <button id = "closeButton" class="close btn modal_interaction" onclick = window.location.reload(true)>Close</button>
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
    <div class="container">
        <div class="div-titre" style="width: 100%; display: flex; justify-content: center; align-items: center; margin: 5rem 0 1rem 0">
        <img src="../assets/images/groupchats.png" alt="" style="width: calc(300px);  margin: 1rem">
        </div>
        <div class="row">
            <?php
            $allGroupIDs = array();
            foreach ($groupsArray as $group){
              $allGroupIDs[] = $group["gID"];
            }
            $groupCount = array();

            while ($usrow = mysqli_fetch_assoc($resultG))
                {
                  for ($i=0; $i < count($allGroupIDs); $i++) { 
                    if($usrow['isInGroup_group_id']==$allGroupIDs[$i]){
                      $groupCount[$i] = $usrow['COUNT(*)'];
                    }
                  }
                  
                }
                $index = 0;
              foreach ($groupsArray as $group){
                if ($groupCount[$index]<3) {
                  $textcolor = "dm";
                  $cardcolor = "text-white bg-dark";
                  $imgsrc= "../assets/images/usercount_white1.png";
                }
                else {
                  $textcolor = "dm1";
                  $cardcolor = "text-black";
                  
                  $imgsrc= "../assets/images/usercount.png";
                }
                ?>
            <div class="col-lg-4 col-sm-12 group-chats">
                <a href="page-chat.php?id=<?php echo $group["gID"]; ?>" style="text-decoration :none">
                    <div class="pad card mb-3 <?= $cardcolor ?>">
                        <ul style="margin-bottom: 0">  <!--list-group-->
                            <li class=  "border20 list-group-item group-name">
                              <div>
                                
                              <!-- <span class ="streaks" id="stars_<?php // echo $group["gID"]; ?>">
                               // getStreakIcon($flames[$group["gID"]]) 
                            </span> -->

                              <div class = " <?= $textcolor ?> groupHeader">
                                <span class="groupChatName"><?php
                                if(strlen($group["group_name"])>20){
                                  echo '<p style = "margin-bottom:0">' . substr($group["group_name"], 0, 20) . "..." . "</p>";
                                }else{
                                  echo '<p style = "margin-bottom:0">' . $group["group_name"] . "</p>";
                                }; 
                                ?></span>
                                <div class = "userCount">
                                  <span><?php echo $groupCount[$index]; ?></span>
                                  
                                  <img src= "<?= $imgsrc ?>" style="width: 28px; float:right;">
                              </div>
                              </div>
                              
                            </li>
                            <li class="<?= $textcolor ?> list-group-item" style = "min-height: 65px !important; display: flex; flex-direction: column; justify-content: center; align-items: center">
                                <?php
                            $messages = getLastMessages($conn, $group['gID']);
                            switch (count($messages)) {
                              case 0:
                                echo "<span class = '$textcolor'>No Messages yet!</span>";
                                break;
                              case 1: 
                                if(strlen($messages[0])>40){
                                  echo '<p style = "margin-bottom:0">' . substr($messages[0], 0, 40) . "..." . "</p>";
                                }else{
                                  echo '<p style = "margin-bottom:0">' . $messages[0]. "</p>";
                                }
                                break;
                              case 2:
                                if(strlen($messages[0])>40){
                                  echo '<p style = "margin-bottom:0">' . substr($messages[0], 0, 40) . "..." . "</p>";
                                }else{
                                  echo '<p style = "margin-bottom:0">' . $messages[0] . "</p>";
                                }
                                if(strlen($messages[1])>40){
                                  echo '<p style = "margin-bottom:0">' . substr($messages[1], 0, 40) . "..." . "</p>";
                                }else{
                                  echo '<p style = "margin-bottom:0">' . $messages[1] . "</p>";
                                }
                                break;
                              default:
                                break;
                            }
                          ?>
                            </li>
                        </ul>
                    </div>
                </a>
            </div>
            <?php
            $index++;
              }
              ?>
        </div>
    </div>
    <script src="../scripts/search.js"></script>
    <script src="../scripts/notifications.js"></script>  
  </body>
</html>