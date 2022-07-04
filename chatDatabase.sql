CREATE TABLE USER(
    user_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    user_email TEXT,
    user_password TEXT,
    user_bio TEXT,
    user_theme INT,
    user_icon INT  -- '/assets/images/INT.png'
);

CREATE TABLE GROUP(
    group_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    group_name TEXT,
    group_bio TEXT,
);

CREATE TABLE MESSAGE(
    message_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    message_content TEXT,
    message_sender_id INT,
    message_group_id INT,
    message_date DATETIME
);

CREATE TABLE isInGroup(
    isInGroup_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    group_id INT,
    user_id INT
);

SELECT *
FROM MESSAGES
ORDER BY id_message DESC
LIMIT 2;