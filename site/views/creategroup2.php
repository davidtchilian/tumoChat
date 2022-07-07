<?php
require_once '../models/db.php';
$bio= $_POST['bio'];
$name = $_POST['Group_Name']
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create group page</title>
    <link rel="stylesheet" href="../style/chosen.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>

<body style="background-image: url('super_fond_violet.jpg');height: 100vh;">

    <!-- Background image -->
    <div class="bg-image d-flex justify-content-center align-items-center"></div>


    <div class="card mx-auto card-body mb-3 mt-4 " style="width: 27rem;">
        <h5 class="card-title">Creating Groups</h5>
        <form action= "../controllers/creategroup.php " method="post">

            <label for="exampleFormControlTextarea1" class="form-label; float: left;">Name of Persons</label>
            <div class="center clear">

                <div id="promoNode"></div>
                <select name = 'select[]'class="chosen" multiple="true" style="width:400px;">
                    <?php
                    $users = array();
                    $sql = "SELECT user_email FROM USERS";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            array_push($users, $row["user_email"]);
                            }
                    }
                        foreach($users as $i){
                            echo'<option>'. explode("@",$i)[0] .'</option >';
                        }
                    ?>
                <!--<option value="id" >Person 1</option>
                    <option>Person 2</option>
                    <option>Person 3</option>
                    <option>Person 4</option>
                </select>-->
            </div>
            <a href="../controllers/creategroup.php" class="btn btn-primary mt-3 "
                style="background-color: rgb(108, 2, 119); border-color: rgb(108, 2, 119);">Return</a>
                <input type="hidden" value="<?php echo $bio;  ?>" name="bio">
                <input type="hidden" value="<?php echo $name;  ?>" name="name">
            <button type="submit" class="btn btn-primary mt-3"
                style="float: right; background-color: rgb(108, 2, 119); border-color: rgb(108, 2, 119); ">Create</button>
        </form>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js" integrity="sha512-eSeh0V+8U3qoxFnK3KgBsM69hrMOGMBy3CNxq/T4BArsSQJfKVsKb5joMqIPrNMjRQSTl4xG8oJRpgU2o9I7HQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="../scripts/chosen.jquery.js"></script>
    <script>
        jQuery(document).ready(function () {
            jQuery(".chosen").data("placeholder", "Select persons you want to add...").chosen();
        });
    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
</body>
</html>