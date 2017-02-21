<?php
class Question {
    private $userID, $courseNumber, $questionID, $subject, $description, $status, $askTime, $openTime, $closeTime;

    public function __construct($USERID, $COURSENUMBER, $SUBJECT, $DESCRIPTION, $STATUS, $ASKTIME, $QUESTIONID = NULL, $OPENTIME = NULL, $CLOSETIME = NULL) {
		$this->userId = $USERID;
		$this->courseNumber = $COURSENUMBER;
	  $this->subject= $SUBJECT;
    $this->description = $DESCRIPTION;
    $this->status = $STATUS;
    $this->askTime = $ASKTIME;
		$this->openTime = $OPENTIME;
		$this->closeTime = $CLOSETIME;
		$this->questionID = $QUESTIONID;
    }

	public function getUserID(){
		return $this->userID;
	}


	public function getCourseNumber(){
		return $this->courseNumber;
	}


    public function getSubject() {
        return $this->subject;
    }



    public function getQuestionID() {
        return $this->questionID;
    }



    public function getDescription() {
        return $this->description;
    }


    public function getStatus() {
        return $this->status;
    }

    public function setStatus($VALUE) {
        $this->status = $VALUE;
    }

	public function getAskTime() {
        return $this->askTime;
    }


    public function setAskTime($VALUE) {
        $this->askTime = $VALUE;
    }

	public function getOpenTime() {
        return $this->openTime;
    }


    public function setOpenTime($VALUE) {
        $this->openTime = $VALUE;
    }

	public function getCloseTime() {
        return $this->closeTime;
    }

    public function setCloseTime($VALUE) {
        $this->closeTime = $VALUE;
    }
}

?>
