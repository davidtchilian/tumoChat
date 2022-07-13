INSERT INTO GROUPCHAT (group_name,group_bio, group_type, group_icon) VALUES
('Programming', 'This is the Programming community', 0, 11),
('Web Development', 'This is the Web Development community', 0, 13),
('Robotics', 'This is the Robotics community', 0, 12),
('Game Development', 'This is the Game Development community', 0, 5),
('3D Modeling', 'This is the 3D Modeling community', 0, 1),
('Animation', 'This is the Animation community', 0, 2),
('Photography', 'This is the Photography community', 0, 10),
('Drawing', 'This is the Drawing community', 0, 3),
('Music', 'This is the Music community', 0, 8),
('Graphic Design', 'This is the Graphic Design community', 0, 6),
('Motion Graphics', 'This is the Motion Graphics community', 0, 7),
('New Media', 'This is the New Media community', 0, 9),
('Filmmaking', 'This is the Filmmaking community', 0, 4),
('Writing', 'This is the Writing community', 0, 14);

INSERT INTO isInGroup(isInGroup_user_id, isInGroup_group_id) VALUES 
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14);

INSERT INTO MESSAGE (message_content,message_sender_id,message_group_id,message_date)
VALUES 
('1Barev', 1, 1, NOW()),
('2Barev Davit', 2, 1, NOW()),
('3Barev dzez', 3, 1, NOW());

