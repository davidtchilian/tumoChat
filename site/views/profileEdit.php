<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>TUYU | profil </title>
    <link rel="icon" type="image/png" href="logo_tuyu-sm.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg light-nav" style="background: #F8F9FA;">
        <div class="container mt-5">
            <div class="container-fluid mt-5z">
                <a href="page-accueil.php"
          ><img
            src="flèche_retour3.png"
            alt="Retour"
            style="width : 35px; height: 35px; margin-left: 10px"
        /></a>
                <button class="navbar-toggler" type="button" 
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                </button>
                <div class="navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <div class="navigation modes">
                            <ul>
                                <li class="list active">
                                    <a href="#">
                                        <span class="icon">
                                            <ion-icon name="sunny-outline"></ion-icon>
                                        </span>
                                        <span class="text"> Light </span>
                                    </a>
                                </li>
                                <li class="list">
                                    <a href="#">
                                        <span class="icon">
                                            <ion-icon name="moon-outline"></ion-icon>
                                        </span>
                                        <span class="text"> Dark </span>
                                    </a>
                                </li>
                                <li class="list">
                                    <a href="#">
                                        <span class="icon">
                                            <ion-icon name="radio-button-off-outline"></ion-icon>
                                        </span>
                                        <span class="text"> Beige </span>
                                    </a>
                                </li>
                                <li class="list">
                                    <a href="#">
                                        <span class="icon">
                                            <ion-icon name="radio-button-on-outline"></ion-icon>
                                        </span>
                                        <span class="text"> Violet </span>
                                    </a>
                                </li>
                                <div class="indicator"></div>
                            </ul>
                        </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-2">
                <div class="card profil">
                    <img src="dino.png" class="card-img-top" alt="profile_" style="height: 70px; width: 70px">
                </div>
            </div>
            <div class="col-4">
                <div class="card centered-card" style="width: 288px; height: 300px">
                    <div class="card-body" style="color: black">
                        <h5><span class="badge bg-secondary">sokol.bozanic</span></h5>
                        <h6 class="card-subtitle mb-2 text-muted">sokol.bozanic@tumo.world</h6>
                        <p class="card-text"> Biography : Some quick example text to build on the card title and make up
                            the bulk of
                            the card's content.</p>
                        <a href="editProfile.html" class="card-link">edit profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const list = document.querySelectorAll('.list');
        function activeLink() {
            list.forEach((item) => item.classList.remove('active'));
            this.classList.add('active');
        }
        list.forEach((item) => item.addEventListener('click', activeLink))
    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>