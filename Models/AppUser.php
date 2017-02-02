
<?php
class AppUser {
    protected $userID, $firstName, $lastName, $lnumber, $pass, $email;

    public function __construct($userID, $firstName, $lastName, $lNumber, $pass, $email) {
        $this->userID = $userID;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
		    $this->lnumber = $lNumber;
		    $this->pass = $pass;
		    $this->email = $email;
    }

    public function getUserID() {
        return $this->userID;
    }

    // public function setUserID($value) {
    //     $this->userID = $value;
    // }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($value) {
        $this->firstName = $value;
    }

	public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($value) {
        $this->lastName = $value;
    }

	public function getLNumber() {
		return $this->lnumber;
	}

  // public function setLNumber($value) {
  //       $this->lnumber = $value;
  // }

	public function getPassword() {
		return $this->pass;
	}

	public function setPassword($value) {
		   $this->pass = $value;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($value) {
		   $this->email = $value;
	}

}
?>
