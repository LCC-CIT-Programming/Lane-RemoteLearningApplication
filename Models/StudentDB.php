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
						 JOIN Student ON StudentRegistration.StudentId = Student.AppUserID
				     WHERE Student.StudentID = :id';

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


// PUT THIS IN QUESTION DB
// 	public static function GetOpenQuestions($student) {
// 		$db = Database::getDB();
//         $query = 'SELECT * FROM Question
// 					JOIN Student ON Question.Student_StudentID = Student.StudentID
// 				  WHERE Student.StudentID = :id AND
// 						(Question.Status = "Open" OR Question.Status = "Processing"');
//
//         $statement = $db->prepare($query);
//         $statement->bindValue(":id", $student->getUserID());
//         $statement->execute();
// 		$rows = $statement->fetchAll();
//         $statement->closeCursor();
//
// 		$questions = new Array();
//
// 		foreach ($rows as $row) {
//             $question = new Question($row['QuestionID'],
// 									 $row['Student_StudentID'],
// 									 $row['Subject'],
// 									 $row['Description'],
// 									 $row['Status'],
// 									 $row['OpenTime']);
//
// 			if ($row['Status'] == 'Open' || $row['Status'] == 'Processing')
// 				array_push($questions, $question);
//         }
//         return $questions;
// 	}
//
 }

?>
