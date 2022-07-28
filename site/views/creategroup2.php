<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ./login.php?id=4');
    exit();
}
require_once '../models/db.php';
$me = $_SESSION['user_id'];
$bio = $_POST['grpbio'];
$name = $_POST['grpname'];
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        <?php $theme = $_SESSION['user_theme']; ?>body {
            background-image: url("../assets/images/themes/<?php echo $theme; ?>.jpg");
            background-size: 15%;
        }
    </style>

</head>

<body>

    <!-- Background image -->
    <div class="bg-image d-flex justify-content-center align-items-center"></div>


    <div class="card mx-auto card-body mb-3 mt-4 " style="width: 27rem;">
        <h5 class="card-title">Creating Groups</h5>
        <form action="../controllers/creationgroup.php" method="post">
            <?php
            if (isset($_GET['err'])) {
                if ($_GET['err'] == '1') {
                    echo "<div class='alert alert-danger' role='alert'>
                        You must select at least one member!
                        </div>";
                }
            }
            ?>
            <label for="exampleFormControlTextarea1" class="form-label; float: left;">Name of Persons</label>
            <div class="center clear">

                <div id="promoNode"></div>
                <select name='select[]' class="chosen" multiple="true" style="width:400px;">
                    <?php
                    $users = array();
                    // final sql : "SELECT USERS.user_email, USERS.user_id FROM USERS JOIN friends ON ((friends.user_id_1 = $userId AND USERS.user_id = friends.user_id_2) OR (friends.user_id_2 = $userId AND USERS.user_id = friends.user_id_1)) WHERE USERS.user_id!=$userId";
                    $sql = "SELECT user_email, user_id FROM USERS WHERE user_id != $me";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $temp = array();
                            array_push($temp, $row["user_id"]);
                            array_push($temp, $row["user_email"]);
                            $users[] = $temp;
                        }
                    }
                    foreach ($users as $i) {
                        echo "<option value='$i[0]'>" . explode("@", $i[1])[0] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <a href="../views/creategroup.php" class="btn btn-primary mt-3 " style="background-color: rgb(108, 2, 119); border-color: rgb(108, 2, 119);">Return</a>
            <input type="hidden" value="<?php echo $bio;  ?>" name="groupbio">
            <input type="hidden" value="<?php echo $name;  ?>" name="groupname">

            <button type="submit" class="btn btn-primary mt-3" style="float: right; background-color: rgb(108, 2, 119); border-color: rgb(108, 2, 119); ">Create</button>
        </form>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js" integrity="sha512-eSeh0V+8U3qoxFnK3KgBsM69hrMOGMBy3CNxq/T4BArsSQJfKVsKb5joMqIPrNMjRQSTl4xG8oJRpgU2o9I7HQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="../scripts/chosen.jquery.js"></script>
    <script>
        jQuery(document).ready(function() {
            jQuery(".chosen").data("placeholder", "Select persons you want to add...").chosen();
        });
    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>