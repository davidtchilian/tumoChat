<?php
  session_start();
  $user_id = $_SESSION['user_id'];
  $_SESSION['user_id'] = $user_id;
  require_once("../models/db.php");
  $sql = "SELECT group_id, group_name FROM GROUPCHAT JOIN isInGroup ON isInGroup_group_id = group_id WHERE isInGroup_user_id = ".$user_id;
  $result = mysqli_query($conn, $sql);
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
  </head>
  <body style='background-image: url("../assets/images/super_fond_violet.jpg");'>
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
                <a
                  class="nav-link active"
                  aria-current="page"
                  href="creategroup.php"
                  style="color : white"
                  >Create group</a
                >
              </li>
            </ul>
            <form class="d-flex" role="search">
              <input
                class="form-control me-2"
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
              while($group = mysqli_fetch_assoc($result)){?>
                <div class="col-lg-4 col-sm-12">
                  <a href="page-chat.php?id=<?php echo $group["group_id"]; ?>" style="text-decoration :none">
                    <div class="card mt-5">
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item"><?php echo $group["group_name"]; ?></li>
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
  </body>
</html>