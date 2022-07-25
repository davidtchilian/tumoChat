<?php

$messageCount;
$groupId = $_GET['id'];

session_start();
$userId = $_SESSION["user_id"];
$isingroup = false;
$isingroup_message = false;

$dir    = '../assets/stickers/';
$files = array_values(array_diff(scandir($dir), array('..', '.')));


if (!isset($userId)) {
    header("Location: login.php");
    return;
}

if (!isset($groupId)) {
    header("Location: home.php");
    return;
}

require('../models/db.php');



$limit = 23;

$sql = "SELECT q.* FROM 
  (SELECT * 
   FROM message 
   WHERE message_group_id=$groupId
   ORDER BY `message_id` DESC LIMIT $limit) 
  q ORDER BY q.`message_id` ASC";

$messages = mysqli_query($conn, $sql);


$sql = "SELECT group_name, group_type, group_icon FROM groupchat WHERE group_id = $groupId";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$groupName = $row["group_name"];
$groupType = $row['group_type'];
$groupIcon = $row['group_icon'];

$getTypeSql = "SELECT typeName FROM typeGroupChat WHERE typeGroupChat_id = $groupType";
$groupTypeName = mysqli_fetch_assoc(mysqli_query($conn, $getTypeSql))['typeName'];


//   $message = mysqli_fetch_assoc($messages);
if ($groupType == 2) {
    $group_users = file_get_contents($domain_name . "/controllers/getgroupusers.php?id=" . $groupId);
    $group_users = json_decode($group_users);
    $isingroup = false;
    for ($i = 0; $i < count($group_users) && !$isingroup; $i++) {
        $isingroup = $group_users[$i] == $userId;
    }

    if (!$isingroup) {
        header("Location: home.php");
    }
}



$sql1 = "SELECT group_admin_id FROM groupchat WHERE group_id=$groupId";
$groupAdminId = mysqli_fetch_assoc(mysqli_query($conn, $sql1))['group_admin_id'];
$isAdmin = $userId == $groupAdminId;


function startsWith($string, $startString)
{
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../style/page-chat.css" />
    <link rel="stylesheet" href="../style/chosen.css" />
    <title><?php echo $groupName . " - TUYU"; ?></title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,100&display=swap');

        .dropbtn {
            background-color: #4CAF50;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropdown {
            position: relative;
            display: none;
        }

        .dropdown-content {
            display: block;
            position: absolute;
            background-color: #f9f9f9;
            border-radius: .375rem;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            /* margin-left: -160px; */
            transform: translateX(24rem);
            width: 200px;
            margin-top: 70px;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
            border-radius: .375rem;
        }


        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }

        .user_icon {
            height: 35px;
        }

        .user_email {
            font-family: 'Roboto', sans-serif;
            padding: 0 10px;
        }

        .delated_user {
            font-family: 'Roboto', sans-serif;
            padding: 0 10px;
            color: #ff5b4f;
        }

        <?php $theme = $_SESSION['user_theme'];

        ?>body {
            background-image: url("../assets/images/themes/<?php echo $theme; ?>.jpg");
        }
    </style>
</head>

<body id="bodyHTML">

    <div class="fixed-top">
        <nav id="navbar" class="navbar navbar-expand-lg" style="background-color : #6c4b93;">
            <?php
            if ($groupTypeName == "private") {
            ?>
                <a href="home.php"><img src="../assets/images/flèche_retour3.png" alt="Retour" style="width : 35px; height: 35px; margin-left: 10px" /></a>
            <?php
            } else {
            ?>
                <a href="community.php"><img src="../assets/images/flèche_retour3.png" alt="Retour" style="width : 35px; height: 35px; margin-left: 10px" /></a>
            <?php
            }
            ?>
            <div class="container">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php
                    if ($groupTypeName == "public") { ?>
                        <li>
                            <img class="comm_icon" style="margin: 6px 0" src="../assets/comm_icons/<?php echo $groupIcon; ?>.png" alt="">
                        </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" style="color : white; margin-left: 14px"><?php echo $groupName; ?></a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a onClick="getGroupIdInfo('<?php echo $userId; ?>', '<?php echo $groupId; ?>', '<?php echo $isAdmin; ?>', '<?php echo $groupAdminId; ?>')">
                        <button id="infoButton" type="button" class="btn info">
                            <img src="../assets/images/le_vrai_i.png" alt="Information" style="width: 35px; height: 35px;" />
                        </button>
                    </a>
                </div>

                <div id="infoModal" class="modal_user">
                    <div class="modal-content" id="modCont">
                        <?php if ($groupTypeName == "public") { ?>
                            <div>
                                <button id="closeButton" class="close btn modal_interaction"><img src="../assets/images/cllose.png" alt="sticker" style="width :40px" style="height : 40px" />
                                </button>
                            </div>
                            <div class="groupinfo_div" id="groupinfo-container">
                                <p id="groupInfo" style="font-size: 2rem" class="group_name"></p>
                                <img class="comm_icon" style="margin: 1rem; width: 70px;" src="../assets/comm_icons/<?php echo $groupIcon; ?>.png" alt="">
                                <div id="groupBio"></div>
                            </div>
                        <?php } else { ?>
                            <div class="groupinfo_div" id="groupinfo-container">
                                <p id="groupInfo" class="group_name"></p>
                            </div>
                            <div class="usersinfo_div">
                                <div id="usersInfo"></div>
                                <div id="modal_buttons" class="userinfo_buttons">
                                    <div id="modal-extra-interactions">

                                    </div>
                                    <div id="modal-default-interactions">
                                        <button id="closeButton" class="close btn modal_interaction">Close</button>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div id="addModal" class="modal_user">
                    <div class="modal-content">
                        <div class="modal-add-users">
                        <form action="../controllers/adduser.php?group_id=<?= $groupId?>" method="POST">
                        <label for="exampleFormControlTextarea1" class="form-label; float: left;">Name of Persons</label>
                        <div class="center clear">
                            <div id="promoNode"></div>
                            <select name='select' class="chosen" multiple="true" style="width:400px;">
                                <?php
                                $users = array();
                                // **CHJNJEEEEEEL** FOR ADD USER IN GC SELECT USERS.user_email, USERS.user_id FROM USERS JOIN friends ON ((friends.user_id_1 = 1 AND USERS.user_id = friends.user_id_2) OR (friends.user_id_2 = 1 AND USERS.user_id = friends.user_id_1)) WHERE USERS.user_id!=1
                                $sql = "SELECT USERS.user_email, USERS.user_id FROM USERS JOIN friends ON ((friends.user_id_1 = $userId AND USERS.user_id = friends.user_id_2) OR (friends.user_id_2 = $userId AND USERS.user_id = friends.user_id_1)) WHERE USERS.user_id!=$userId";
                                $result = mysqli_query($conn,$sql);
                                if(mysqli_num_rows($result) > 0){
                                    while($row = $result->fetch_assoc()){
                                        $temp = array();
                                        array_push($temp, $row["user_id"]);
                                        array_push($temp, $row["user_email"]);
                                        $users[] = $temp;
                                    }
                                }
                                foreach($users as $i){
                                    echo "<option value='$i[0]'>" . explode("@", $i[1])[0] . "</option >";
                                }
                                ?>
                            </select>
                            <input type="hidden" name="groupname" value="<?=$groupName?>">
                            <button type="submit" class="btn btn-primary mt-3"
                style="float: right; background-color: rgb(108, 2, 119); border-color: rgb(108, 2, 119); ">Add</button>
                        </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>

    </div>
    </nav>
    </div>
    <div id="cont0" class="container mt-5" style="min-height : 100vh;" style="position : relative">
        <br><br>

        <?php
        while ($message = mysqli_fetch_assoc($messages)) {
            $icon = file_get_contents($domain_name . "/controllers/getusericon.php?id=" . $message["message_sender_id"]);
            $user_email = file_get_contents($domain_name . "/controllers/getuseremail.php?id=" . $message["message_sender_id"]);
            $user_name = explode("@", $user_email)[0];
            if ($message['message_sender_id'] == $userId) {
        ?>
                <div class="row" id="messages">
                    <div class="col-4"></div>
                    <div class="col-7">
                        <button class="btn btn-primary messageEnvoye mt-2" onclick="show(event)" style="float : right; color: black;" id="<?= $message['message_id'] ?>">
                            <?php
                            // echo "<p class='user_email'>".$user_name."</p>";
                            $stickerSplit = explode("_", $message['message_content']);
                            if ($stickerSplit[0] == "STICKER") {
                                $stickerId = $stickerSplit[1];
                                echo "<img src='../assets/stickers/$stickerId.png' style='height: 100px; width: 100px'>";
                            } else {
                                echo "<pre >" . "<span class='message_content_span' onclick='show(event)' id=" . $message['message_id'] . ">" . $message['message_content'] . "</span>" . "</pre>";
                            ?>
                        </button>
                        <div class="dropdown" style="width:30px; margin-top:-30px;" id="<?= "dropdown" . $message['message_id'] ?>">

                            <div class="dropdown-content" id="dropdown-content">
                                <a onclick="myFunction(event)" id=<?= "editId" . $message['message_id'] ?> name="<?= $message['message_id'] ?>">Edit</a>
                                <a onclick="deleteMessages(event)" id="<?= "delete" . $message['message_id'] ?>">Delete</a>
                            </div>

                        </div>
                    </div>
                </div>
            <?php }
                        } else {
                            for ($i = 0; $i < count($group_users); $i++) {
                                if ($group_users[$i] == $message["message_sender_id"]) {
                                    $isingroup_message = true;
                                    
                                }
                                
                                
                            }
            ?>
            <div class="row">
                <?php
                            if ($isingroup_message == true) { ?>
                    <div class="col-1"><img src="../assets/icons/<?php echo $icon; ?>.png" class="user_icon"></div>
                    <div class="col-7">
                        <button type="button" class="btn btn-primary messageRecu mt-2" style="float : left; color: black;">
                            <?php
                                echo "<p class='user_email'>" . $user_name . "</p>";
                                //  echo  $message['message_content'];
                                $stickerSplit = explode("_", $message['message_content']);
                            if ($stickerSplit[0] == "STICKER") {
                                $stickerId = $stickerSplit[1];
                                echo "<img src='../assets/stickers/$stickerId.png' style='height: 100px; width: 100px'>";
                            } else {
                                echo "<pre >" . "<span class='message_content_span' onclick='show(event)' id=" . $message['message_id'] . ">" . $message['message_content'] . "</span>" . "</pre>"; 
                            }
                                ?>
                        </button>
                    </div>
                <?php
                            } else { ?>
                    <div class="col-1"><img src="../assets/comm_icons/100.png" class="user_icon"></div>
                    <div class="col-7">
                        <button type="button" class="btn btn-primary messageRecu mt-2" style="float : left; color: black;">
                            <?php
                                echo "<p class='delated_user'>Delated user</p>";
                                echo $message['message_content'] ?>
                        </button>
                    </div>
                <?php
                            }
                ?>
                <div class="col-4"></div>
            </div>
    <?php
                        }
                    }
    ?>

    </div>
    <!-- <form >
        <input type="hidden" id = "scrollBottom>
    </form> -->
    <br>
    <br>
    <br>
    <br>

    <div class="fixed-bottom" style="position:fixed">
        <nav id="navbar1" class="navbar navbar-expand-lg" id="navbarId" style="background-color : #6c4b93;">
            <div class="container">
                <a onClick="sticker()" id="stickerButton" class="sticker_btn nav-link" style="display: inline-block">
                    <img src="../assets/images/stickerr.png" alt="sticker" style="width :40px" style="height : 40px" />
                </a>

                <div class="container-fluid" style="align-items:center; justify-content: center">
                    <form class="d-flex" role="search" method="post" id="form" style="align-items:center">
                        <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
                        <input type="hidden" name="group_id" value="<?php echo $groupId; ?>" id="groupId">
                        <input type="hidden" name="message_id" value="<?= $message['message_id'] ?>" id="message_id">
                        <input type="hidden" id="jsUserId" value="<?= $userId ?>">
                        <div class="form-group" style="margin: 0 20px; width: 75%;">
                            <textarea name="message_content" style="resize: none" class="form-control" id="text" rows="1" placeholder="Enter your message here" autofocus></textarea>
                        </div>
                        <button class="btn search" type="submit" value="Message" id="send" onClick="sendMessage(event)">
                            <img src="../assets/images/avion_papier_nour_1.png" alt="envoye" style="width :40px" style="height : 40px" />
                        </button>
                    </form>

                </div>
                <div id="stickerModal" class="modal_user">
                    <div id="modCont1" class="modal-content modal-content-sticker" style="background-color: #664C8F;">

                        <div id="modal-extra-interactions"></div>
                        <div id="modal-default-interactions">
                            <button id="stickerCloseButton" class="close btn modal_interaction"><img src="../assets/images/cllose.png" alt="sticker" style="width :40px" style="height : 40px" />
                            </button>
                        </div>
                        <div>
                            <?php
                            for ($i = 0; $i < count($files); $i++) {
                                $result =  $dir . $files[$i] . "\n";
                                $number = explode(".", $files[$i])[0];
                                $sticker = "<button onClick='sendSticker('$number','$groupId')' ><img src='$result' class='card-img-top'
                                alt='profile_' style='height: 70px; width: 70px'></button>";
                            ?>
                                <a onClick="sendSticker(' <?php echo $number ?>','<?php echo $groupId; ?>')"><img src="<?php echo $result ?>" class='card-img-top' alt='profile_' style='height: 70px; width: 70px'></a>
                            <?php
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <script src="../scripts/jquery.js">
    </script>
    <script type="text/javascript" src="../scripts/sticker.js"></script>
    <script>
        const params = new URLSearchParams(window.location.search);
        if (params.getAll('modal')[0] == 1) {
            getGroupIdInfo('<?php echo $userId; ?>', '<?php echo $groupId; ?>',
                '<?php echo $isAdmin; ?>',
                '<?php echo $groupAdminId; ?>');
            modal.style.display = "block";
        }
    </script>
    <script src="../scripts/chosen.jquery.js"></script>
    <script type="text/javascript" src="../scripts/chat.js" refer></script>
    <script>
        jQuery(document).ready(function () {
            jQuery(".chosen").data("placeholder", "Select persons you want to add...").chosen();
        });
    </script>
    <?php
    if($groupTypeName=="public"){
    ?>
    <script>
var img = document.createElement('img');
img.src= "../assets/comm_icons/<?php echo $groupIcon; ?>.png";
function getAverageRGB(imgEl) {

var blockSize = 5, // only visit every 5 pixels
    defaultRGB = {r:0,g:0,b:0}, // for non-supporting envs
    canvas = document.createElement('canvas'),
    context = canvas.getContext && canvas.getContext('2d'),
    data, width, height,
    i = -4,
    length,
    rgb = {r:0,g:0,b:0},
    count = 0;

if (!context) {
    return defaultRGB;
}

height = canvas.height = imgEl.naturalHeight || imgEl.offsetHeight || imgEl.height;
width = canvas.width = imgEl.naturalWidth || imgEl.offsetWidth || imgEl.width;

context.drawImage(imgEl, 0, 0);

try {
    data = context.getImageData(0, 0, width, height);
} catch(e) {
    /* security error, img on diff domain */
    return defaultRGB;
}

length = data.data.length;

while ( (i += blockSize * 4) < length ) {
    ++count;
    rgb.r += data.data[i];
    rgb.g += data.data[i+1];
    rgb.b += data.data[i+2];
}

// ~~ used to floor values
rgb.r = ~~(rgb.r/count);
rgb.g = ~~(rgb.g/count);
rgb.b = ~~(rgb.b/count);

let diff = 1.3/((rgb.r/255)+(rgb.g/255)+(rgb.b/255));
console.log(diff)
rgb.r = rgb.r*diff;
rgb.g = rgb.g*diff;
rgb.b = rgb.b*diff;

console.log(rgb.r);
console.log(rgb.g);
console.log(rgb.b);

return rgb;
}
let rgb = getAverageRGB(img);
document.getElementById("navbar").style.backgroundColor = 'rgb(' + rgb.r + ',' + rgb.g + ',' + rgb.b + ')';
document.getElementById("modCont").style.backgroundColor = 'rgb(' + rgb.r + ',' + rgb.g + ',' + rgb.b + ')';
document.getElementById("modCont1").style.backgroundColor = 'rgb(' + rgb.r + ',' + rgb.g + ',' + rgb.b + ')';
document.getElementById("closeButton").style.backgroundColor = 'rgb(' + rgb.r/1.2 + ',' + rgb.g/1.2 + ',' + rgb.b/1.2 + ')';
document.getElementById("stickerCloseButton").style.backgroundColor = 'rgb(' + rgb.r/1.2 + ',' + rgb.g/1.2 + ',' + rgb.b/1.2 + ')';
document.getElementById("groupinfo-container").style.backgroundColor = 'rgb(' + rgb.r/1.2 + ',' + rgb.g/1.2 + ',' + rgb.b/1.2 + ')';
document.getElementById("navbar1").style.backgroundColor = 'rgb(' + rgb.r + ',' + rgb.g + ',' + rgb.b + ')';
Array.from(document.getElementsByClassName("messageEnvoye")).map((element)=>{element.style.backgroundColor = 'rgb(' + rgb.r*1.2 + ',' + rgb.g*1.2 + ',' + rgb.b*1.2 + ')'; element.style.borderColor = 'rgb(' + rgb.r + ',' + rgb.g + ',' + rgb.b + ')'});
document.getElementById("infoButton").onmouseover = function() 
{
    this.style.borderColor = 'rgb(' + rgb.r/1.2 + ',' + rgb.g/1.2 + ',' + rgb.b/1.2 + ')';
}
document.getElementById("infoButton").onmouseout = function() 
{
    this.style.borderColor = 'rgba(255,255,255,0)';
}
document.getElementById("send").onmouseover = function() 
{
    this.style.borderColor = 'rgb(' + rgb.r/1.2 + ',' + rgb.g/1.2 + ',' + rgb.b/1.2 + ')';
}
document.getElementById("send").onmouseout = function() 
{
    this.style.borderColor = 'rgba(255,255,255,0)';
}
</script>
<?php } ?>
</body>

</html>