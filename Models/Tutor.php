<?php
class Tutor extends AppUser{

	private $tutorBio;
		
	public function __construct($USERID, $FIRSTNAME, $LASTNAME, $LNUMBER, $PASS, $EMAIL, $TUTORBIO){
		parent::__construct($userID, $firstName, $lastName, $lNumber, $pass, $email);
		$this->tutorBio = $TUTORBIO;
	}
	
	public function getTutorBio(){
		return $this->tutorBio;
	}
	
	public function setTutorBio($VALUE){
		$this->tutorBio = $VALUE;
	}	
}
?>