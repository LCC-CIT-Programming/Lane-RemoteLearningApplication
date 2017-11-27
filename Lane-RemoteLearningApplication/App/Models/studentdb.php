<?php

class StudentDB
{
    public static function StudentLogin($USERNAME, $PASSWORD)
    {
        $query = 'SELECT appuser.*, MajorId
                FROM `appuser`
                INNER JOIN student
                ON appuser.UserID = student.UserID
			          WHERE appuser.LNumber = :username
                AND appuser.Password = :password';

        $db = Database::getDB();
        $statement = $db->prepare($query);
        $statement->bindValue(":username", $USERNAME);
        $statement->bindValue(":password", $PASSWORD);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();

        if ($row != false) {
            $user = new Student($row['FirstName'],
                                $row['LastName'],
                                $row['LNumber'],
                                $row['Password'],
                                $row['EmailAddress'],
                                $row['MajorId'],
                                $row['UserID']);
            return $user;
        } else {
            return null;
        }
    }


    public static function GetStudentCourses($STUDENT)
    {
        $userID = $STUDENT->getUserID();

        $query = 'SELECT * FROM Course
    						 JOIN Section ON Course.CourseNumber = Section.CourseNumber
    						 JOIN StudentRegistration ON Section.SectionNumber = StudentRegistration.SectionNumber
    						 JOIN Student ON StudentRegistration.UserID = Student.UserID
    				     WHERE Student.UserID = :id';

        $db = Database::getDB();

        $statement = $db->prepare($query);
        $statement->bindValue(":id", $userID);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();

        $courses = array();

        foreach ($rows as $row) {
            $course = new Course($row['CourseNumber'],
                                 $row['CourseName'],
                                 $row['LeadInstructorId']);
            array_push($courses, $course);
        }
        return $courses;
    }

    public static function GetOpenQuestions($STUDENT)
    {
        $db = Database::getDB();

        $query = 'SELECT * FROM Question
							JOIN Student ON Question.UserID = Student.UserID
				  		WHERE Student.UserID = :id
							AND (Question.Status = "Open" OR Question.Status = "Processing")';

        $statement = $db->prepare($query);
        $statement->bindValue(":id", $STUDENT->getUserID());
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();

        $questions = array();

        if ($rows != false) {
            foreach ($rows as $row) {
                $question = new Question($row['UserID'],
                                         $row['CourseNumber'],
                                         $row['Subject'],
                                         $row['Description'],
                                         $row['Status'],
                                         $row['AskTime'],
                                         $row['QuestionID']);

                if ($row != false) {
                    array_push($questions, $question);
                }
            }

            return $questions;
        } else {
            return null;
        }
    }

    public static function CreateStudent($STUDENT)
    {
        $db = Database::getDB();

        $firstName = $STUDENT->getFirstName();
        $lastName = $STUDENT->getLastName();
        $lnum = $STUDENT->getLNumber();
        $pass = $STUDENT->getPassword();
        $email = $STUDENT->getEmail();
        $majorID = $STUDENT->getMajorID();

        $query1 = 'INSERT INTO AppUser(FirstName, LastName, LNumber, Password, EmailAddress)
							     VALUES (:firstName, :lastName, :lnum, :pass, :email)';

        $statement = $db->prepare($query1);
        $statement->bindValue(':firstName', $firstName);
        $statement->bindValue(':lastName', $lastName);
        $statement->bindValue(':lnum', $lnum);
        $statement->bindValue(':pass', $pass);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $statement->closeCursor();

        $query2 = 'SELECT UserID
							     FROM AppUser
							     WHERE LNumber = :username';

        $statement = $db->prepare($query2);
        $statement->bindValue(':username', $lnum);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();

        if ($row != false) {
            $ID = $row['UserID'];


          $query3 = 'INSERT INTO Student(MajorId, UserId)
  							 VALUES(:majorid, :userid)';

          $statement = $db->prepare($query3);
          $statement->bindValue(':majorid', $majorID);
          $statement->bindValue(':userid', $ID);
          $statement->execute();
          $statement->closeCursor();
        }
    }

    public static function RetrieveStudentByID($STUDENTID)
    {
        $query = 'SELECT *
				FROM AppUser
				JOIN Student
				ON AppUser.UserID = Student.UserID
				WHERE AppUser.UserID = :userid';

        $db = Database::getDB();

        $statement = $db->prepare($query);
        $statement->bindValue(':userid', $STUDENTID);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();

        if ($row != false) {
            $user = new Student($row['FirstName'],
                                                    $row['LastName'],
                                                    $row['LNumber'],
                                                    $row['Password'],
                                                    $row['EmailAddress'],
                                                    $row['MajorId'],
                                                    $row['UserID']);
            return $user;
        } else {
            return null;
        }
    }

    public static function UpdateStudent($STUDENT)
    {
        $db = Database::getDB();

        $firstName = $STUDENT->getFirstName();
        $lastName = $STUDENT->getLastName();
        $lnum = $STUDENT->getLNumber();
        $pass = $STUDENT->getPassword();
        $email = $STUDENT->getEmail();
        $majorID = $STUDENT->getMajorID();
        $userID = $STUDENT->getUserID();

        $query = 'UPDATE AppUser
							SET FirstName = :firstname, LastName = :lastname, LNumber = :lnum, Password = :pass, EmailAddress = :email
							WHERE UserID = :userID;

				 			UPDATE Student
						  SET MajorId = :majorid
							WHERE UserID = :userid';

        $statement = $db->prepare($query);
        $statement->bindValue(':firstname', $firstName);
        $statement->bindValue(':lastname', $lastName);
        $statement->bindValue(':lnum', $lnum);
        $statement->bindValue(':pass', $pass);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':majorid', $majorID);
        $statement->bindValue(':userid', $userID);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function UpdateProfile($USER)
    {
        $db = Database::getDB();

        $email = $USER->getEmail();
        $pass = $USER->getPassword();
        $userID = $USER->getUserID();

        $query = 'UPDATE AppUser
					SET Password = :pass, EmailAddress = :email
					WHERE UserID = :userid';

        $statement = $db->prepare($query);
        $statement->bindValue(':pass', $pass);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':userid', $userID);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function DeleteStudent($STUDENT)
    {
        $db = Database::getDB();
        $userID = $STUDENT->getUserID();

        $query = 'DELETE FROM Student
							WHERE UserId = :userid;

							DELETE FROM AppUser
							WHERE UserId = :userid;';

        $statement = $db->prepare($query);
        $statement->bindValue(':userid', $userID);
        $statement->execute();
        $statement->closeCursor();
    }
}
