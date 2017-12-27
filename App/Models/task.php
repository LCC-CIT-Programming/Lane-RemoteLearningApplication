<?php
class Task
{
    protected $visitID;
    protected $courseNumber;
    protected $startTime;
    protected $endTime;
    protected $taskID;
    protected $taskTypeID;

    public function __construct($VISITID, $COURSENUMBER, $TASKTYPEID, $STARTTIME, $TASKID = null, $ENDTIME = null)
    {
        $this->visitID = $VISITID;
        $this->courseNumber = $COURSENUMBER;
        $this->taskID = $TASKID;
        $this->startTime = $STARTTIME;
        $this->endTime = $ENDTIME;
        $this->taskTypeID = $TASKTYPEID;
    }

    public function getVisitID()
    {
        return $this->visitID;
    }

    public function getCourseNumber()
    {
        return $this->courseNumber;
    }
    
    function setCourseNumber($VALUE)
    {
        $this->tcourseNumber = $VALUE;
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
     
    function getTaskTypeID()
    {
        return $this->taskTypeID;
    }

    public function setTaskTypeID($VALUE)
    {
        $this->taskTypeID = $VALUE;
    }

    public function getEndTime()
    {
        return $this->endTime;
    }

    public function setEndTime($VALUE)
    {
        $this->endTime = $VALUE;
    }

    public static function ChangeTask($COURSENUMBER, $TASKTYPEID, $VISIT, $TASK) 
    {
        $currentCourse = $TASK->getCourseNumber();
        $currentVisit = $VISIT->getVisitID();
        $currentTaskType = $TASK->getTaskTypeID();
        $currentStartTime = $TASK->getStartTime();

        // ----------- CHECK TASK -----------  //
        if ($COURSENUMBER != $currentCourse || $TASKTYPEID != $currentTaskType) 
        {
        	// TODO: if the time is big enough, end this task and start a new one
        	if ($currentStartTime - date("Y-m-d h:i:s") > 60) {
            // ----------- END OLD TASK -----------  //
            	$TASK->setEndTime(date("Y-m-d h:i:s"));
            	TaskDB::EndTask($TASK);

            // ----------- CREATE NEW TASK -----------  //
            	$newTask = new Task($currentVisit, $COURSENUMBER, $TASKTYPEID, date("Y-m-d h:i:s"));
            	TaskDB::CreateTask($newTask);
            	$TASK = TaskDB::RetrieveTask($newTask);
            }
            // otherwise assume they've just change their mind about the task that they want to work on
            else {
                $TASK->setCourseNumber($COURSENUMBER);
                $TASK->setTaskTypeId($TASKTYPEID);            
               	TaskDB::UpdateTaskContent($TASK);
            }
        }
        return $TASK;
    }

}
