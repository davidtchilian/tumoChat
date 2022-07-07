<?php 

require_once '../models/db.php';

?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>TUYU | profil </title>
    <link rel="icon" type="image/png" href="../assets/images/logo_tuyu-sm.png" />
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
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-2">
                <div class="card profil">
                    <img src="../assets/images/dino.png" class="card-img-top" alt="profile_" style="height: 70px; width: 70px">
                </div>
            </div>
            <div class="col-4">
                <div class="card centered-card" style="width: 288px; height: 300px">
                    <a href="profile.php" class="btn-close"></a>
                    <form action="./profile.php " method="POST">
                    <textarea name="bio" class="form-control" style="height: 170px"> Some quick example text to build on the card title and make up the bulk of the card's content.</textarea>
                    <input type="submit" value="Save">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>