<?php
class Instructor extends AppUser
{
    public function __construct($FIRSTNAME, $LASTNAME, $LNUMBER, $EMAIL, $BIO, $USERID = null)
    {
        parent::__construct($FIRSTNAME, $LASTNAME, $LNUMBER, $EMAIL, $BIO, $USERID);
    }

}
?>