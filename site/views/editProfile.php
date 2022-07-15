<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ./login.php?id=4');
    exit();
}
require_once '../models/db.php';
$dir    = '../assets/icons/';
$files = array_values(array_diff(scandir($dir), array('..', '.')));



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
    <style>

        <?php $theme = $_SESSION['user_theme']; ?>
       
        body{
           background-image: url("../assets/images/themes/<?php echo $theme; ?>.jpg");
        }
        
        </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12" style="text-align: center; margin-top: 50px;   ">
                <?php
                    for ($i = 0;$i < count($files);$i++) {
                        $result =  $dir . $files[$i]."\n";
                        $number = explode(".",$files[$i])[0];
                        echo "<a href='../controllers/updateicon.php?icon=$number'><img src='$result' class='card-img-top' alt='profile_' style='height: 70px; width: 70px'></a>";
                       }
                ?>
            </div>
            <div class="col-4" style="margin: 20px auto;">
                <div class="card centered-card" style = "  width: 400px; height: 300px;  ">
                    <a href="profile.php" class="btn-close"></a>
                    <form action="../controllers/updatebio.php" method="POST">
                    <textarea name="bio" class="form-control" style="height: 170px"></textarea>
                    <!-- <input type="submit" value="Save" style="w">   -->
                    <input type="submit" class="btn btn-outline-success" value='Save' style="margin-top:25px;"></input> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>