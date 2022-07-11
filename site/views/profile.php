<?php
session_start();
require_once '../models/db.php';
$usrid = $_SESSION['user_id'];

$sql = "SELECT user_email, user_icon FROM USERS WHERE user_id = $usrid";
   
$result = mysqli_query($conn,$sql);
if ($result->num_rows > 0) {
    if($row1 = mysqli_fetch_assoc($result)) {
        $usrmail = $row1['user_email'];
        $usricon = $row1['user_icon'];
    }
} else {
    // echo "0 results";
}
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
    <script src="changetheme.js"></script>
</head>

<body>
<nav class="navbar navbar-expand-lg light-nav" style="background: #F8F9FA;">
        <div class="container mt-5">
            <div class="container-fluid mt-5z">
                <a href="page-accueil.php"
          ><img
            src="../assets/images/flèche_retour3.png"
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
                                    <a onclick="changetheme(0)" href="#">
                                        <span class="icon">
                                            <ion-icon name="sunny-outline"></ion-icon>
                                        </span>
                                        <span class="text"> Light </span>
                                    </a>
                                </li>
                                <li class="list">
                                    <a onclick="changetheme(1)" href="#">
                                        <span class="icon">
                                            <ion-icon name="moon-outline"></ion-icon>
                                        </span>
                                        <span class="text"> Dark </span>
                                    </a>
                                </li>
                                <li class="list">
                                    <a onclick="changetheme(2)" href="#">
                                        <span class="icon">
                                            <ion-icon name="radio-button-off-outline"></ion-icon>
                                        </span>
                                        <span class="text"> Beige </span>
                                    </a>
                                </li>
                                <li class="list">
                                    <a onclick="changetheme(3)" href="#">
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
            <div style ="margin-top: 20px; ">
                <div class="card centered-card" style = "  width: 400px; height: 300px;  ">
                    <div class="card-body">
                        <?php  echo "<img src='../assets/icons/$usricon.png' class='card-img-top' alt='profile_' style='height: 100px; width: 100px; margin-bottom:10px'>" ?>
                        <h3><span class="badge bg-secondary"><?php echo explode("@",$usrmail)[0];?></span></h5>
                        <h5 class="card-subtitle mb-2 text-muted"><?php echo $usrmail;?></h4>
                        <p class="card-text" > 
                            <?php 
                                $bio = file_get_contents($domain_name."/controllers/getbio.php?id=".$usrid);
                                echo $bio;
                            ?> 
                        </p>
                        <a  href="editProfile.php" class="card-link" style="font-size: 20px; color: gray;">Edit Profile</a>
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