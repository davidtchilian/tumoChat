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

    <div class="wrap">
        <div class="row pb-5">
            <div class="col text-center welcome">
                <h1><img src="../assets/images/logo_tuyu.png" class="logo" alt="TUYU"></h1>
            </div>
        </div>
        <div class="card centered-card">
            <div class="card-body">
                <form action="../controllers/logIn.php" method="post">

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control responsive-input" id="exampleInputEmail1" aria-describedby="emailHelp" name="user_email" required>
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>

                    <div class="mb-4">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <div class="fake-input responsive-input">
                        <input type="password" class="form-control" id="exampleInputPassword1" name="user_pass" required>
                        <img id="PassEye" width="25px" src="../assets/images/closed.png" alt="" onclick="changePassType()" class="eye" >
                        </div>
                    </div>
                        

                    <!-- <a class="btn btn-primary" href="page-accueil.html" role="button" style="float: left; background : #6C4B93">
                        Log In
                    </a> -->

                    <?php if($err_code != NULL) {
                        if($err_code == 1){
                            ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo "Empty Email Line"; ?>
                        </div> 
                        <?php }
                        if($err_code == 2){
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo "Incorrect email or password"; ?>
                        </div> 
                            <?php }
                        
                        if($err_code == 3){
                            ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo "Empty Password Line"; ?>
                        </div> 
                             <?php }
                    } ?>    

                    <input type="submit" name="Login" id="exampleInputSubmit" class="btn btn-primary mb-3" href="page-accueil.html" style="margin:0 auto; background : #6C4B93">
                    <div class="col-12" style="color: rgb(83, 100, 113);">
                        <span> Not yet a member? </span> 
                        <a class="" href="signUp.php">
                            Sign up
                        </a>
                        <a class="" href="../controllers/reset-password.php">
                            Forgot password?
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script>
        function changePassType(){
            let x = document.getElementById("exampleInputPassword1");
            let img = document.getElementById("PassEye");
            if (x.type === "password") {
                x.type = "text";
                img.src = "../assets/images/open.png";
            } else {
                x.type = "password";
                img.src = "../assets/images/closed.png";
            }
        }
    </script>
</body>

</html>