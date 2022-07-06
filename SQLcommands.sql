-- Connexion
SELECT user_id
FROM USERS
WHERE user_email = '$mail'
AND user_password = '$password';

-- SignUp
INSERT INTO USERS(user_email,user_password,user_bio,user_theme,user_icon)
VALUES ('$mail', '$pwd', '', 0, 0);

--GetMessages
SELECT message_content, message_sender_id, message_date
FROM MESSAGE
WHERE message_group_id = $groupid
ORDER BY message_id;

-- updateBio
UPDATE USERS
SET user_bio = '$usrbio'
WHERE user_id = $usrid;

-- udpdateIcon
UPDATE USERS
SET user_icon = $usricon
WHERE user_id = $usrid;

-- getGroupInfo.php
SELECT group_name, group_bio
FROM GROUPCHAT
WHERE group_id = $groupid;

SELECT isInGroup_user_id
FROM isInGroup 
WHERE isInGroup_group_id = $groupid;

-- sendMessage.php
INSERT INTO MESSAGE(message_content,message_sender_id,message_group_id,message_date)
VALUES ('$messagecontent', $userid, $groupid, NOW());

-- createGroup.php
INSERT INTO GROUPCHAT (group_name, group_bio, group_admin_id)
VALUES ('$groupname', '$groupbio', $adminid);

INSERT INTO isInGroup (isInGroup_user_id, isInGroup_group_id)
VALUES ($u, $groupid);

-- deleteGroup.php
DELETE FROM MESSAGE WHERE message_group_id = $groupid;
DELETE FROM isInGroup WHERE isInGroup_group_id = $groupid;
DELETE FROM GROUPCHAT WHERE group_id = $groupid;

-- deleteUserFromGroup.php
DELETE FROM MESSAGE WHERE message_sender_id = $userid;
DELETE FROM isInGroup WHERE isInGroup_user_id = $userid;
