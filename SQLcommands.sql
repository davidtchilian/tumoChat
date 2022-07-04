DROP TABLE STUDENTS;
CREATE TABLE STUDENTS(
    id_student INT AUTO_INCREMENT NOT NULL,
    name TEXT,
    grade INT,
    age INT
);

INSERT INTO STUDENTS (name, grade, age) VALUES ('david', 4, 4);
INSERT INTO STUDENTS (name, grade, age) VALUES ('david', 4, 4);
INSERT INTO STUDENTS (name, grade, age) VALUES ('gevork', 10, 10);

SELECT DISTINCT *
FROM STUDENTS
WHERE grade > 4 
AND name = 'david';

UPDATE STUDENTS
SET grade = 10
WHERE name = 'david';