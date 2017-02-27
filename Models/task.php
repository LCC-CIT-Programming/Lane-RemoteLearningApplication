<?php
class Task {
    protected $visitID, $courseNumber, $startTime, $endTime, $taskID;

    public function __construct($VISITID, $COURSENUMBER, $STARTTIME, $TASKID = NULL, $ENDTIME = NULL) {
        $this->visitID = $VISITID;
        $this->courseNumber = $COURSENUMBER;
        $this->taskID = $TASKID;
		    $this->startTime = $STARTTIME;
		    $this->endTime = $ENDTIME;
    }

    public function getVisitID() {
        return $this->visitID;
    }

    public function getCourseNumber() {
        return $this->courseNumber;
    }

    public function getStartTime() {
        return $this->startTime;
    }

    public function getTaskID() {
        return $this->taskID;
    }

    public function setTaskID($VALUE) {
      $this->taskID = $VALUE;
    }

    public function getEndTime() {
        return $this->endTime;
    }

    public function setEndTime($VALUE) {
        $this->endTime = $VALUE;
    }

}
?>
