<?php
include_once('../Models/AppUser.php');
include_once('../Models/TutorDB.php');
include_once('../Models/db.php');
include_once('../Models/Tutor.php');

function canTutorLogin() {
  $user = TutorDB::TutorLogin('L00000003', 'AppUser3');
  if ($user->getFirstName() == 'Tutor1') {
    echo "<p style='color:green;'> Tutor Login was successful! </p>";
  } else {
    echo "<p style='color:red;'> Tutor Login was not successful! </p>";
  }
}

function canGetAllTutors() {
  $tutors = array();
  $tutors = TutorDB::GetAllTutors();

  $numTutors = count($tutors);
  if ($numTutors == 2) {
    echo "<p style='color:green;'>Getting all tutors was successful! </p>";
  } else {
    echo "<p style='color:red;'>Getting all tutors was not successful! </p>";
  }
}

canTutorLogin();
canGetAllTutors();
?>
