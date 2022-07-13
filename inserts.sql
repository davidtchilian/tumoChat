INSERT INTO USERS (user_email,user_password,user_bio,user_theme,user_icon)
VALUES ('david@mail.com', 'superpassword', 'hi im david', 0, 0); -- id 1
INSERT INTO USERS (user_email,user_password,user_bio,user_theme,user_icon)
VALUES ('gevork@mail.com', 'goodpassword', 'hi im gevork', 1, 2); -- id 2
INSERT INTO USERS (user_email,user_password,user_bio,user_theme,user_icon)
VALUES ('hayk@mail.com', 'insanepassword', 'hi im hayk', 1, 4); -- id 3

INSERT INTO GROUPCHAT (group_name,group_bio, group_type) VALUES
('Programming', 'This is a programming community',0 ),
('Group A', 'the first group', 1), -- id 1
('Group B', 'the second group', 1), -- id 2
('Group C', 'the third group', 1); -- id 3

INSERT INTO isInGroup(isInGroup_user_id, isInGroup_group_id) VALUES 
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(3, 1);

INSERT INTO MESSAGE (message_content,message_sender_id,message_group_id,message_date)
VALUES 
('1Barev', 1, 1, NOW()),
('2Barev Davit', 2, 1, NOW()),
('3Barev dzez', 3, 1, NOW());

