CREATE TABLE USERS(
    user_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    user_email TEXT,
    user_password TEXT,
    user_bio TEXT,
    user_theme INT,
    user_icon INT  -- '/assets/images/INT.png'
);

CREATE TABLE typeGroupChat(
    typeGroupChat_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    typeName TEXT
);

CREATE TABLE typeNotification(
    typeNotification_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    typeName TEXT
);

CREATE TABLE typeMessage(
    typeMessage_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    typeName TEXT
);

CREATE TABLE GROUPCHAT(
    group_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    group_name TEXT,
    group_bio TEXT,
    group_admin_id INT,
    group_type INT,
    group_icon INT,
    FOREIGN KEY (group_admin_id) REFERENCES USERS (user_id),
    FOREIGN KEY (group_type) REFERENCES typeGroupChat (typeGroupChat_id)
);

CREATE TABLE MESSAGE(
    message_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    message_content TEXT,
    message_sender_id INT,
    message_group_id INT,
    message_type_id INT,
    message_date DATETIME,
    FOREIGN KEY (message_sender_id) REFERENCES USERS (user_id),
    FOREIGN KEY (message_group_id) REFERENCES GROUPCHAT (group_id),
    FOREIGN KEY (message_type_id) REFERENCES typeMessage (typeMessage_id)
);

CREATE TABLE isInGroup(
    isInGroup_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    isInGroup_user_id INT,
    isInGroup_group_id INT,
    FOREIGN KEY (isInGroup_user_id) REFERENCES USERS (user_id),
    FOREIGN KEY (isInGroup_group_id) REFERENCES GROUPCHAT (group_id)
);

CREATE TABLE NOTIFICATIONS(
    notification_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    notification_sender_id INT,
    notification_receiver_id INT,
    notification_group_id INT,
    notification_content TEXT,
    notification_type_id INT,
    FOREIGN KEY (notification_sender_id) REFERENCES USERS (user_id),
    FOREIGN KEY (notification_receiver_id) REFERENCES USERS (user_id),
    FOREIGN KEY (notification_group_id) REFERENCES GROUPCHAT (group_id),
    FOREIGN KEY (notification_type_id) REFERENCES typeNotification (typeNotification_id)
);

CREATE TABLE RESET_PWD(
    reset_pwd_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    reset_pwd_hash TEXT,
    reset_pwd_user_id INT,
    reset_pwd_date DATETIME
);


CREATE TABLE Statistics_Types(
    statistic_type_id INT AUTO_INCREMENT,
    statistic_type TEXT,
    PRIMARY KEY (statistic_type_id)
);

CREATE TABLE Badges(
    badge_id INT AUTO_INCREMENT,
    badge_name TEXT,
    badge_requirement_count INT,

    PRIMARY KEY (badge_id)
);

CREATE TABLE Statistics_Main(
    statistic_user_id INT,
    statistic_type_id INT,
    statistic_count INT,
    FOREIGN KEY (statistic_user_id) REFERENCES USERS (user_id),
    FOREIGN KEY (statistic_type_id) REFERENCES Badges (badge_id)
);

CREATE TABLE friends(
    user_id_1 INT,
    user_id_2 INT,
    FOREIGN KEY (user_id_1) REFERENCES USERS (user_id),
    FOREIGN KEY (user_id_2) REFERENCES USERS (user_id),
    PRIMARY KEY (user_id_1, user_id_2)
);