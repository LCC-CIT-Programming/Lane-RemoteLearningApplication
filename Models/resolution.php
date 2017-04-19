<?php
class Resolution
{
    private $questionID;
    private $userID;
    private $resoltion;

    public function __construct($USERID, $USERID, $SUBJECT)
    {
        $this->questionID = $QUESTIONID;
        $this->userID = $USERID;
        $this->subject= $SUBJECT;
    }

    public function getQuestionID()
    {
        return $this->questionID;
    }

    public function getUserID()
    {
        return $this->userID;
    }

    public function getResolution()
    {
        return $this->resolution;
    }

    public function setResolution($VALUE)
    {
        $this->resolution = $VALUE;
    }
}
