<?php
class Tutor extends AppUser
{
    private $tutorBio;

    public function __construct($FIRSTNAME, $LASTNAME, $LNUMBER, $PASS, $EMAIL, $TUTORBIO, $USERID = null)
    {
        parent::__construct($FIRSTNAME, $LASTNAME, $LNUMBER, $PASS, $EMAIL, $USERID);
        $this->tutorBio = $TUTORBIO;
    }

    public function getTutorBio()
    {
        return $this->tutorBio;
    }

    public function setTutorBio($VALUE)
    {
        $this->tutorBio = $VALUE;
    }
}
