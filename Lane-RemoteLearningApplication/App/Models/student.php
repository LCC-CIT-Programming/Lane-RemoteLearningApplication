<?php
class Student extends AppUser
{
    private $majorID;

    public function __construct($FIRSTNAME, $LASTNAME, $LNUMBER, $PASS, $EMAIL, $MAJORID, $USERID = null)
    {
        parent::__construct($FIRSTNAME, $LASTNAME, $LNUMBER, $PASS, $EMAIL, $USERID);
        $this->majorID = $MAJORID;
    }

    public function getMajorID()
    {
        return $this->majorID;
    }

    public function setMajorID($VALUE)
    {
        $this->majorID = $VALUE;
    }
}
