<?php

  $groupId = $_GET['id'];

  session_start();
  $userId = $_SESSION["user_id"];

  if (!$userId) {
    header("Location: login.php");
    return;
  }

  if (!isset($groupId)) {
    header("Location: page-accueil.php");
    return;
  }

  require('../models/db.php');

  $sql = "SELECT * FROM groupchat WHERE group_id=$groupId";
  $result = mysqli_query($conn, $sql);

  if (empty(mysqli_fetch_assoc($result))) {
    mysqli_close($conn);
    header("Location: page-accueil.php");
    return;
  }
 
  $sql = "SELECT * FROM message WHERE message_group_id='$groupId'";
  $messages = mysqli_query($conn, $sql);

  $sql = "SELECT group_name FROM groupchat WHERE group_id='$groupId'";
  $groupName = mysqli_fetch_assoc(mysqli_query($conn, $sql))["group_name"];

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
    <title>Document</title>
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
                    <a onClick="getGroupIdInfo('<?php echo $groupId; ?>')">
                        <button id="infoButton" type="button" class="btn info">
                            <img src="../assets/images/le_vrai_i.png" alt="Information" style="width: 35px; height: 35px;" />
                        </button>
                    </a>
                </div>
                <div id="infoModal" class="modal">
                    <div class="modal-content">
                        <p id="groupInfo"></p>
                        <ol id="usersInfo"></ol>
                        <div class="modal-info-buttons">
                            <button id="closeButton" class="close btn">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div class="container mt-5" style="min-height : 100vh" style="position : relative">
        <br>
        <?php
    while ($message = mysqli_fetch_assoc($messages)) {
        if ($message['message_sender_id'] == $userId) {
        ?>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-8">
                <button class="btn btn-primary messageRecu mt-2" style="float : right; color: black;">
                    <?php echo $message['message_content']; ?>
                </button>
            </div>
        </div>
        <?php }
        else { ?>
        <div class="row">
            <div class="col-8">
                <button type="button" class="btn btn-primary messageRecu mt-2" style="float : left; color: black;">
                    <?php echo $message['message_content'] ?>
                </button>
            </div>
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
                    <form class="d-flex" role="search" action="../controllers/sendmessage.php" method="post">
                        <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
                        <input type="hidden" name="group_id" value="<?php echo $groupId; ?>">
                        <input name="message_content" class="form-control me-2" type="text" placeholder="Enter your message here" />
                        <button class="btn search" type="submit" value="Message">
                            <img src="../assets/images/avion_papier_nour_1.png" alt="envoye" style="width :40px" style="height : 40px" />
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    </div>
    <script src="../scripts/page-chat.js"></script>

</body>
</html>
