<?php
  session_start();
  if (!isset($_SESSION['user_id'])) {
    header('Location: ./login.php?id=4');
    exit();
}
  $user_id = $_SESSION['user_id'];
  $theme = $_SESSION['user_theme'];
  require_once("../models/db.php");
  $sql = "SELECT DISTINCT group_id as gID, group_type, group_name FROM GROUPCHAT JOIN isInGroup ON isInGroup_group_id = group_id WHERE group_type = 2 AND isInGroup_user_id = " . $user_id;
  $result = mysqli_query($conn, $sql);

  $sqlGroup = "SELECT DISTINCT isInGroup_group_id, COUNT(*) FROM isInGroup GROUP BY isInGroup_group_id";
  $resultG = mysqli_query($conn, $sqlGroup);
  $rowG = mysqli_fetch_assoc($resultG);
  
//   $gIDs = array();
//   $gUSERs = array();
//   while ( $usrow = mysqli_fetch_assoc($resultG) )
// {
//   $gIDs[] = $usrow['isInGroup_group_id'];
//   $gUSERs[] = $usrow['COUNT(*)'];
// } 

  $groupsArray = array();
  while($groupsRow = mysqli_fetch_assoc($result)) {
    $groupsArray[] = $groupsRow;
  }

  $sql2 ="SELECT COUNT(notification_id) as nb FROM NOTIFICATIONS WHERE notification_receiver_id = $user_id";
  $result2 = mysqli_query($conn, $sql2);
  if($row2 = mysqli_fetch_assoc($result2)){
    $notif_count = $row2['nb'];
  }

  $flames=file_get_contents("../controllers/getdate.php");


  $sql3 = "SELECT user_icon FROM USERS WHERE user_id = $user_id";
  $result3 = mysqli_query($conn, $sql3);
  if ($result3->num_rows > 0) {
    if($row1 = mysqli_fetch_assoc($result3)) {
        $usricon = $row1['user_icon'];
    }
} else {
    // echo "0 results";
}

// $insert="INSERT INTO `NOTIFICATIONS`(`notification_sender_id`, `notification_receiver_id`, `notification_group_id`, `notification_content`, `notification_type_id`) VALUES (2,1,16, 'just testing notifs count',1)";
// for($i=0;$i<150;$i++){
//   mysqli_query($conn,$insert);
// }
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
                console.log(element)
                let notif_content = document.createElement("div");
                let notif_content_text = document.createElement("p");
                let notif_buttons = document.createElement("div");
                let notif_accept_btn = document.createElement("a");
                let notif_decline_btn = document.createElement("a");
                if(element.typeName = "GroupInvite"){
                notif_accept_btn.href = "../controllers/notificationdecision.php?dec=1&notifId=" + element.notification_id + "&gID=" + element.notification_group_id ;
                notif_accept_btn.innerHTML = "✅";
                notif_accept_btn.classList.add("notif_decesion_btn");
                notif_decline_btn.href = "../controllers/notificationdecision.php?notifId="+ element.notification_id +"&gID=" + element.notification_group_id;
                notif_decline_btn.innerHTML = "❌";
                notif_decline_btn.classList.add("notif_decesion_btn");
                }
                else if(element.typeName = "FriendRequest"){
                notif_accept_btn.href = "../controllers/notificationdecision.php?dec=1&notifId=" + element.notification_id + "&Sender=" + element.notification_sender_id;
                notif_accept_btn.innerHTML = "✅";
                notif_accept_btn.classList.add("notif_decesion_btn");
                notif_decline_btn.href = "../controllers/notificationdecision.php?notifId="+ element.notification_id + "&Sender=" + element.notification_sender_id;
                notif_decline_btn.innerHTML = "❌";
                notif_decline_btn.classList.add("notif_decesion_btn");
                }
                notif_content_text.innerHTML = element.notification_content;
                notif_content.appendChild(notif_content_text);
                notif_content.classList.add("notif_content_div");
                notif_buttons.classList.add("notif_buttons");
                notif_buttons.appendChild(notif_accept_btn);
                notif_buttons.appendChild(notif_decline_btn);
                notif_content.appendChild(notif_buttons);
                modal.appendChild(notif_content);
                
              }
              )
              let notif_close_btn = document.createElement("button");
              let modalInfo = document.getElementById("infoModal");
                notif_close_btn.id = "closeButton";
                notif_close_btn.className = "close btn modal_interaction";
                notif_close_btn.onclick = function(){ 
                  window.location.reload(true);
                }
                notif_close_btn.innerHTML = "Close";
                modal.appendChild(notif_close_btn); 
            }
        });
    });
    $(function (){
      // $.ajax({
	    //     type: "GET", //we are using GET method to get data from server side
	    //     url: 'basic.php', // get the route value
	    //     success: function (response) {//once the request successfully process to the server side it will return result here
	    //         console.log(response)
	    //     }
	    // });
        $.ajax({
            type: "GET",
            url: '../controllers/getdate.php',       
            data: "",
            dataType: 'json', //data format      
            success: function (data) {
            console.log(data)
            for (let i = 0; i < data.length; i++) {
              var idname = "stars_" + data[i][0];
              if (data[i][1] >= 3 && data[i][1] < 7) {
                document.getElementById(idname).innerHTML = data[i][1]+"⭐";
              }
              else if (data[i][1] >= 7 && data[i][1] < 21) {
                document.getElementById(idname).innerHTML = data[i][1]+"🌟";

              }
              else if (data[i][1] >= 21 && data[i][1] < 42) {
                document.getElementById(idname).innerHTML = data[i][1]+"💫";
              }

              else if (data[i][1] >= 42 && data[i][1] < 126) {
                document.getElementById(idname).innerHTML = data[i][1]+"🌠";
              }
              else if (data[i][1] >= 126 && data[i][1] < 182) {
                document.getElementById(idname).innerHTML = data[i][1]+"🌌";
              }


            }
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
            <?php if($notif_count != 0)
            {?>
            <div class="notifs_nb"> <p <?php if($notif_count>100) {  echo "style='font-size:8px;'" ?> > <?php echo "99+";} else{echo $notif_count;}?></p></div>
            <?php } ?>
            <div id="infoModal" class="modal_user">
                    <div id="modal-content" class="modal-content">
                      <h3>Notifications</h3>
                      <div id="notifs_block_div">

                      </div>
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
        <div class="div-titre" style="margin-top: 6rem;">
            <h1 class="Titre">Home</h1>
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
                ?>
            <div class="col-lg-4 col-sm-12 group-chats">
                <a href="page-chat.php?id=<?php echo $group["gID"]; ?>" style="text-decoration :none">
                    <div class="card mt-5">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item group-name">
                              <div>
                                <span class ="streaks" id="stars_<?php echo $group["gID"]; ?>"></span>

                              <div class = "groupHeader">
                                <span class="groupChatName"><?php
                                echo $group["group_name"]; 
                                ?></span>
                                <div class = "userCount">
                                  <span><?php echo $groupCount[$index]; ?></span>
                                  
                                  <img src="../assets/images/usercount.png" style="width: 28px; float:right;">
                              </div>
                              </div>
                              
                            </li>
                            <li class="list-group-item" style = "min-height: 65px !important; display: flex; flex-direction: column; justify-content: center; align-items: center">
                                <?php
                            $messages = file_get_contents("http://localhost:8888/site/controllers/getlastmessages.php?id=".$group['gID']);
                            $message = json_decode($messages);
                            if($message[0]=="" && $message[1]==""){ ?>
                              <span style = "color:#787878">No Messages yet!</span>
                            <?php }else{
                              if($message[0]==""){
                                if(strlen($message[1])>40){
                                  echo '<p style = "margin-bottom:0">' . substr($message[1], 0, 40) . "..." . "</p>";
                                }else{
                                  echo '<p style = "margin-bottom:0">' . $message[1]. "</p>";
                                }
                            }else{
                              if(strlen($message[0])>40){
                                echo '<p style = "margin-bottom:0">' . substr($message[0], 0, 40) . "..." . "</p>";
                              }else{
                                echo '<p style = "margin-bottom:0">' . $message[0] . "</p>";
                              }
                              if(strlen($message[1])>40){
                                echo '<p style = "margin-bottom:0">' . substr($message[1], 0, 40) . "..." . "</p>";
                              }else{
                                echo '<p style = "margin-bottom:0">' . $message[1] . "</p>";
                              }
                              
                            }
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