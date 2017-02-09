<?php
include_once('../Models/db.php');
include_once('../Models/Appuser.php');
//include_once('../Models/Student.php');
//include_once('../Models/StudentDB.php');
include_once('../Models/Tutor.php');
include_once('../Models/TutorDB.php');

/*function canInsertTutor($tutor){
	$db = Database::getDB();
	
	//TutorDB::DeleteTutor($tutor);
	TutorDB::CreateTutor($tutor);
	
	if ($tutor->getFirstName() == 'Rkanga'){
		echo "<p style='color:green;'> Creating tutor successful! </p>";
	  }
	  else {
		echo "<p style='color:red;'>  not successful! </p>";
	  }
	
}*/


/*function canGetTutors(){
	$db = Database::getDB();
	
	$tutors = TutorDB::GetAllTutors();
	
	if ($tutors[2]->getFirstName() == 'Rkanga'){
		echo "<p style='color:green;'> Creating tutor successful! </p>";
	  }
	  else {
		echo "<p style='color:red;'>  not successful! </p>";
	  }
	
}*/

function deleteTutor($tutor){
	$db = Database::getDB();
	
	TutorDB::DeleteTutor($tutor);
}

$tutor = new Tutor(21, 'Rkanga', 'Roo', 'L00000011' , 'test', 'tutor1@lcc.edu', 'I am a tutor kanga roo, skilled in grub hunting');

//canInsertTutor($tutor);
deleteTutor($tutor);

?>