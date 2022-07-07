<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>TUYU | inscription</title>
    <link rel="icon" type="image/png" href="logo_tuyu-sm.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
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
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-1">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                    </div>
                    <div class="mb-5">
                        <label for="exampleInputPassword1" class="form-label"> Confirm Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="confirmPassword">
                    </div>
                    <input type="submit">
                    <div class="col-10 text-sm" style="float: left; color: rgb(83, 100, 113);">
                        Already a member ?
                        <a class="btn btn-link btn-sm" href="logIn.php">
                            Log in
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>