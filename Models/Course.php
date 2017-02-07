
<?php
class Course {
    protected $courseNumber, $courseName, $leadInstructorID;

    public function __construct($CourseNumber, $CourseName, $LeadInstructorID) {
        $this->courseNumber = $CourseNumber;
        $this->courseName = $CourseName;
        $this->leadInstructorID = $LeadInstructorID;
    }

    public function getCourseNumber() {
        return $this->courseNumber;
    }

    public function setCourseNumber($value) {
       $this->courseNumber = $value;
    }

    public function getCourseName() {
        return $this->courseName;
    }

    public function setCourseName($value) {
       $this->courseName = $value;
    }

    public function getLeadInstructor() {
        return $this->leadInstructorID;
    }

    public function setLeadInstructor($value) {
       $this->leadInstructorID = $value;
    }
}
?>
