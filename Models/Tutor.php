<?php
class Tutor extends AppUser{

	private $TutorBio;
		
	public function __construct($userID, $firstName, $lastName, $lNumber, $pass, $email, $tutorBio){
		parent::__construct($userID, $firstName, $lastName, $lNumber, $pass, $email);
		$this->TutorBio = $tutorBio;
	}
	
	public function getTutorBio(){
		return $this->TutorBio;
	}
	
	public function setTutorBio($value){
		$this->TutorBio = $value;
	}	
}
?>