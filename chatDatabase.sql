CREATE TABLE USERS(
    user_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    user_email TEXT,
    user_password TEXT,
    user_bio TEXT,
    user_theme INT,
    user_icon INT  -- '/assets/images/INT.png'
);

CREATE TABLE GROUPCHAT(
    group_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    group_name TEXT,
    group_bio TEXT
);

CREATE TABLE MESSAGE(
    message_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    message_content TEXT,
    message_sender_id INT,
    message_group_id INT,
    message_date DATETIME,
    FOREIGN KEY (message_sender_id) REFERENCES USERS (user_id),
    FOREIGN KEY (message_group_id) REFERENCES GROUPCHAT (group_id)
);

CREATE TABLE isInGroup(
    isInGroup_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    isInGroup_user_id INT,
    isInGroup_group_id INT,
    FOREIGN KEY (isInGroup_user_id) REFERENCES USERS (user_id),
    FOREIGN KEY (isInGroup_group_id) REFERENCES GROUPCHAT (group_id)
);

SELECT *
FROM MESSAGES
ORDER BY id_message DESC
LIMIT 2;