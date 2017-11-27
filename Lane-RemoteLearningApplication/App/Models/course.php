
<?php
class Course
{
    protected $courseNumber;
    protected $courseName;
    protected $leadInstructorID;


    public function __construct($COURSENUMBER, $COURSENAME, $LEADINSTRUCTORID)
    {
        $this->courseNumber = $COURSENUMBER;
        $this->courseName = $COURSENAME;
        $this->leadInstructorID = $LEADINSTRUCTORID;
    }

    public function getCourseNumber()
    {
        return $this->courseNumber;
    }


    public function setCourseNumber($VALUE)
    {
        $this->courseNumber = $VALUE;
    }

    public function getCourseName()
    {
        return $this->courseName;
    }


    public function setCourseName($VALUE)
    {
        $this->courseName = $VALUE;
    }

    public function getLeadInstructor()
    {
        return $this->leadInstructorID;
    }


    public function setLeadInstructor($VALUE)
    {
        $this->leadInstructorID = $VALUE;
    }
}
?>
