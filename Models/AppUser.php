
<?php
class AppUser
{
    protected $userID;
    protected $firstName;
    protected $lastName;
    protected $lnumber;
    protected $pass;
    protected $email;

    public function __construct($FIRSTNAME, $LASTNAME, $LNUMBER, $PASS, $EMAIL, $USERID = null)
    {
        $this->userID = $USERID;
        $this->firstName = $FIRSTNAME;
        $this->lastName = $LASTNAME;
        $this->lnumber = $LNUMBER;
        $this->pass = $PASS;
        $this->email = $EMAIL;
    }

    public function getUserID()
    {
        return $this->userID;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }


    public function setFirstName($VALUE)
    {
        $this->firstName = $VALUE;
    }

    public function getLastName()
    {
        return $this->lastName;
    }


    public function setLastName($VALUE)
    {
        $this->lastName = $VALUE;
    }

    public function getLNumber()
    {
        return $this->lnumber;
    }

    public function getPassword()
    {
        return $this->pass;
    }


    public function setPassword($VALUE)
    {
        $this->pass = $VALUE;
    }

    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($VALUE)
    {
        $this->email = $VALUE;
    }
}
?>
