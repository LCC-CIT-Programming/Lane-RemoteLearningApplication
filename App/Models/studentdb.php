<?php

class StudentDB
{
    public static function StudentLogin($USERNAME)
    {
        $query = 'SELECT AppUser.*, MajorId
                FROM `AppUser`
                INNER JOIN Student
                ON AppUser.UserID = Student.UserID
			          WHERE AppUser.LNumber = :username';

        $db = Database::getDB();
        $statement = $db->prepare($query);
        $statement->bindValue(":username", $USERNAME);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();
        if ($row != false) {
            $user = new Student($row['FirstName'],
                                $row['LastName'],
                                $row['LNumber'],
                                $row['EmailAddress'],
                                $row['AppUserBio'],                                
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
    
    public static function GetOnlineStudents()
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM onlinestudents';
        $statement = $db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();

        if (isset($rows)) {
            return $rows;
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
        $email = $STUDENT->getEmail();
        $majorID = $STUDENT->getMajorID();
        $bio = $STUDENT->getBio();

        $query1 = 'INSERT INTO AppUser(FirstName, LastName, LNumber, EmailAddress, AppUserBio)
							     VALUES (:firstName, :lastName, :lnum, :email, :bio)';

        $statement = $db->prepare($query1);
        $statement->bindValue(':firstName', $firstName);
        $statement->bindValue(':lastName', $lastName);
        $statement->bindValue(':lnum', $lnum);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':bio', $bio);
        if ($statement->execute())
        	$statement->closeCursor();
        else
        	throw new PDOException("Could not insert into AppUser in create student");

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
			if ($statement->execute())
				$statement->closeCursor();
			else
				throw new PDOException("Could not insert into Major in create student");
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
                                                    $row['EmailAddress'],
                                                    $row['AppUserBio'],
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
        $email = $STUDENT->getEmail();
        $majorID = $STUDENT->getMajorID();
        $userID = $STUDENT->getUserID();
        $bio = $STUDENT->getBio();
        
        $query1 = 
        	'UPDATE AppUser
				SET FirstName = :firstname, LastName = :lastname,  
				EmailAddress = :email, AppUserBio = :bio
				WHERE UserID = :userid';
		$query2 = 	
			'UPDATE Student
				SET MajorId = :majorid
				WHERE UserID = :userid';

        $statement = $db->prepare($query1);
        $statement->bindValue(':firstname', $firstName);
        $statement->bindValue(':lastname', $lastName);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':bio', $bio);
        $statement->bindValue(':userid', $userID);
		if ($statement->execute())
			$statement->closeCursor();
		else
			throw new PDOException("Could not update app user in update student");
        
        $statement = $db->prepare($query2);
        $statement->bindValue(':majorid', $majorID);
        $statement->bindValue(':userid', $userID);
        if ($statement->execute())
			$statement->closeCursor();
		else
			throw new PDOException("Could not update student in update student");
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
