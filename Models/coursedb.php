<?php

class CourseDB
{
    public static function CreateCourse($COURSE)
    {
        $courseNumber = $COURSE->getCourseNumber();
        $courseName = $COURSE->getCourseName();
        $leadInstructorID = $COURSE->getLeadInstructor();

        $query = 'INSERT INTO course
              VALUES (:coursenum, :coursename, :leadinstructor)';

        $db = Database::getDB();

        $statement = $db->prepare($query);

        $statement->bindValue(":coursenum", $courseNumber);
        $statement->bindValue(":coursename", $courseName);
        $statement->bindValue(":leadinstructor", $leadInstructorID);

        $statement->execute();
        $statement->closeCursor();
    }


    public static function RetrieveCourse($COURSE)
    {
        $courseNumber = $COURSE->getCourseNumber();
        $courseName = $COURSE->getCourseName();
        $leadInstructorID = $COURSE->getLeadInstructor();

        $query = 'SELECT *
              FROM course
              WHERE CourseNumber = :coursenum
              AND CourseName = :coursename
              AND LeadInstructorID = :leadinstructor';

        $db = Database::getDB();

        $statement = $db->prepare($query);

        $statement->bindValue(":coursenum", $courseNumber);
        $statement->bindValue(":coursename", $courseName);
        $statement->bindValue(":leadinstructor", $leadInstructorID);

        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();

        if ($row != false) {
            $course = new Course($row['CourseNumber'],
                                               $row['CourseName'],
                                           $row['LeadInstructorId']);
            return $course;
        } else {
            return null;
        }
    }

    public static function RetrieveCourseByNumber($ID)
    {
        $query = 'SELECT *
							FROM course
              WHERE CourseNumber = :coursenum';

        $db = Database::getDB();

        $statement = $db->prepare($query);
        $statement->bindValue(':coursenum', $ID);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();

        if ($row != false) {
            $course = new Course($row['CourseNumber'],
                                                         $row['CourseName'],
                                                         $row['LeadInstructorId']);

            return $course;
        } else {
            return null;
        }
    }


    public static function UpdateCourseByNumber($COURSE)
    {
        $courseNumber = $COURSE->getCourseNumber();
        $courseName = $COURSE->getCourseName();
        $leadInstructorID = $COURSE->getLeadInstructor();

        $query = 'UPDATE course
              SET CourseName = :coursename, LeadInstructorId = :leadinstructor
              WHERE CourseNumber = :coursenum';

        $db = Database::getDB();

        $statement = $db->prepare($query);
        $statement->bindValue(':coursenum', $courseNumber);
        $statement->bindValue(':coursename', $courseName);
        $statement->bindValue(':leadinstructor', $leadInstructorID);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function UpdateCourseByName($COURSE)
    {
        $courseNumber = $COURSE->getCourseNumber();
        $courseName = $COURSE->getCourseName();
        $leadInstructorID = $COURSE->getLeadInstructor();

        $query = 'UPDATE course
              SET CourseNumber = :coursenum, LeadInstructorId = :leadinstructor
              WHERE CourseName = :coursename';

        $db = Database::getDB();

        $statement = $db->prepare($query);

        $statement->bindValue(':coursenum', $courseNumber);
        $statement->bindValue(':coursename', $courseName);
        $statement->bindValue(':leadinstructor', $leadInstructorID);
        $statement->execute();
        $statement->closeCursor();
    }


    public static function DeleteCourse($COURSE)
    {
        $courseNumber = $COURSE->getCourseNumber();
        $courseName = $COURSE->getCourseName();
        $leadInstructorID = $COURSE->getLeadInstructor();

        $query = 'DELETE FROM course
              WHERE CourseNumber = :coursenum
              AND LeadInstructorId = :leadinstructor
              AND CourseName = :coursename';

        $db = Database::getDB();

        $statement = $db->prepare($query);
        $statement->bindValue(':coursenum', $courseNumber);
        $statement->bindValue(':coursename', $courseName);
        $statement->bindValue(':leadinstructor', $leadInstructorID);
        $statement->execute();
        $statement->closeCursor();
    }
}
