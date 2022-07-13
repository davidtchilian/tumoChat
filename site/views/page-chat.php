<?php

  $groupId = $_GET['id'];

  session_start();
  $userId = $_SESSION["user_id"];
  $isingroup = false;
  $isingroup_message = false;

  if (!isset($userId)) {
    header("Location: login.php");
    return;
  }

  if (!isset($groupId)) {
    header("Location: page-accueil.php");
    return;
  }

  require('../models/db.php');
 
  $sql = "SELECT * FROM message WHERE message_group_id='$groupId'";
  $messages = mysqli_query($conn, $sql);
//   $message = mysqli_fetch_assoc($messages);

  $group_users = file_get_contents($domain_name."/controllers/getgroupusers.php?id=".$groupId);
  $group_users = json_decode($group_users);

  for ($i=0; $i < count($group_users); $i++) { 
      if($group_users[$i] == $userId){
        $isingroup = true;
      }
  }

  if($isingroup == false){
      header("Location: page-accueil.php");
  }

  $sql = "SELECT group_name FROM groupchat WHERE group_id='$groupId'";
  $groupName = mysqli_fetch_assoc(mysqli_query($conn, $sql))["group_name"];

  $sql = "SELECT group_admin_id FROM groupchat WHERE group_id=$groupId";
  $groupAdminId = mysqli_fetch_assoc(mysqli_query($conn, $sql))['group_admin_id'];
  $isAdmin = $userId == $groupAdminId;
  
  mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/page-chat.css" />
    <title><?php echo $groupName." - TUYU"; ?></title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,100&display=swap');
        .dropbtn {
        background-color: #4CAF50;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
        cursor: pointer;
        }

        .dropdown {
        position: relative;
        display: none;

        }

        .dropdown-content {
        display: block;
        position: relative;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        }

        .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        }

        .dropdown-content a:hover {background-color: #f1f1f1}


        .dropdown:hover .dropbtn {
        background-color: #3e8e41;
        }

        .user_icon{
            height: 35px;
        }
        .user_email{
            font-family: 'Roboto', sans-serif;
            padding: 0 10px;
        }
        .delated_user{
            font-family: 'Roboto', sans-serif;
            padding: 0 10px;
            color: #ff5b4f;
        }

        <?php $theme = $_SESSION['user_theme']; ?>
       
        body{
           background-image: url("../assets/images/themes/<?php echo $theme; ?>.jpg");
        }
        
    </style>
</head>
<body>
    <div class="fixed-top">
        <nav class="navbar navbar-expand-lg" style="background-color : #6c4b93">
            <a href="page-accueil.php"><img src="../assets/images/flèche_retour3.png" alt="Retour" style="width : 35px; height: 35px; margin-left: 10px" /></a>
            <div class="container">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color : white"><?php echo $groupName; ?></a>
                    </li>
                </ul>             
                <div class="d-flex">
                    <a onClick="getGroupIdInfo('<?php echo $userId; ?>', '<?php echo $groupId; ?>', '<?php echo $isAdmin; ?>', '<?php echo $groupAdminId; ?>')">
                        <button id="infoButton" type="button" class="btn info">
                            <img src="../assets/images/le_vrai_i.png" alt="Information" style="width: 35px; height: 35px;" />
                        </button>
                    </a>
                </div>
                <div id="infoModal" class="modal_user">
                    <div class="modal-content">
                        <div class="groupinfo_div">
                            <p id="groupInfo"></p>
                        </div>
                        <div class="usersinfo_div">
                            <div id="usersInfo"></div>
                            <div id = "modal_buttons" class="userinfo_buttons">
                                <div id="modal-extra-interactions"></div>
                                <div id="modal-default-interactions">
                                    <button id="closeButton" class="close btn modal_interaction">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div class="container mt-5" style="min-height : 100vh"  style="position : relative" >
    <br><br><br><br>
        <?php
    while ($message = mysqli_fetch_assoc($messages)) {
        $icon = file_get_contents($domain_name."/controllers/getusericon.php?id=".$message["message_sender_id"]);
        $user_email = file_get_contents($domain_name."/controllers/getuseremail.php?id=".$message["message_sender_id"]);
        $user_name = explode("@", $user_email)[0];
        if ($message['message_sender_id'] == $userId) {
        ?>
        <div class="row" id = "messages" >
            <div class="col-4"></div>
            <div class="col-7">
            <button class="btn btn-primary messageEnvoye mt-2" onclick="show(event)" style="float : right; color: black;" id="<?= $message['message_id']?>" >
                    <?php 
                    // echo "<p class='user_email'>".$user_name."</p>";
                    echo $message['message_content']; ?>
                </button>
                <div class="dropdown" style="width:30px; margin-left:900px; margin-top:-30px;" id = "<?= "dropdown".$message['message_id']?>">
                
                    <div class="dropdown-content" id = "dropdown-content">
                        <a href="#" onclick = "myFunction(event)" id = "editId" name = "<?= $message['message_id']?>">Edit</a>
                        <a href="#">Delete</a>
                        </div>

                    </div> 
            </div>
        </div>
        <?php }
        else { 
            for ($i=0; $i < count($group_users); $i++) { 
                if($group_users[$i] == $message["message_sender_id"]){
                    $isingroup_message = true;
                }
            }
            ?>
        <div class="row">
            <?php
                if($isingroup_message == true){?>
                    <div class="col-1"><img src="../assets/icons/<?php echo $icon; ?>.png" class="user_icon"></div>
                    <div class="col-7">
                        <button type="button" class="btn btn-primary messageRecu mt-2" style="float : left; color: black;">
                            <?php 
                            echo "<p class='user_email'>".$user_name."</p>";
                            echo $message['message_content'] ?>
                        </button>
                    </div>
                <?php
                }
                else{?>
                    <div class="col-1"><img src="../assets/icons/10.png" class="user_icon"></div>
                    <div class="col-7">
                        <button type="button" class="btn btn-primary messageRecu mt-2" style="float : left; color: black;">
                            <?php 
                            echo "<p class='delated_user'>Delated user</p>";
                            echo $message['message_content'] ?>
                        </button>
                    </div>
                <?php
                }
            ?>
            <div class="col-4"></div>
        </div>
        <?php 
        }
    }
    ?>
        <br>
    </div>

    <div class="fixed-bottom">
        <nav class="navbar navbar-expand-lg" style="background-color:#6c4b93">
            <div class="container">
                <div class="container-fluid">
                    <form class="d-flex" role="search" action="../controllers/sendmessage.php" method="post" id = "form">
                        <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
                        <input type="hidden" name="group_id" value="<?php echo $groupId; ?>">
                        <input name="message_content" class="form-control me-2" type="text" id="text" placeholder="Enter your message here" autofocus />
                        <button class="btn search" type="submit" value="Message">
                            <a href="page-chat.php?id=<?php echo $groupId;?>"></a>
                            <img src="../assets/images/avion_papier_nour_1.png" alt="envoye" style="width :40px" style="height : 40px" />
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    </div>
    <script src="../scripts/page-chat.js"></script>
    <script>
        const params = new URLSearchParams(window.location.search);
        if (params.getAll('modal')[0] == 1) {
            getGroupIdInfo('<?php echo $userId; ?>', '<?php echo $groupId; ?>', '<?php echo $isAdmin; ?>', '<?php echo $groupAdminId; ?>');
            modal.style.display = "block";
        }
    </script>
</body>
</html>
