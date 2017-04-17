<?php
class Schedule
{
    private $userID;
    private $startTime;
    private $endTime;
    private $weekDay;
    public function __construct($USERID, $STARTTIME, $ENDTIME, $WEEKDAY, $SCHEDULEID = null)
    {
        $this->userID = $USERID;
        $this->startTime = $STARTTIME;
        $this->endTime = $ENDTIME;
        $this->weekDay = $WEEKDAY;
        $this->scheduleID = $SCHEDULEID;
    }
    public function getScheduleID()
    {
        return $this->scheduleID;
    }
    public function getUserID()
    {
        return $this->userID;
    }
    public function getStartTime()
    {
        return $this->startTime;
    }
    public function getEndTime()
    {
        return $this->endTime;
    }
    public function getWeekDay()
    {
        return $this->weekDay;
    }
    public function getStringWeekDay()
    {
        $days = array('', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
        return $days[$this->weekDay];
    }
}
