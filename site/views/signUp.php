<?php
    $actual_link = "$_SERVER[REQUEST_URI]";
    $url_components = parse_url($actual_link);

    parse_str($url_components['query'], $params);

    $err_code = $params['err'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>TUYU | inscription</title>
    <link rel="icon" type="image/png" href="../assets/images/logo_tuyu-sm.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <link rel="stylesheet" href="../style/style.css" />
    <style>

    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col text-center mt-5">
                <h1>Welcome <img src="../assets/images/logo_tuyu.png" class="logo" alt="TUYU"></h1>
                <h5>Sign up for free!</h5>
            </div>
        </div>
        <div class="card centered-card-bg">
            <div class="card-body">
                <form action="../controllers/signup.php" method="POST">

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required>
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>

                    <div class="mb-2">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <div class="fake-input">
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                        <img id="passEye" width="25px" src="../assets/images/closed.png" alt="" onclick="change1()" class="eye">
                        </div>  
                    </div>

                    <div class="mb-4">
                        <label for="exampleInputPassword1" class="form-label"> Confirm Password</label>
                        <div class="fake-input">
                        <input type="password" class="form-control" id="exampleInputPassword2" name="confirmPassword" required>
                        <img id="confEye" width="25px" src="../assets/images/closed.png" alt="" onclick="change2()" class="eye">    
                        </div>
                        
                    </div>
                    <?php if($err_code != NULL) {
                        if($err_code == 1){
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo "This username already exists"; ?>
                            </div> 
                            <?php }
                        if($err_code == 2){
                        ?>
                            <div class="alert alert-danger" role="alert">
                            <?php echo "Passwords do not match!"; ?>
                            </div> 
                            <?php }
                        if($err_code == 3){
                        ?>
                            <div class="alert alert-danger" role="alert">
                            <?php echo "The password is too short!"; ?>
                            </div> 
                    <?php }
                    if($err_code == 4){
                        ?>
                            <div class="alert alert-danger" role="alert">
                            <?php echo "The password has to include a symbol other than space!"; ?>
                            </div> 
                    <?php }
                    if($err_code == 5){
                        ?>
                            <div class="alert alert-danger" role="alert">
                            <?php echo "Invalid email!"; ?>
                            </div> 
                    <?php }}?>
                    <input type="submit" name="Login" id="exampleInputSubmit" class="btn btn-primary" href="page-accueil.html" style="float: left; background : #6C4B93">
                    <br>
                    <br>
                    <div class="col-10 text-sm" style="float: left; color: rgb(83, 100, 113);">
                        Already a member ?
                        <a class="btn btn-link btn-sm" href="logIn.php" >
                            Log in
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script>
        function change1(){
            let x = document.getElementById("exampleInputPassword1");
            let img = document.getElementById("passEye");
            if (x.type === "password") {
                x.type = "text";
                img.src = "../assets/images/open.png";
            } else {
                x.type = "password";
                img.src = "../assets/images/closed.png";
            }
        }
        function change2(){
            let x = document.getElementById("exampleInputPassword2");
            let img = document.getElementById("confEye");
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