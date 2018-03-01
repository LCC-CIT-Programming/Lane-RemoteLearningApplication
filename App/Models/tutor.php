<?php
class Tutor extends AppUser
{
    private $tutorBio;

    public function __construct($FIRSTNAME, $LASTNAME, $LNUMBER, $EMAIL, $BIO, $TUTORBIO, $USERID = null)
    {
        parent::__construct($FIRSTNAME, $LASTNAME, $LNUMBER, $EMAIL, $BIO, $USERID);
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
?>