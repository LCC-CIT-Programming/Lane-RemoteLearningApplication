<?php

class StudentDB {
	public static function StudentLogin($username, $password) {

      $query = 'SELECT appuser.*, MajorId
                FROM `appuser`
                INNER JOIN student
                ON appuser.UserID = student.UserID
			          WHERE appuser.LNumber = :username
                AND appuser.Password = :password';


		//echo $query;

		$db = Database::getDB();

    $statement = $db->prepare($query);
    $statement->bindValue(":username", $username);
		$statement->bindValue(":password", $password);
    $statement->execute();
    $row = $statement->fetch();
    $statement->closeCursor();

    if ($row != false){
		    $user = new Student($row['UserID'],
									              $row['FirstName'],
              									$row['LastName'],
              									$row['LNumber'],
              									$row['Password'],
              									$row['EmailAddress'],
																$row['MajorId']);
			 return $user;
    	 } else {
    	        return null;
    	 }
    }

	public static function GetStudentCourses($student) {
	 $userid = $student->getUserID();

   $query = 'SELECT * FROM Course
						 JOIN Section ON Course.CourseNumber = Section.CourseNumber
						 JOIN StudentRegistration ON Section.SectionNumber = StudentRegistration.SectionNumber
						 JOIN Student ON StudentRegistration.UserID = Student.UserID
				     WHERE Student.UserID = :id';

		$db = Database::getDB();

	  $statement = $db->prepare($query);
	  $statement->bindValue(":id", $userid);
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


public static function GetOpenQuestions($student) {
		$db = Database::getDB();

		$query = 'SELECT * FROM Question
							JOIN Student ON Question.Student_StudentID = Student.StudentID
				  		WHERE Student.StudentID = :id
							AND (Question.Status = "Open" OR Question.Status = "Processing")';

    $statement = $db->prepare($query);
    $statement->bindValue(":id", $student->getUserID());
    $statement->execute();
		$rows = $statement->fetchAll();
    $statement->closeCursor();

		$questions = array();

		foreach ($rows as $row) {
        $question = new Question($row['QuestionID'],
							 									 $row['Student_StudentID'],
																 $row['Subject'],
																 $row['Description'],
																 $row['Status'],
																 $row['OpenTime']);

			if ($row['Status'] == 'Open' || $row['Status'] == 'Processing')
					array_push($questions, $question);

      }

    return $questions;
	}


public static function CreateStudent($student){
		$db = Database::getDB();

		$firstName = $student->getFirstName();
		$lastName = $student->getLastName();
		$lnum = $student->getLNumber();
		$pass = $student->getPassword();
		$email = $student->getEmail();
		$major = $student->getMajorID();
		//$userid = $student->getUserID();

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
			$id = $row['UserID'];
		}

		$query3 = 'INSERT INTO Student(MajorId, UserId)
							 VALUES(:major, :userid)';

		$statement = $db->prepare($query3);
		$statement->bindValue(':major', $major);
		$statement->bindValue(':userid', $id);
		$statement->execute();
		$statement->closeCursor();
}

public static function RetrieveStudentByID($studentid) {

	$query = 'SELECT *
						FROM AppUser
						JOIN Student
						ON AppUser.UserID = Student.UserID
						WHERE AppUser.UserID = :userid';

	$db = Database::getDB();

	$statement = $db->prepare($query);
	$statement->bindValue(':userid', $studentid);
	$statement->execute();
	$row = $statement->fetch();
	$statement->closeCursor();

	if ($row != false){
			$user = new Student($row['UserID'],
													$row['FirstName'],
													$row['LastName'],
													$row['LNumber'],
													$row['Password'],
													$row['EmailAddress'],
													$row['MajorId']);
	 		return $user;
 	} else {
		 return null;
  }
}

public static function UpdateStudent($student){
		$db = Database::getDB();

		$firstName = $student->getFirstName();
		$lastName = $student->getLastName();
		$lnum = $student->getLNumber();
		$pass = $student->getPassword();
		$email = $student->getEmail();
		$major = $student->getMajorID();
		$userid = $student->getUserID();

		$query = 'UPDATE AppUser
							SET FirstName = :firstName, LastName = :lastName, LNumber = :lnum, Password = :pass, EmailAddress = :email
							WHERE UserID = :userid;

				 			UPDATE Student
						  SET MajorId = :major
							WHERE UserID = :userid';

		$statement = $db->prepare($query);
		$statement->bindValue(':firstName', $firstName);
		$statement->bindValue(':lastName', $lastName);
		$statement->bindValue(':lnum', $lnum);
		$statement->bindValue(':pass', $pass);
		$statement->bindValue(':email', $email);
		$statement->bindValue(':major', $major);
		$statement->bindValue(':userid', $userid);
		$statement->execute();
		$statement->closeCursor();
	}

	public static function DeleteStudent($student){
		$db = Database::getDB();
		$userid = $student->getUserID();

		$query = 'DELETE FROM Student
							WHERE UserId = :userid;

							DELETE FROM AppUser
							WHERE UserId = :userid;';

		$statement = $db->prepare($query);
		$statement->bindValue(':userid', $userid);
		$statement->execute();
		$statement->closeCursor();
	}

}

?>
