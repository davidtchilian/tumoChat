<?php
    include '../config/config.php';
?>
<!doctype html>
<html lang="en">

<head>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>TUMO | connexion </title>
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
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="../scripts/googleapi/googlesignin.js"></script>
    <script >console.log(132);</script>
</head>

<body style='display:flex; align-items: center; background-image: url("../assets/images/themes/3.jpg");'>

    <div class="wrap">
        <div class="row pb-5">
            <div class="col text-center welcome">
                <a href="index.php"><img src="../assets/tumologos/image.png" class="logo" alt="TUYU"></a>
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

                    <?php if(isset($_GET['id'])) {
                        if($_GET['id'] == 0){
                            ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo "You are successfully signed up!";?>
                        </div>
                        <?php }
                        if($_GET['id'] == 1){
                            ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo "Incorrect email or password!"; ?>
                        </div> 
                        <?php }
                        if($_GET['id'] == 2){
                        ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo "Successfully signed out!"; ?>
                        </div> 
                            <?php }
                        if($_GET['id'] == 3){
                            ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo "Mail was sent Successfully!"; ?>
                            </div> 
                                <?php }
                        if($_GET['id'] == 4){
                            ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo "Someting went wrong"; ?>
                            </div> 
                                <?php }
                        if($_GET['id'] == 5){
                            ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo "You changed Your password successfully!"; ?>
                            </div> 
                                <?php }
                                if($_GET['id'] == 6){
                                    ?>
                                    <div class="alert alert-success" role="alert">
                                        <?php echo "You deleted your account successfully!"; ?>
                                    </div> 
                                        <?php }
                    } ?>
                    <div class="login-buttons">
                        <input type="submit" name="Login" value="Log In" id="exampleInputSubmit" class="submit-btn mb-3" href="home.php" style="margin:0 auto;">
                        <p>━ OR ━</p>
                        <div id="g_id_onload"
                            data-client_id="<?php echo $config['GOOGLE_DATA_CLIENT_ID']; ?>"
                            data-context="signin"
                            data-ux_mode="popup"
                            data-auto_prompt="false"
                            data-callback="handleCredentialResponse"
                            >
                        </div>
                        <div class="g_id_signin"
                            data-type="standard"
                            data-shape="pill"
                            data-theme="filled_blue"
                            data-text="signup_with"
                            data-size="large"
                            data-logo_alignment="left"
                            data-width="250">
                        </div>
                    </div>
                    <div class="col-12" style="color: rgb(83, 100, 113);">
                        <span>Not yet a member?</span> 
                        <a class="signlink" href="signUp.php">Sign up</a>
                        <a class="signlink" href="forgetpwd.php">Forgot password?</a>
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