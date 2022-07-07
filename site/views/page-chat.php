<?php
  require_once('../models/db.php');
  $sql = 'SELECT * FROM message';
  $messages = mysqli_query($conn, $sql);
  mysqli_close($conn);
  $group_id = 1;
  $userid = 1;

?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <link rel="stylesheet" href="../style/page-chat.css" />
  </head>

  <body style='background-image: url("../assets/images/super_fond_violet.jpg");'>
    <div class="fixed-top">
      <nav class="navbar navbar-expand-lg" style="background-color : #6c4b93">
        <a href="page-accueil.html"><img src="../assets/images/flèche_retour3.png" alt="Retour" style="width : 35px; height: 35px; margin-left: 10px" /></a>
        <div class="container">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="#" style="color : white">Group Name</a>
            </li>
          </ul>
          <div class="d-flex">
            <a href="../controllers/getgroupinfo.php?id=<?php echo $group_id; ?>">
              <button type="button" class="btn info" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <img src="../assets/images/le_vrai_i.png" alt="Information" style="width: 35px; height: 35px;" />
              </button></a>
          </div>
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">
                    Modal title
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  ...
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                  </button>
                  <button type="button" class="btn btn-primary">
                    Save changes
                  </button>
                </div>
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
          if ($message['message_sender_id'] == $userid) {
            ?>
      <div class="row">
        <div class="col-4"></div>
        <div class="col-8">
          <button class="btn btn-primary messageRecu mt-2" style="float : right; color: black;">
            <?php echo $message['message_content']; ?>
          </button>
        </div>
      </div>
      <?php
          }
          else {
            ?>
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
              <input type="hidden" name="group_id" value="<?php echo 1; ?>">
              <input type="hidden" name="user_id" value="<?php echo 1; ?>">
              <input name="message_content" class="form-control me-2" type="text" placeholder="Enter your message here" />
              <button class="btn search" type="submit" value="Message">
                <img src="../assets/images/avion_papier_nour_1.png" alt="envoye" style="width :40px" style="height : 40px" />
              </button>
            </form>
          </div>
        </div>
      </nav>
    </div>
  </body>

</html>
