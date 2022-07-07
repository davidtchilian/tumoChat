<<<<<<< HEAD
<?php 
    require_once '../models/db.php';
    session_start();


    $usrbio = $_POST['bio'];
    $usrid = 1;
    // $usrid = $_SESSION['user_id'];

    $sql = "  UPDATE USERS SET user_bio = '$usrbio' WHERE user_id = $usrid";
    mysqli_query($sql);
    $mysqli -> close();

?>
=======
>>>>>>> bd62ebb84fb8c85ba96aadf2463d108a88546c82
