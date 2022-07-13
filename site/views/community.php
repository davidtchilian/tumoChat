<?php

  $communityId = $_GET['id'];

  session_start();
  $userId = $_SESSION["user_id"];
  $isincommunity = false;
  $isincommunity_message = false;

  if (!isset($userId)) {
    header("Location: login.php");
    return;
  }

  if (!isset($communityId)) {
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
    <title>TUYU | Communities</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../style/page-accueil.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style='background-image: url("../assets/images/themes/3.jpg");'>
<div class="fixed-top">
      <nav class="navbar navbar-expand-lg" style="background-color: #6c4b93">
        <div class="container">
          <a class="navbar-brand" href="profile.php" style="color :white"
            >Profile</a
          >
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
              <a class="nav-link active" href="page-accueil.php" style="color :white"
            >Home</a
          >
</li>
            </ul>
            <form class="d-flex" role="search">
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
    <br>
    <div class="container mt-5">
      <div class="div-titre mt-4">
        <h1 class="Titre">Communities</h1>
      </div>
      <div class="row">
            <?php
              while($group = mysqli_fetch_assoc($result)){
                ?>
                <div class="col-lg-4 col-sm-12">
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
              }
              ?>
      </div>
    </div>
    <script src="../scripts/search.js"></script>
</body>
</html>