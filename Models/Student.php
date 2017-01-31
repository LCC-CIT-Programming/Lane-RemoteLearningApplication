<?php
include_once('../Models/AppUser.php');

class Student extends AppUser {
    private $MajorID;

    public function __construct($userID, $firstName, $lastName, $lNumber, $pass, $email, $majorID) {
        parent::__construct($userID, $firstName, $lastName, $lNumber, $pass, $email);
		    $this->MajorID = $majorID;
    }

    public function getMajorID() {
        return $this->MajorID;
    }

    public function setMajorID($value) {
        $this->MajorID = $value;
    }

}
?>
