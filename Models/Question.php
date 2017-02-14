<?php
class Question {
    private $userID, $courseNumber, $questionId, $subject, $description, $status, $askTime, $openTime, $closeTime;

    public function __construct($questionId, $userid, $courseNumber, $subject, $description, $status, $askTime, $openTime = NULL, $closeTime = NULL) {
		$this->userId = $userid;
		$this->courseNumber = $courseNumber;
	  $this->subject= $subject;
    $this->description = $description;
    $this->status = $status;
    $this->askTime = $askTime;
		$this->askTime = $askTime;
		$this->openTime = $openTime;
		$this->closeTime = $closeTime;
		$this->questionId = $questionId;
    }

	public function getUserId(){
		return $this->userId;
	}


	public function getCourseNumber(){
		return $this->courseNumber;
	}


    public function getSubject() {
        return $this->subject;
    }



    public function getQuestionID() {
        return $this->questionId;
    }



    public function getDescription() {
        return $this->description;
    }


    public function getStatus() {
        return $this->status;
    }

    public function setStatus($value) {
        $this->status = $value;
    }

	public function getAskTime() {
        return $this->askTime;
    }

    public function setAskTime($value) {
        $this->askTime = $value;
    }

	public function getOpenTime() {
        return $this->openTime;
    }

    public function setOpenTime($value) {
        $this->openTime = $value;
    }

	public function getCloseTime() {
        return $this->closeTime;
    }

    public function setCloseTime($value) {
        $this->closeTime = $value;
    }
}
   ?>
