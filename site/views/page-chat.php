<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Document</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="page-chat.css" />
  </head>
  <body style='background-image: url("super_fond_violet.jpg");'>
    <div class="fixed-top">
      <nav class="navbar navbar-expand-lg" style="background-color : #6c4b93">
        <a href="page-accueil.html"
          ><img
            src="flèche_retour3.png"
            alt="Retour"
            style="width : 35px; height: 35px; margin-left: 10px"
        /></a>
        <div class="container">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="#" style="color : white"
                >Nom du groupe</a
              >
            </li>
          </ul>
          <div class="d-flex">
            <button
              type="button"
              class="btn info"
              data-bs-toggle="modal"
              data-bs-target="#exampleModal"
            >
              <img
                src="le_vrai_i.png"
                alt="Information"
                style="width: 35px; height: 35px;"
              />
            </button>
          </div>
          <div
            class="modal fade"
            id="exampleModal"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
          >
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">
                    Modal title
                  </h5>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  ...
                </div>
                <div class="modal-footer">
                  <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                  >
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
    <div
      class="container mt-5"
      style="min-height : 100vh"
      style="position : relative"
    >
      <br />
      <div class="row">
        <div class="col-8">
          <button
            type="button"
            class="btn btn-primary messageRecu mt-2"
            style="float : left; color: black;"
          >
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi
          </button>
        </div>
        <div class="col-4"></div>
      </div>
      <div class="row">
        <div class="col-4"></div>
        <div class="col-8">
          <button
            class="btn btn-primary messageEnvoye mt-2"
            style="float : right; color: black;"
          >
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ex,
            dolorum et error, quisquam natus vero culpa aperiam in repudiandae
            sapiente, inventore commodi earum veritatis id laboriosam saepe
            libero doloremque consequatur. Earum, quaerat. Delectus tenetur
            tempora distinctio necessitatibus sint ducimus minus.
          </button>
        </div>
      </div>

      <br />
    </div>

    <div class="fixed-bottom">
      <nav class="navbar navbar-expand-lg" style="background-color:#6c4b93">
        <div class="container">
          <div class="container-fluid">
            <form class="d-flex" role="search" action="../controllers/sendmessage.php" method = "POST">
              <input type="hidden" name="groupchatid" value="<?php echo $groupchatid; ?>">
              <input
                class="form-control me-2"
                type="text"
                placeholder="Enter your message here"
              />
              <button class="btn search" type="submit" value="Message">
                <img
                  src="avion_papier_nour_1.png"
                  alt="envoye"
                  style="width :40px"
                  style="height : 40px"
                />
              </button>
            </form>
          </div>
        </div>
      </nav>
    </div>
  </body>
</html>
