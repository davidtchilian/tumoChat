<?php

if (!isset($_GET['id']) || $_GET['id'] == "") {
    header("Location: home.php");
    exit();
}
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
    echo "lol";
    return;
}

require_once('../models/db.php');
require_once('../models/functions.php');

$userInfo = getUserInfo($conn, $userId);
$userIcon = $userInfo['user_icon'];
$userName = explode("@", $userInfo['user_email'])[0];

$limit = 23;

$sql = "SELECT q.* FROM 
  (SELECT * 
   FROM message 
   WHERE message_group_id=$groupId
   ORDER BY `message_id` DESC LIMIT $limit) 
  q ORDER BY q.`message_id` ASC";

$messages = mysqli_query($conn, $sql);


$sql = "SELECT group_name, group_type, group_icon, group_bio FROM groupchat WHERE group_id = $groupId";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$groupName = $row["group_name"];
$groupType = $row['group_type'];
$groupIcon = $row['group_icon'];
$groupbio = $row['group_bio'];

$getTypeSql = "SELECT typeName FROM typeGroupChat WHERE typeGroupChat_id = $groupType";
$groupTypeName = mysqli_fetch_assoc(mysqli_query($conn, $getTypeSql))['typeName'];



if ($groupType == 2) {
    $group_users = getGroupUsersId($conn, $groupId);
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

<!DOCTYPE html id="doctype">
<html lang="en" id="HTML">

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
            background-size: 15%;
        }
    </style>
</head>

<body id="bodyHTML" onclick="hideAdvance(event)">
<input type="hidden" id="groupType" name="<?= $groupTypeName?>">
<input type="hidden" id="admin" name="<?=$isAdmin?>">

    <div class="fixed-top" onclick="hideAdvance(event)" >
        <nav id="navbar" onclick="hideAdvance(event)"class="navbar navbar-expand-lg" style="background-color : #6c4b93;">
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

                    <button id="infoButton" type="button" class="btn info">
                        <img src="../assets/images/le_vrai_i.png" alt="Information" style="width: 35px; height: 35px;" />
                    </button>

                </div>

                <div id="infoModal" class="modal_user" >
                    <div class="modal-content" id="modalCont">
                        <?php if ($groupTypeName == "public") { ?>
                            <div>
                                <button id="closeButton" class="close btn modal_interaction"><img src="../assets/images/cllose.png" alt="sticker" style="width :40px" style="height : 40px" />
                                </button>
                            </div>
                            <div class="groupinfo_div" id="groupinfo-container">
                                <p id="groupInfo" style="font-size: 2rem" class="group_name"><?= $groupName ?></p>
                                <img class="comm_icon" style="margin: 1rem; width: 70px;" src="../assets/comm_icons/<?php echo $groupIcon; ?>.png" alt="">
                                <p id="groupInfo" class="group_bio"><?= $groupbio ?></p>

                                <div id="groupBio"></div>
                            </div>
                        <?php } else {
                            $usersId =  getGroupUsersId($conn, $groupId);
                            $admin = getGroupAdmin($conn, $groupId);
                        ?>
                            <div class="groupinfo_div" id="groupinfo-container">
                                <p id="groupInfo" class="group_name"> <?= getgroupinfo($conn, $groupId)["group_name"] ?></p>
                                <?php if (getgroupinfo($conn, $groupId)["group_bio"] != "") { ?>
                                    <p class="group_bio"><?= getgroupinfo($conn, $groupId)["group_bio"] ?></p>
                                <?php } ?>
                            </div>
                            <div class="usersinfo_div" id="usersinfo_div">
                                <div id="usersInfo">
                                    <?php foreach ($usersId as $uId) :
                                        $usersInfo = getUserInfo($conn, $uId);
                                    ?>
                                        <div class="user_info_page" id="<?="div".$uId?>">
                                            <?php if ($isAdmin) {
                                                if ($uId == $groupAdminId) { ?>
                                                    <p><?= $usersInfo["user_email"] ?></p><span style="padding-right:10px">⚡</span>

                                                <?php } else { ?>
                                                    <p><?= $usersInfo["user_email"] ?> </p><a style="margin-right:10px" onclick="deleteUser(event)" class="user_delete_button" ><span style="cursor:pointer" id="<?= $uId ?>">❌</span></a>
                                                <?php }
                                            } else {
                                                if ($uId == $groupAdminId) { ?>
                                                    <p><?= $usersInfo["user_email"] ?></p><span style="padding-right:10px">⚡</span>
                                                <?php } else { ?>
                                                    <p><?= $usersInfo["user_email"] ?></p>
                                            <?php }
                                            } ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="userinfo_buttons" id="modal-extra-interactions">
                                <?php if ($isAdmin) { ?>
                                    <div class="userinfo_buttons_restyle" style="margin-left:-500px;">
                                        <a href="#" class="add_user " id="add_user">Add User</a>
                                        <a href="../controllers/deletegroup.php?delid=<?= $userId ?>&id=<?= $groupId ?>" class="delete_group" id="delete_group">Delete Group</a>
                                    </div>
                                <?php } else { ?>
                                    <div class="userinfo_buttons_restyle">
                                        <a href="../controllers/leaveGroup.php?delid=<?= $userId ?>&id=<?= $groupId ?>" class="leave_group" id="leave_group">Leave Group</a>
                                    </div>  
                                <?php } ?>
                                <button id="closeButton" class="close btn modal_interaction">Close</button>
                            </div>
                        <?php } ?>
                    </div>
                </div>



                <div id="addModal" class="modal_user">
                    <div class="modal-content" id="modalCont">
                        <div class="modal-add-users">
                            <form action="../controllers/adduser.php?group_id=<?= $groupId ?>" method="POST">
                                <label for="exampleFormControlTextarea1" class="form-label;" style="color: #fff;">Name of Persons</label>
                                <div class="center clear">
                                    <div id="promoNode"></div>
                                    <select name='select' class="chosen" multiple="true" style="width:400px;">
                                        <?php
                                        $users = array();
                                        $sql = "SELECT USERS.user_email, USERS.user_id FROM USERS JOIN friends ON ((friends.user_id_1 = $userId AND USERS.user_id = friends.user_id_2) OR (friends.user_id_2 = $userId AND USERS.user_id = friends.user_id_1)) WHERE USERS.user_id!=$userId";

                                        $usersin = getGroupUsersId($conn, $groupId);

                                        foreach ($usersin as $u) {
                                            $sql = $sql . " " . "AND user_id != $u";
                                        }

                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $temp = array();
                                                array_push($temp, $row["user_id"]);
                                                array_push($temp, $row["user_email"]);
                                                $users[] = $temp;
                                            }
                                        }

                                        foreach ($users as $i) {
                                            echo "<option value='$i[0]'>" . explode("@", $i[1])[0] . "</option >";
                                        }
                                        ?>
                                    </select>
                                    <input type="hidden" name="groupname" value="<?= $groupName ?>">
                                    
                                    <button id="closeButton" class="close btn modal_interaction mt-3">Close</button>
                                    <button type="submit" class="btn btn-primary mt-3" style="float: right; background-color: rgb(108, 2, 119); border-color: rgb(108, 2, 119); ">Add</button>
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
    <div id="cont0" class="container mt-5" style="min-height : 65vh;" style="position : relative" name="ptiashxates" onclick="hideAdvance(event)">
        <br>

        <?php
        while ($message = mysqli_fetch_assoc($messages)) {
            $user = getUserInfo($conn, $message['message_sender_id']);
            $icon = $user['user_icon'];
            $user_email = $user['user_email'];
            $user_name = explode("@", $user_email)[0];
            if ($message['message_sender_id'] == $userId) {
        ?>
                <div class="row" id="messages">
                    <div class="col-4"></div>
                    <div class="col-8 test">
                        <button class="btn btn-primary messageEnvoye mt-2" onclick="show(event)" style="float : right; color: black;" id="<?= $message['message_id'] ?>">
                            <?php
                            // echo "<p class='user_email'>".$user_name."</p>";
                            $stickerSplit = explode("_", $message['message_content']);
                            if ($stickerSplit[0] == "STICKER") {
                                $stickerId = $stickerSplit[1];
                                echo "<img id=" . $message['message_id'] . " src='../assets/stickers/$stickerId.png' style='height: 100px; width: 140px' >";
                            } else {
                                echo "<pre >" . "<span class='message_content_span' onclick='show(event)' id=" . $message['message_id'] . ">" . $message['message_content'] . "</span>" . "</pre>";
                            ?>
                        </button>
                    <?php } ?>
                    </div>
                </div>
            <?php
            } else {
                for ($i = 0; $i < count($group_users) && !$isingroup_message; $i++) {
                    if ($group_users[$i] == $message["message_sender_id"]) {
                        $isingroup_message = true;
                    }
                }
            ?>
                <div class="row">
                    <?php
                    if ($isingroup_message || $groupTypename = "public") { ?>
                        <div class="col-1"><img src="../assets/icons/<?php echo $icon; ?>.png" class="user_icon"></div>
                        <div class="col-7">
                            <button type="button" class="btn btn-primary messageRecu mt-2" style="float : left; color: black;">
                                <?php
                                echo "<p class='user_email'>" . $user_name . "</p>";
                                $stickerSplit = explode("_", $message['message_content']);
                                if ($stickerSplit[0] == "STICKER") {
                                    $stickerId = $stickerSplit[1];
                                    echo "<img src='../assets/stickers/$stickerId.png' style='height: 100px; width: 140px'>";
                                } else {
                                    echo "<pre>" . "<span class='message_content_span' onclick='show(event)' id=" . $message['message_id'] . ">" . $message['message_content'] . "</span>" . "</pre>";
                                }
                                ?>
                            </button>
                        </div>
                    <?php
                    } else { ?>
                        <div class="col-1"><img src="../assets/comm_icons/100.png" class="user_icon"></div>
                        <div class="col-7">
                            <button type="button" class="btn btn-primary messageRecu mt-2" style=" float :left; color: black;">
                                <?php
                                echo "<p class='delated_user'>Delated user</p>";
                                $stickerSplit = explode("_", $message['message_content']);
                                if ($stickerSplit[0] == "STICKER") {
                                    $stickerId = $stickerSplit[1];
                                    echo "<img src='../assets/stickers/$stickerId.png' style='height: 100px; width: 100px'>";
                                } else {
                                    echo "<pre >" . "<span class='message_content_span' onclick='show(event)' id=" . $message['message_id'] . ">" . $message['message_content'] . "</span>" . "</pre>";
                                }  ?>
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

    <div class="fixed-bottom" style="position:fixed" >
        <div class="editDelete" id="EditDelete">
        <?= $message?>
            <div class="editDeleteContent">

                <a id="editBtn" onclick="myFunction(event)">Edit</a>
                <a id="deleteBtn" onclick="deleteMessages(event)">Delete</a>
            </div>
        </div>
        <nav id="navbar1" onclick="hideAdvance(event)" class="navbar navbar-expand-lg" id="navbarId" style="background-color : #6c4b93;">
            <div class="container" onclick="hideAdvance(event)">
                <a onClick="sticker()" id="stickerButton" class="sticker_btn nav-link sticker_a" style="display: inline-block; margin-bottom:1rem;">
                    <img src="../assets/images/stickerr.png" alt="sticker" style="width :40px" style="height : 40px" />
                </a>

                <div class="container-fluid" style="align-items:center; justify-content: center">
                    <form class="d-flex" role="search" method="post" id="form" style="align-items:center">
                        <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
                        <input type="hidden" name="group_id" value="<?php echo $groupId; ?>" id="groupId">
                        <input type="hidden" name="message_id" value="<?= $message['message_id'] ?>" id="message_id">
                        <input type="hidden" id="jsUserId" value="<?= $userId ?>">
                        <div class="form-group" style="margin: 0 20px; width: 75%;">
                            <textarea onclick="hide()" name="message_content" style="resize: none" class="form-control" id="text" rows="1" placeholder="Enter your message here" autofocus></textarea>
                        </div>
                        <button class="btn search" type="submit" value="Message" id="send" onClick="sendMessage(event)">
                            <img src="../assets/images/avion_papier_nour_1.png" alt="envoye" style="width :40px" style="height : 40px" />
                        </button>
                    </form>

                </div>
                <div id="stickerModal" class="modal_user">
                    <div class="modal-content modal-content-sticker" id="stickerCont">

                        <div id="modal-extra-interactions"></div>
                        <div id="modal-default-interactions">
                            <button id="stickerCloseButton" class="close btn modal_interaction"><img src="../assets/images/cllose.png" alt="sticker" style="width :40px" style="height : 40px" />
                            </button>
                        </div>
                        <div class="stickerList">
                            <?php
                            for ($i = 0; $i < count($files); $i++) {
                                $result =  $dir . $files[$i] . "\n";
                                $number = explode(".", $files[$i])[0];
                                $sticker = "<button onClick='sendSticker('$number','$groupId')' ><img src='$result' class='card-img-top'
                                alt='profile_' style='height: 71px; width: 100px'></button>";
                            ?>
                                <a onClick="sendSticker(' <?php echo $number ?>','<?php echo $groupId; ?>')"><img src="<?php echo $result ?>" class='card-img-top sticker_a' alt='profile_' style='height: 71px; width: 100px'></a>
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
    <script>
        jQuery(document).ready(function() {
            jQuery(".chosen").data("placeholder", "Select persons you want to add...").chosen();
        });
    </script>
    <script>

        console.log("IM HERE")

        var conn = new WebSocket('ws://localhost:1000');

        // <div class="col-1"><img src="../assets/icons/ echo $icon; .png" class="user_icon"></div>
        // <div class="col-7">
        //     <button type="button" class="btn btn-primary messageRecu mt-2" style="float : left; color: black;">
        //         
        //         echo "<p class='user_email'>" . $user_name . "</p>";
        //         $stickerSplit = explode("_", $message['message_content']);
        //         if ($stickerSplit[0] == "STICKER") {
        //             $stickerId = $stickerSplit[1];
        //             echo "<img src='../assets/stickers/$stickerId.png' style='height: 100px; width: 100px'>";
        //         } else {
        //             echo "<pre>" . "<span class='message_content_span' onclick='show(event)' id=" . $message['message_id'] . ">" . $message['message_content'] . "</span>" . "</pre>";
        //         }
        //         
        //     </button>
        // </div>


        conn.onmessage = function(e) {
            const messageData = JSON.parse(e.data);
            console.log(messageData)

            const chatContainer = document.getElementById("cont0")

            const cont = document.createElement("div");
            cont.setAttribute("class", "row");
            cont.setAttribute("id", "messages");

            // DIV col-1 START

            const divCol1 = document.createElement("div");
            divCol1.setAttribute("class", "col-1");

            const userIcon = document.createElement("img");
            userIcon.setAttribute("src", `../assets/icons/${messageData.icon}.png`);
            userIcon.setAttribute("class", "user_icon");


            divCol1.appendChild(userIcon);

            // DIV col-1 END

            const divCol7 = document.createElement("div");
            divCol7.setAttribute("class", "col-7");

            const userName = document.createElement("p");
            userName.setAttribute("class", "user_email");
            userName.innerText = messageData.userName;

            cont.appendChild(divCol1);
            cont.appendChild(divCol7);

            const button = document.createElement("button");
            button.setAttribute("class", "btn btn-primary messageRecu mt-2");
            button.setAttribute("onclick", "show(event)");
            button.setAttribute("style", "float : left; color: black;");

            if (typeName == "public") {
                button.style.backgroundColor = 'rgb(' + rgb.r * 1.2 + ',' + rgb.g * 1.2 + ',' + rgb.b * 1.2 + ')';
                button.style.borderColor = 'rgb(' + rgb.r + ',' + rgb.g + ',' + rgb.b + ')';
            }

            const span = document.createElement("span");
            span.setAttribute("class", "message_content_span");
            span.setAttribute("onclick", "show(event)");

            if (messageData.message_content.startsWith("STICKER_")) {
                let sticker = document.createElement("img");
                sticker.src = `../assets/stickers/${messageData.message_content.split("_")[1]}.png`;
                sticker.style.width = "140px";
                sticker.style.height = "100px";
                sticker.setAttribute("name", id)
                span.appendChild(sticker);
            } else {
                span.setAttribute("id", id)
                span.innerText = messageData.message_content;
            }

            button.appendChild(userName)
            button.appendChild(span)
            divCol7.appendChild(button)
            chatContainer.appendChild(cont)
        };

        function sendMsg(message) {
            conn.send(JSON.stringify({
                userId: <?php echo $userId; ?>,
                groupId: <?php echo $groupId; ?>,
                message_content: message,
                icon: <?php echo $userIcon; ?>,
                userName: "<?php echo $userName; ?>"
            }));
        }

    </script>
    <script id="chat" type="text/javascript" src="../scripts/chat.js" typeName=<?php echo $groupTypeName; ?> imageSrc=<?php echo $groupIcon; ?>></script>

</body>

</html>