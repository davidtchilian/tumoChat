<?php 
session_start();

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
      <!-- <nav class="navbar navbar-expand-lg" style="background-color: #6c4b93">
        <div class="container">
          <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a
                    class="nav-link active"
                    aria-current="page"
                    href="#"
                    style="color :white"
                    >Home</a
                  >
                </li>
                <li>
                  <a class="nav-link" href="#" style="color : white; "
                    >Profile</a
                  >
                </li>
                <li>
                  <a
                    class="nav-link"
                    href="creategroup.html"
                    style="color:white; border: 1px white solid; border-radius: 5px"
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
                    src="loupe.png"
                    alt="Rechercher"
                    style="width : 20px; height: 30px; margin-top : 3px"
                  />
                </button>
              </form>
            </div>
          </div>
        </div>
      </nav> -->
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
        <div class="col-lg-4 col-sm-12">
          <a href="page-chat.php" style="text-decoration :none">
            <div class="card mt-5">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">GROUPE</li>
                <li class="list-group-item">
                  <p>message 1</p>
                  <p>message 2</p>
                </li>
              </ul>
            </div>
          </a>
        </div>
        <div class="col-lg-4 col-sm-12">
          <a href="page-chat.php" style="text-decoration :none">
            <div class="card mt-5">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">GROUPE</li>
                <li class="list-group-item">
                  <p>message 1</p>
                  <p>message 2</p>
                </li>
              </ul>
            </div>
          </a>
        </div>
        <div class="col-lg-4 col-sm-12">
          <a href="page-chat.php" style="text-decoration :none">
            <div class="card mt-5">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">GROUPE</li>
                <li class="list-group-item">
                  <p>message 1</p>
                  <p>message 2</p>
                </li>
              </ul>
            </div>
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-sm-12">
          <a href="page-chat.php" style="text-decoration :none">
            <div class="card mt-5">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">GROUPE</li>
                <li class="list-group-item">
                  <p>message 1</p>
                  <p>message 2</p>
                </li>
              </ul>
            </div>
          </a>
        </div>
        <div class="col-lg-4 col-sm-12">
          <a href="page-chat.php" style="text-decoration :none">
            <div class="card mt-5">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">GROUPE</li>
                <li class="list-group-item">
                  <p>message 1</p>
                  <p>message 2</p>
                </li>
              </ul>
            </div>
          </a>
        </div>
        <div class="col-lg-4 col-sm-12">
          <a href="page-chat.php" style="text-decoration :none">
            <div class="card mt-5">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">GROUPE</li>
                <li class="list-group-item">
                  <p>message 1</p>
                  <p>message 2</p>
                </li>
              </ul>
            </div>
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-sm-12">
          <a href="page-chat.php" style="text-decoration :none">
            <div class="card mt-5">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">GROUPE</li>
                <li class="list-group-item">
                  <p>message 1</p>
                  <p>message 2</p>
                </li>
              </ul>
            </div>
          </a>
        </div>
        <div class="col-lg-4 col-sm-12">
          <a href="page-chat.php" style="text-decoration :none">
            <div class="card mt-5">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">GROUPE</li>
                <li class="list-group-item">
                  <p>message 1</p>
                  <p>message 2</p>
                </li>
              </ul>
            </div>
          </a>
        </div>
        <div class="col-lg-4 col-sm-12">
          <a href="page-chat.php" style="text-decoration :none">
            <div class="card mt-5">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">GROUPE</li>
                <li class="list-group-item">
                  <p>message 1</p>
                  <p>message 2</p>
                </li>
              </ul>
            </div>
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-sm-12">
          <a href="page-chat.php" style="text-decoration :none">
            <div class="card mt-5">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">GROUPE</li>
                <li class="list-group-item">
                  <p>message 1</p>
                  <p>message 2</p>
                </li>
              </ul>
            </div>
          </a>
        </div>
        <div class="col-lg-4 col-sm-12">
          <a href="page-chat.php" style="text-decoration :none">
            <div class="card mt-5">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">GROUPE</li>
                <li class="list-group-item">
                  <p>message 1</p>
                  <p>message 2</p>
                </li>
              </ul>
            </div>
          </a>
        </div>
        <div class="col-lg-4 col-sm-12">
          <a href="page-chat.php" style="text-decoration :none">
            <div class="card mt-5">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">GROUPE</li>
                <li class="list-group-item">
                  <p>message 1</p>
                  <p>message 2</p>
                </li>
              </ul>
            </div>
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-sm-12">
          <a href="page-chat.php" style="text-decoration :none">
            <div class="card mt-5">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">GROUPE</li>
                <li class="list-group-item">
                  <p>message 1</p>
                  <p>message 2</p>
                </li>
              </ul>
            </div>
          </a>
        </div>
        <div class="col-lg-4 col-sm-12">
          <a href="page-chat.php" style="text-decoration :none">
            <div class="card mt-5">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">GROUPE</li>
                <li class="list-group-item">
                  <p>message 1</p>
                  <p>message 2</p>
                </li>
              </ul>
            </div>
          </a>
        </div>
        <div class="col-lg-4 col-sm-12">
          <a href="page-chat.php" style="text-decoration :none">
            <div class="card mt-5">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">GROUPE</li>
                <li class="list-group-item">
                  <p>message 1</p>
                  <p>message 2</p>
                </li>
              </ul>
            </div>
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-sm-12">
          <a href="page-chat.php" style="text-decoration :none">
            <div class="card mt-5">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">GROUPE</li>
                <li class="list-group-item">
                  <p>message 1</p>
                  <p>message 2</p>
                </li>
              </ul>
            </div>
          </a>
        </div>
        <div class="col-lg-4 col-sm-12">
          <a href="page-chat.php" style="text-decoration :none">
            <div class="card mt-5">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">GROUPE</li>
                <li class="list-group-item">
                  <p>message 1</p>
                  <p>message 2</p>
                </li>
              </ul>
            </div>
          </a>
        </div>
        <div class="col-lg-4 col-sm-12">
          <a href="page-chat.php" style="text-decoration :none">
            <div class="card mt-5">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">GROUPE</li>
                <li class="list-group-item">
                  <p>message 1</p>
                  <p>message 2</p>
                </li>
              </ul>
            </div>
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-sm-12">
          <a href="page-chat.php" style="text-decoration :none">
            <div class="card mt-5">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">GROUPE</li>
                <li class="list-group-item">
                  <p>message 1</p>
                  <p>message 2</p>
                </li>
              </ul>
            </div>
          </a>
        </div>
        <div class="col-lg-4 col-sm-12">
          <a href="page-chat.php" style="text-decoration :none">
            <div class="card mt-5">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">GROUPE</li>
                <li class="list-group-item">
                  <p>message 1</p>
                  <p>message 2</p>
                </li>
              </ul>
            </div>
          </a>
        </div>
        <div class="col-lg-4 col-sm-12">
          <a href="page-chat.php" style="text-decoration :none">
            <div class="card mt-5">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">GROUPE</li>
                <li class="list-group-item">
                  <p>message 1</p>
                  <p>message 2</p>
                </li>
              </ul>
            </div>
          </a>
        </div>
      </div>
    </div>

    <script src="../scripts/search.js"></script>
  </body>
</html>
