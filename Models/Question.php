<?php
class Question {
    private $studentId, $courseId, $questionId, $subject, $description, $status, $askTime, $openTime, $closeTime;

    public function __construct($questionId, $studentId, $courseId, $subject, $description, $status, $askTime, $openTime = NULL, $closeTime = NULL) {
		$this->studentId = $studentId;
		$this->courseId = $courseId;
	  $this->subject= $subject;
    $this->description = $description;
    $this->status = $status;
    $this->askTime = $askTime;
		$this->askTime = $askTime;
		$this->openTime = $openTime;
		$this->closeTime = $closeTime;
		$this->questionId = $questionId;
    }

	public function getStudentID(){
		return $this->studentId;
	}


	public function getCourseID(){
		return $this->courseId;
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
