INSERT INTO USERS (user_email,user_password,user_bio,user_theme,user_icon)
VALUES ('david@mail.com', 'superpassword', 'hi im david', 0, 0); -- id 1
INSERT INTO USERS (user_email,user_password,user_bio,user_theme,user_icon)
VALUES ('gevork@mail.com', 'goodpassword', 'hi im gevork', 1, 2); -- id 2
INSERT INTO USERS (user_email,user_password,user_bio,user_theme,user_icon)
VALUES ('hayk@mail.com', 'insanepassword', 'hi im hayk', 1, 4); -- id 3

INSERT INTO GROUPCHAT (group_name,group_bio)
VALUES ('Group A', 'the first group'); -- id 1
INSERT INTO GROUPCHAT (group_name,group_bio)
VALUES ('Group B', 'the second group'); -- id 2
INSERT INTO GROUPCHAT (group_name,group_bio)
VALUES ('Group C', 'the third group'); -- id 3

INSERT INTO isInGroup(isInGroup_user_id, isInGroup_group_id) VALUES 
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(3, 1);

