<?php
class Resolution
{
    private $questionID;
    private $userID;
    private $resolution;

    public function __construct($QUESTIONID, $USERID, $RESOLUTION = null)
    {
        $this->questionID = $QUESTIONID;
        $this->userID = $USERID;
        $this->resolution= $RESOLUTION;
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
