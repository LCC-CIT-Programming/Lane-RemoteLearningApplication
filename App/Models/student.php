<?php
class Student extends AppUser
{
    private $majorID;

    public function __construct($FIRSTNAME, $LASTNAME, $LNUMBER, $EMAIL, $BIO, $MAJORID, $USERID = null)
    {
        parent::__construct($FIRSTNAME, $LASTNAME, $LNUMBER, $EMAIL, $BIO, $USERID);
        $this->majorID = $MAJORID;
    }

    public function getMajorId()
    {
        return $this->majorID;
    }

    public function setMajorId($VALUE)
    {
        $this->majorID = $VALUE;
    }
}
