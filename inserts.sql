INSERT INTO typeGroupChat (typeName) VALUES
('public'),
('private');


INSERT INTO GROUPCHAT (group_name,group_bio, group_icon, group_type) VALUES
('Programming', 'In the programming workshop students learn how to control variables, create and manipulate functions and everything in between that’s needed for the wonderful world of code. ', 11 ,1),
('Web Development', 'By learning HTML & CSS to PHP & MySQL and, finally, CMS, students acquire fundamental industry skills. However the primary goal is not to teach students how to follow instructions but present students with the tools to facilitate problem-solving so that they can achieve independence and think beyond the browser window.', 13,1),
('Robotics', 'The TUMO robotics workshop isn’t just about learning about the newest tech in the field. Students learn visual programming, creative and analytical thinking, problem-solving through teamwork, and hands-on work building and programming robots that can complete a set of tasks determined by the students themselves.', 12,1),
('Game Development', 'Playing games is easy, building a game is a wholly different experience. The entire point of the TUMO game development workshops is to create a new gaming universe from design to programming and everything in between. By the end of the three levels, each participant will be able to design and develop their own 3D video game using the Unity Engine. What they learn can be applied to most industry-leading game engines.', 5,1),
('3D Modeling', 'Aside from its more obvious uses in film visual effects and video games, 3D modeling plays an important role in advertising, architecture, medicine, jewelry, and product design. In the workshop, students learn the basics of 3D modeling: how to create hard-surface objects by manipulating polygons, edges, and vertices. After passing all three levels, the students have a strong enough foundation to create just about any 3D model… yes, really, anything! They can use their newfound 3D modeling skills in 3D game design, animation, sculpting, medicine, science or just for fun.', 1,1),
('Animation', 'Animation is all about creating characters and bringing them to life. By learning the principles of animation, students also explore the mechanics of how we move, talk, and act in different situations. After passing three levels of the animation workshop, students have a strong enough base to continue animating and improving their skills independently. They can put all of this knowledge to use in 3D animation, stop motion animation and more.', 2,1),
('Photography', 'In the photography workshop, students learn what it means to communicate using images from the world around them. Teens start by discovering how to control light with a photo camera, an important element of photography. From there, they move on to composition where they discover the techniques of visual storytelling that they can utilize as they capture images for work or pleasure. Students gain insight into the basic elements of photography including composition, light and storytelling, along with a keen understanding of visual perception and photographic methods of communication.', 10,1),
('Drawing', 'Students learn how to explore and observe the world that surrounds them and utilize it in their illustrations and character creation. They also learn how to be more attentive to the world around them in order to observe details that they can use to improve their drawing skills and creativity in their art. After this workshop, students gain skills in visual storytelling, from creating illustrated characters and putting them into different poses and moods, to creating comics or illustrations that incorporate basic drawing skills, including anatomy, body mechanics, perspective and composition.', 3,1),
('Music', 'The fulfilling path of studying music, exploring its genres, learning to play various classical and electronic instruments, songwriting, and composing is what our three levels of music workshops are all about. Students learn the ins and outs of creating music using the industry-standard Logic Pro software suite.', 8,1),
('Graphic Design', 'Graphic Design shows students how the world communicates visually, how they can widen their scopes of creativity and all that awaits them within the creative market. Students begin by exploring the fundamentals of design and then move forward by creating designs and branding using industry-standard tools such as Adobe Illustrator and Photoshop.', 6,1),
('Motion Graphics', 'What if you could combine the best parts of graphic design and animation? With motion graphics, you can do just that. Motion grabs our attention while graphics are the visual representation of an object or idea.  Together, they become a powerful tool that can communicate messages, advertise or sell a product, tell stories and even make us laugh. 
Students learn and put into practice the skills needed to succeed as a motion artist in various industries (including advertising, game design, film) using software such as standards Adobe Illustrator and After Effects.', 7,1),
('New Media', 'New media takes contemporary approaches to communication and enhances them by utilizing existing digital tools to connect with the audience. Equipped with the skills to leverage digital tools as means of communication, students navigate the landscape of New Media with ease as they maximize the reach of their digital storytelling.', 9,1),
('Filmmaking', 'Whether students are interested in creating fictional or documentary, art-house or blockbuster, short or feature-length, this workshop is where to get started. By the end of the third level, students conceive, produce, film and edit their own short film. Filmmaking workshops give students insight and hands-on experience with the foundations of filmmaking: planning, shooting, and editing. In short, telling a visual story.', 4,1),
('Writing', 'It all begins with the written word… no, no, really. Games, movies, comic books, music, and even graphic design often rely on the written word to convey an idea or message. Regardless of the platform, the foundation is the same.', 14,1);
 
INSERT INTO typeNotification(typeName) VALUES
('GroupInvite');

INSERT INTO Statistics_Types (statistic_type) VALUES ('LoginCount');
INSERT INTO Statistics_Types (statistic_type) VALUES ('MessageCount');


-- INSERT INTO isInGroup(isInGroup_user_id, isInGroup_group_id) VALUES 
-- (1, 1),
-- (1, 2),
-- (1, 3),
-- (1, 4),
-- (1, 5),
-- (1, 6),
-- (1, 7),
-- (1, 8),
-- (1, 9),
-- (1, 10),
-- (1, 11),
-- (1, 12),
-- (1, 13),
-- (1, 14);

-- INSERT INTO MESSAGE (message_content,message_sender_id,message_group_id,message_date)
-- VALUES 
-- ('1Barev', 1, 1, NOW()),
-- ('2Barev Davit', 2, 1, NOW()),
-- ('3Barev dzez', 3, 1, NOW());

