<?php
class Visit
{
    protected $visitID;
    protected $userID;
    protected $locationID;
    protected $startTime;
    protected $endTime;
	protected $lastPing;
    protected $role;

    public function __construct($USERID, $LOCATIONID, $ROLE, $VISITID = null, $STARTTIME = null, $ENDTIME = null, $LASTPING = null)
    {
        $this->visitID = $VISITID;
        $this->userID = $USERID;
        $this->locationID = $LOCATIONID;
        $this->role = $ROLE;
        $this->startTime = $STARTTIME;
        $this->endTime = $ENDTIME;
		$this->lastPing = $LASTPING;
    }

    public function getVisitID()
    {
        return $this->visitID;
    }

    public function getUserID()
    {
        return $this->userID;
    }

    public function getLocationID()
    {
        return $this->locationID;
    }

    public function setLocationID($VALUE)
    {
        $this->locationID = $VALUE;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getStartTime()
    {
        return $this->startTime;
    }

    public function getEndTime()
    {
        return $this->endTime;
    }
	
	public function getLastPing()
    {
        return $this->lastPing;
    }
	
	public function setLastPing($VALUE)
    {
        $this->lastPing =$VALUE;
    }
	
    public function setEndTime($VALUE)
    {
        $this->endTime = $VALUE;
    }
	
}
