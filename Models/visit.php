<?php
class Visit {
    protected $visitID, $userID, $locationID, $startTime, $endTime;

    public function __construct($VISITID, $USERID, $LOCATIONID, $STARTTIME, $ENDTIME = null) {
        $this->visitID = $VISITID;
        $this->userID = $USERID;
        $this->locationID = $LOCATIONID;
		    $this->startTime = $STARTTIME;
		    $this->endTime = $ENDTIME;
    }

    public function getVisitID() {
        return $this->visitID;
    }

    public function getUserID() {
        return $this->userID;
    }

    public function getLocationID() {
        return $this->locationID;
    }

    public function setLocationID($VALUE) {
      $this->locationID = $VALUE;
    }

    public function getStartTime() {
        return $this->startTime;
    }

    public function getEndTime() {
        return $this->endTime;
    }

    public function setEndTime($VALUE) {
        $this->endTime = $VALUE;
    }

}
?>
