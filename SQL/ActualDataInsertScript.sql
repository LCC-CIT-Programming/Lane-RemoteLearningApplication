/* MAJOR TABLE */
INSERT INTO Major (MajorName) VALUES ('Programming');
INSERT INTO Major (MajorName) VALUES ('CIS');
INSERT INTO Major (MajorName) VALUES ('Networking');
INSERT INTO Major (MajorName) VALUES ('Gaming');
INSERT INTO Major (MajorName) VALUES ('ASOT CS');
INSERT INTO Major (MajorName) VALUES ('CIT');

/* TaskType TABLE */
INSERT INTO TaskType (TaskTypeName, TaskTypeCategory) VALUES ('Hands On Assignment - Homework', 'Lab');
INSERT INTO TaskType (TaskTypeName, TaskTypeCategory) VALUES ('Hands On Assigment - In Class', 'Lab');
INSERT INTO TaskType (TaskTypeName, TaskTypeCategory) VALUES ('Homework Assignment', 'Lecture');
INSERT INTO TaskType (TaskTypeName, TaskTypeCategory) VALUES ('Reading - Required', 'Lecture');
INSERT INTO TaskType (TaskTypeName, TaskTypeCategory) VALUES ('Reading - Recommended', 'Lecture');
INSERT INTO TaskType (TaskTypeName, TaskTypeCategory) VALUES ('Reading - Extra', 'Lecture');
INSERT INTO TaskType (TaskTypeName, TaskTypeCategory) VALUES ('Reading Quiz', 'Lecture');
INSERT INTO TaskType (TaskTypeName, TaskTypeCategory) VALUES ('Midterm', 'Assessment');
INSERT INTO TaskType (TaskTypeName, TaskTypeCategory) VALUES ('Final', 'Assessment');
INSERT INTO TaskType (TaskTypeName, TaskTypeCategory) VALUES ('Demonstration - Video', 'Lecture/Lab');
INSERT INTO TaskType (TaskTypeName, TaskTypeCategory) VALUES ('Demonstration - Live', 'Lecture/Lab');
INSERT INTO TaskType (TaskTypeName, TaskTypeCategory) VALUES ('Tutorial - Written' , 'Lecture/Lab');
INSERT INTO TaskType (TaskTypeName, TaskTypeCategory) VALUES ('Tutorial - Video', 'Lecture/Lab');
INSERT INTO TaskType (TaskTypeName, TaskTypeCategory) VALUES ('Lecture - Live', 'Lecture');
INSERT INTO TaskType (TaskTypeName, TaskTypeCategory) VALUES ('Lecture - Video', 'Lecture');
-- SELECT * FROM TaskType;

/* APP USER TABLE  - need lnumbers and part timers and tutors*/
INSERT INTO Appuser (FirstName, LastName, LNumber, EmailAddress) VALUES ('Mari', 'Good', 'L00000051', 'goodm@lanecc.edu');
INSERT INTO Appuser (FirstName, LastName, LNumber, EmailAddress) VALUES ('Ron', 'Little', 'L00000002', 'littler@lanecc.edu');
INSERT INTO Appuser (FirstName, LastName, LNumber, EmailAddress) VALUES ('Jim', 'Bailey', 'L00000003', 'baileyj@lanecc.edu');
INSERT INTO Appuser (FirstName, LastName, LNumber, EmailAddress) VALUES ('Paul', 'Wilkins', 'L00000004', 'wilkinsp@lanecc.edu');
INSERT INTO Appuser (FirstName, LastName, LNumber, EmailAddress) VALUES ('Brian', 'Bird', 'L00000005', 'birdb@lanecc.edu');
INSERT INTO Appuser (FirstName, LastName, LNumber, EmailAddress) VALUES ('Pam', 'Farr', 'L00000006', 'farrp@lanecc.edu');
INSERT INTO Appuser (FirstName, LastName, LNumber, EmailAddress) VALUES ('Joseph', 'Colton', 'L00000007', 'coltonj@lanecc.edu');
INSERT INTO Appuser (FirstName, LastName, LNumber, EmailAddress) VALUES ('Don', 'Easton', 'L00000008', 'eastond@lanecc.edu');
INSERT INTO Appuser (FirstName, LastName, LNumber, EmailAddress) VALUES ('Jacob', 'Riddle', 'L00000010', 'riddlej@lanecc.edu');
INSERT INTO Appuser (FirstName, LastName, LNumber, EmailAddress) VALUES ('Jon', 'Beck', 'L00000011', 'beckj@lanecc.edu');

-- SELECT * FROM appuser;


/* INSTRUCTOR TABLE - need to add records for each part timer too*/
INSERT INTO Instructor (UserID) VALUES (1);
INSERT INTO Instructor (UserID) VALUES (2);
INSERT INTO Instructor (UserID) VALUES (3);
INSERT INTO Instructor (UserID) VALUES (4);
INSERT INTO Instructor (UserID) VALUES (5);
INSERT INTO Instructor (UserID) VALUES (6);
INSERT INTO Instructor (UserID) VALUES (7);
INSERT INTO Instructor (UserID) VALUES (8);
-- SELECT * FROM instructor;

/* TUTOR TABLE  - need to add other tutors*/
INSERT INTO Tutor (UserID, TutorBio) VALUES (9, 'Jacobs''s Bio');
INSERT INTO Tutor (UserID, TutorBio) VALUES (10, 'Jon''s Bio');
-- SELECT * FROM tutor;

/* STUDENT TABLE */
-- SELECT * FROM Student;

/* Course TABLE - finish list - check format of course numbers in text files */
INSERT INTO Course VALUES ('CS 133N', 'Beginning Programming: CSharp', 1); 
INSERT INTO Course VALUES ('CS 233N', 'Intermediate Programming: CSharp', 1); 
INSERT INTO Course VALUES ('CS 234N', 'Advanced Programming: CSharp', 1); 
INSERT INTO Course VALUES ('CS 133JS', 'Beginning Programming: JavaScript', 1); 
INSERT INTO Course VALUES ('CS 233JS', 'Intermediate Programming: JavaScript', 1); 
INSERT INTO Course VALUES ('CS 295P', 'Web Development 1: PHP ', 1); 
INSERT INTO Course VALUES ('CS 296P', 'Web Development 2: PHP ', 1); 
INSERT INTO Course VALUES ('CS 295N', 'Web Development 1:  .NET ', 5); 
INSERT INTO Course VALUES ('CS 296N', 'Web Development 2:  .NET ', 5); 
INSERT INTO Course VALUES ('CS 235AM', 'Mobile Development:  Android', 5); 
INSERT INTO Course VALUES ('CS 235IM', 'Mobile Development:  iOS', 5); 
INSERT INTO Course VALUES ('CIS 195', 'Web Authoring:  HTML', 5); 
INSERT INTO Course VALUES ('CS 297', 'Programming Capstone', 5); 
INSERT INTO Course VALUES ('CIS 125D', 'Software Applications: Database', 6); 
INSERT INTO Course VALUES ('CS 275', 'Database Modeling', 6); 
INSERT INTO Course VALUES ('CS 276', 'Database Programming', 6); 
INSERT INTO Course VALUES ('CIS 244', 'Systems Analysis', 6); 
INSERT INTO Course VALUES ('CIS 246', 'Systems Design', 4); 

-- SELECT * FROM Course;

/* SCHEDULE TABLE */
-- SELECT * FROM schedule;

/* TUTOREXPERTISE TABLE
INSERT INTO tutorexpertise (Course_CourseNumber, UserID) VALUES ('CS 133N', 3);
INSERT INTO tutorexpertise (Course_CourseNumber, UserID) VALUES ('CS 295N', 3);
INSERT INTO tutorexpertise (Course_CourseNumber, UserID) VALUES ('CIS 244', 3);
INSERT INTO tutorexpertise (Course_CourseNumber, UserID) VALUES ('CIS 244', 4);
INSERT INTO tutorexpertise (Course_CourseNumber, UserID) VALUES ('CS 296P', 4);
-- SELECT * FROM tutorexpertise;
*/

/* TERM TABLE */
INSERT INTO Term (TermId, TermName) VALUES (2, 'Fall');
INSERT INTO Term (TermId, TermName) VALUES (3, 'Winter');
INSERT INTO Term (TermId, TermName) VALUES (4, 'Spring');
INSERT INTO Term (TermId, TermName) VALUES (1, 'Summer');
-- SELECT * FROM term;


/* Section TABLE */
-- SELECT * FROM Section;

/* StudentRegistration TABLE */
-- SELECT * FROM StudentRegistration;

/* Location TABLE */
INSERT INTO Location (LocationName) VALUES ('Lab 135');
INSERT INTO Location (LocationName) VALUES ('Lab 130');
INSERT INTO Location (LocationName) VALUES ('Group Room');
INSERT INTO Location (LocationName) VALUES ('Classroom');
INSERT INTO Location (LocationName) VALUES ('Off campus');
INSERT INTO Location (LocationName) VALUES ('Home');

-- SELECT * FROM Location;

/* Visit TABLE */
-- SELECT * FROM Visit;

/* Task TABLE */
-- SELECT * FROM Task;

/* Question TABLE */
-- SELECT * FROM Question;

/* RESOLUTION TABLE */
-- SELECT * FROM resolution;