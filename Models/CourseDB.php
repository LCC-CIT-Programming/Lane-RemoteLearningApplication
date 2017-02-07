<?php

class CourseDB {
	public static function CreateCourse($course) {
    $CourseNumber = $course->getCourseNumber();
    $CourseName = $course->getCourseName();
    $LeadInstructorID = $course->getLeadInstructor();

    $query = 'INSERT INTO course
              VALUES (:coursenum, :coursename, :leadinstructor)';

		$db = Database::getDB();

    $statement = $db->prepare($query);
    $statement->bindValue(":coursenum", $CourseNumber);
		$statement->bindValue(":coursename", $CourseName);
    $statement->bindValue(":leadinstructor", $LeadInstructorID);
    $statement->execute();
    $statement->closeCursor();
  }

  public static function UpdateCourseByNumber($course) {
    $CourseNumber = $course->getCourseNumber();
    $CourseName = $course->getCourseName();
    $LeadInstructorID = $course->getLeadInstructor();

    $query = 'UPDATE course
              SET CourseName = :coursename, LeadInstructorId = :leadinstructor
              WHERE CourseNumber = :coursenum';

    $stmt = $db-prepare($query);
		$stmt->bindValue(':coursenum', $CourseNumber);
		$stmt->bindValue(':coursename', $CourseName);
		$stmt->bindValue(':leadinstructor', $LeadInstructorID);
		$stmt->execute();
		$stmt->closeCursor();
  }

  public static function UpdateCourseByName($course) {
    $CourseNumber = $course->getCourseNumber();
    $CourseName = $course->getCourseName();
    $LeadInstructorID = $course->getLeadInstructor();

    $query = 'UPDATE course
              SET CourseNumber = :coursenum, LeadInstructorId = :leadinstructor
              WHERE CourseName = :coursename';

    $stmt = $db-prepare($query);
    $stmt->bindValue(':coursenum', $CourseNumber);
    $stmt->bindValue(':coursename', $CourseName);
    $stmt->bindValue(':leadinstructor', $LeadInstructorID);
    $stmt->execute();
    $stmt->closeCursor();
  }

  public static function DeleteCourse($course) {
    $CourseNumber = $course->getCourseNumber();
    $CourseName = $course->getCourseName();
    $LeadInstructorID = $course->getLeadInstructor();

    $query = 'DELETE FROM course
              WHERE CourseNumber = :coursenum
              AND LeadInstructorId = :leadinstructor
              AND CourseName = :coursename';

    $stmt = $db-prepare($query);
    $stmt->bindValue(':coursenum', $CourseNumber);
    $stmt->bindValue(':coursename', $CourseName);
    $stmt->bindValue(':leadinstructor', $LeadInstructorID);
    $stmt->execute();
    $stmt->closeCursor();
  }

}
?>
