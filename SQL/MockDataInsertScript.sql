/* MAJOR TABLE */
INSERT INTO Major (MajorName) VALUES ('Programming');
INSERT INTO Major (MajorName) VALUES ('CIT');
INSERT INTO Major (MajorName) VALUES ('Networking');
-- SELECT * FROM Major;

/* APP USER TABLE */
INSERT INTO AppUser (FirstName, LastName, LNumber, Password, EmailAddress) VALUES ('Mari', 'Good', 'L00000001', 'AppUser1', 'Goodm@lanecc.edu');
INSERT INTO AppUser (FirstName, LastName, LNumber, Password, EmailAddress) VALUES ('Ron', 'Little', 'L00000002', 'AppUser2', 'littler@lanecc.edu');
INSERT INTO AppUser (FirstName, LastName, LNumber, Password, EmailAddress) VALUES ('Tutor1', 'Three', 'L00000003', 'AppUser3', 'Tutor1@gmail.com');
INSERT INTO AppUser (FirstName, LastName, LNumber, Password, EmailAddress) VALUES ('Tutor2', 'Four', 'L00000004', 'AppUser4', 'Tutor2@gmail.com');
INSERT INTO AppUser (FirstName, LastName, LNumber, Password, EmailAddress) VALUES ('Student1', 'One', 'L00000005', 'Student1', 'Student1@gmail.com');
INSERT INTO AppUser (FirstName, LastName, LNumber, Password, EmailAddress) VALUES ('Student2', 'Two', 'L00000006', 'Student2', 'Student2@gmail.com');
INSERT INTO AppUser (FirstName, LastName, LNumber, Password, EmailAddress) VALUES ('Student3', 'Three', 'L00000007', 'Student3', 'Student3@gmail.com');
INSERT INTO AppUser (FirstName, LastName, LNumber, Password, EmailAddress) VALUES ('Student4', 'Four', 'L00000008', 'Student4', 'Student4@gmail.com');
INSERT INTO AppUser (FirstName, LastName, LNumber, Password, EmailAddress) VALUES ('Student5', 'Five', 'L00000009', 'Student5', 'Student5@gmail.com');
-- SELECT * FROM AppUser;


/* INSTRUCTOR TABLE */
INSERT INTO Instructor (UserID) VALUES (1);
INSERT INTO Instructor (UserID) VALUES (2);
-- SELECT * FROM Instructor;

/* TUTOR TABLE */
INSERT INTO Tutor (UserID, TutorBio) VALUES (3, 'Tutor with an id of 3 is good at C#');
INSERT INTO Tutor (UserID, TutorBio) VALUES (4, 'Tutor with an id of 4 is good at JavaScript');
-- SELECT * FROM Tutor;

/* STUDENT TABLE */
INSERT INTO Student (MajorID, UserID) VALUES (1, 1);
INSERT INTO Student (MajorID, UserID) VALUES (1, 2);
INSERT INTO Student (MajorID, UserID) VALUES (2, 3);
INSERT INTO Student (MajorID, UserID) VALUES (3, 4);
INSERT INTO Student (MajorID, UserID) VALUES (1, 5);
INSERT INTO Student (MajorID, UserID) VALUES (2, 6);
INSERT INTO Student (MajorID, UserID) VALUES (3, 7);
INSERT INTO Student (MajorID, UserID) VALUES (1, 8);
INSERT INTO Student (MajorID, UserID) VALUES (2, 9);
-- SELECT * FROM Student;

/* COURSE TABLE */
INSERT INTO Course VALUES ('CS 133N', 'Beginning C#', 2); /* CRN or this way */
INSERT INTO Course VALUES ('CIS 244', 'Systems Analysis and Design', 2);
INSERT INTO Course VALUES ('CS 296P', 'PHP', 1);
INSERT INTO Course VALUES ('CS 295N', 'ASP.Net', 1);
-- SELECT * FROM Course;

/* SCHEDULE TABLE */
INSERT INTO Schedule (UserID, StartTime, EndTime, WeekDay) VALUES (3, '2016-11-21 12:00:00', '2016-11-21 14:00:00', 1);
INSERT INTO Schedule (UserID, StartTime, EndTime, WeekDay) VALUES (3, '2016-11-23 09:00:00', '2016-11-23 12:00:00', 3);
INSERT INTO Schedule (UserID, StartTime, EndTime, WeekDay) VALUES (4, '2016-11-22 09:00:00', '2016-11-22 11:00:00', 2);
INSERT INTO Schedule (UserID, StartTime, EndTime, WeekDay) VALUES (4, '2016-11-24 14:00:00', '2016-11-24 16:30:00', 4);
-- SELECT * FROM Schedule;

/* TUTOREXPERTISE TABLE
INSERT INTO Tutorexpertise (Course_CourseNumber, UserID) VALUES ('CS 133N', 3);
INSERT INTO Tutorexpertise (Course_CourseNumber, UserID) VALUES ('CS 295N', 3);
INSERT INTO Tutorexpertise (Course_CourseNumber, UserID) VALUES ('CIS 244', 3);
INSERT INTO Tutorexpertise (Course_CourseNumber, UserID) VALUES ('CIS 244', 4);
INSERT INTO Tutorexpertise (Course_CourseNumber, UserID) VALUES ('CS 296P', 4);
-- SELECT * FROM Tutorexpertise;
*/

/* TERM TABLE */
INSERT INTO Term (TermId, TermName) VALUES (1, 'Fall');
INSERT INTO Term (TermId, TermName) VALUES (2, 'Winter');
INSERT INTO Term (TermId, TermName) VALUES (3, 'Spring');
INSERT INTO Term (TermId, TermName) VALUES (4, 'Summer');
-- SELECT * FROM Term;


/* SECTION TABLE */
INSERT INTO Section VALUES ('abc123', 2016, 1, 'CS 296P', 1);
INSERT INTO Section VALUES ('def456', 2016, 1, 'CS 133N', 2);
INSERT INTO Section VALUES ('ghi789', 2016, 1, 'CS 295N', 1);
INSERT INTO Section VALUES ('jkl012', 2016, 1, 'CIS 244', 2);
-- SELECT * FROM Section;

/* STUDENTREGISTRATION TABLE */
INSERT INTO StudentRegistration VALUES (6, 'abc123');
INSERT INTO StudentRegistration VALUES (7, 'def456');
INSERT INTO StudentRegistration VALUES (5, 'ghi789');
INSERT INTO StudentRegistration VALUES (2, 'abc123');
INSERT INTO StudentRegistration VALUES (7, 'ghi789');
INSERT INTO StudentRegistration VALUES (6, 'jkl012');
INSERT INTO StudentRegistration VALUES (3, 'ghi789');
INSERT INTO StudentRegistration VALUES (3, 'jkl012');
INSERT INTO StudentRegistration VALUES (1, 'abc123');
-- SELECT * FROM StudentRegistration;

/* LOCATION TABLE */
INSERT INTO Location (LocationName, StationId) VALUES ('Lab', 1);
INSERT INTO Location (LocationName, StationId) VALUES ('Lab', 2);
INSERT INTO Location (LocationName, StationId) VALUES ('Lab', 3);
INSERT INTO Location (LocationName, StationId) VALUES ('Lab', 4);
INSERT INTO Location (LocationName, StationId) VALUES ('Lab', 5);
INSERT INTO Location (LocationName) VALUES ('Home');
-- SELECT * FROM Location;

/* VISIT TABLE */
INSERT INTO Visit (StartTime, EndTime, LastPing, UserID, LocationId, Role) VALUES ( '2016-11-21 14:00:00', '2016-11-21 16:00:00', '2016-11-21 14:00:00', 5, 1, 'Student');
INSERT INTO Visit (StartTime, EndTime, LastPing, UserID, LocationId, Role) VALUES ( '2016-11-24 09:00:00', '2016-11-24 09:30:21', '2016-11-24 09:00:00', 6, 2, 'Student');
INSERT INTO Visit (StartTime, EndTime, LastPing, UserID, LocationId, Role) VALUES ( '2016-11-22 12:00:00', '2016-11-22 14:00:00', '2016-11-22 12:00:00', 4, 1, 'Student');
INSERT INTO Visit (StartTime, EndTime, LastPing, UserID, LocationId, Role) VALUES ( '2016-11-23 13:30:00', '2016-11-23 15:00:00', '2016-11-23 13:30:00', 7, 2, 'Student');
INSERT INTO Visit (StartTime, EndTime, LastPing, UserID, LocationId, Role) VALUES ( '2016-11-24 15:28:00', '2016-11-24 17:11:00', '2016-11-24 15:28:00', 9, 2, 'Student');
-- SELECT * FROM Visit;

/* TASK TABLE */
INSERT INTO Task (VisitId, CourseNumber, StartTime, EndTime) VALUES ( 1, 'CIS 244', '2016-11-21 14:00:00', '2016-11-21 16:00:00');
INSERT INTO Task (VisitId, CourseNumber, StartTime, EndTime) VALUES ( 2, 'CS 133N', '2016-11-24 14:00:00', '2016-11-21 16:30:00');
INSERT INTO Task (VisitId, CourseNumber, StartTime, EndTime) VALUES ( 3, 'CS 296P', '2016-11-23 14:00:00', '2016-11-21 16:45:00');
INSERT INTO Task (VisitId, CourseNumber, StartTime, EndTime) VALUES ( 4, 'CS 295N', '2016-11-22 14:10:00', '2016-11-21 16:50:00');
-- SELECT * FROM Task;

/* QUESTION TABLE */
INSERT INTO Question ( UserID, Subject, Description, Status, AskTime, CourseNumber) VALUES (5, 'Lab 5', 'How do I make it work?', 'Open', '2016-11-22 14:10:00', 'CIS 244');
INSERT INTO Question ( UserID, Subject, Description, Status, AskTime, CourseNumber) VALUES (6, 'loops', 'What is the syntax for a loop in c#?', 'Open', '2016-11-22 14:10:00', 'CS 133N');
INSERT INTO Question ( UserID, Subject, Description, Status, AskTime, CourseNumber) VALUES (7, 'sql statements', 'How do I auto increment values in mysql?', 'Open', '2016-11-22 14:10:00', 'CS 296P');
INSERT INTO Question ( UserID, Subject, Description, Status, AskTime, CourseNumber) VALUES (8, 'Ajax in ASP.net', 'How do I execute ajax to a restful api?', 'Open', '2016-11-22 14:10:00', 'CS 295N');
-- SELECT * FROM Question;

/* RESOLUTION TABLE */
INSERT INTO Resolution VALUES (1, 3, 'Student needs to see instructor about syntax.');
INSERT INTO Resolution VALUES (3, 4, 'Found information about the topic in chapter 3 of the textbook.');
-- SELECT * FROM Resolution;
