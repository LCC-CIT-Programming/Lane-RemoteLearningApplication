<?php
class Task
{
    protected $visitID;
    protected $courseNumber;
    protected $startTime;
    protected $endTime;
    protected $taskID;

    public function __construct($VISITID, $COURSENUMBER, $STARTTIME, $TASKID = null, $ENDTIME = null)
    {
        $this->visitID = $VISITID;
        $this->courseNumber = $COURSENUMBER;
        $this->taskID = $TASKID;
        $this->startTime = $STARTTIME;
        $this->endTime = $ENDTIME;
    }

    public function getVisitID()
    {
        return $this->visitID;
    }

    public function getCourseNumber()
    {
        return $this->courseNumber;
    }

    public function getStartTime()
    {
        return $this->startTime;
    }

    public function getTaskID()
    {
        return $this->taskID;
    }

    public function setTaskID($VALUE)
    {
        $this->taskID = $VALUE;
    }

    public function getEndTime()
    {
        return $this->endTime;
    }

    public function setEndTime($VALUE)
    {
        $this->endTime = $VALUE;
    }

    public static function ChangeTask($COURSENUMBER) 
    {
        // ----------- SESSION INFO -----------  //
        $visit = $_SESSESION['visit'];
        $task = $_SESSION['task'];

        $currentCourse = $task->getCourseNumber();
        $currentVisit = $visit->getVisitID();

        // ----------- TASK -----------  //
        if ($COURSENUMBER !== $currentCourse) 
        {
            // ----------- END OLD TASK -----------  //
            $task->setEndTime(date("Y-m-d h:i:s"));
            TaskDB::UpdateTask($task);

            // ----------- CREATE NEW TASK -----------  //
            $newTask = new Task($currentVisit, $COURSENUMBER, date("Y-m-d h:i:s"));
            TaskDB::CreateTask($newTask);
            $task = TaskDB::RetrieveTask($newTask);
            $_SESSION['task'] = $task;
        }
    }

}
