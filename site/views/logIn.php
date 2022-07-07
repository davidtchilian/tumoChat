<?php
    $actual_link = "$_SERVER[REQUEST_URI]";
    $url_components = parse_url($actual_link);

    parse_str($url_components['query'], $params);

    $err_code = $params['err'];
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>TUYU | connexion </title>
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

    <div class="container">
        <div class="row">
            <div class="col text-center mt-5">
                <h1>Welcome back <img src="logo_tuyu.png" class="logo" alt="TUYU"></h1>
            </div>
        </div>
        <div class="card centered-card">
            <div class="card-body">
                <form action="../controllers/logIn.php" method="post">

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="user_email">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>

                    <div class="mb-5">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="user_pass">
                    </div>

                    <!-- <a class="btn btn-primary" href="page-accueil.html" role="button" style="float: left; background : #6C4B93">
                        Log In
                    </a> -->

                    <?php if($err_code != NULL) {
                        if($err_code == 1){
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo "Incorrect email or password"; ?>
                            </div> 
                            <?php }
                    } ?>

                    
                    <input type="submit" name="Login" id="exampleInputSubmit" class="btn btn-primary" href="page-accueil.html" style="float: left; background : #6C4B93">
                    <div class="col-10 text-sm" style="float: left; color: rgb(83, 100, 113);">
                        Not yet a member ?
                        <a class="btn btn-link btn-sm" href="signUp.php">
                            Sign up
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>