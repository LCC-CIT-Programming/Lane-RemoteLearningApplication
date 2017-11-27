<?php
include_once('../Models/appuser.php');
include_once('../Models/tutordb.php');
include_once('../Models/db.php');
include_once('../Models/tutor.php');

function canTutorLogin()
{
    $user = TutorDB::TutorLogin('L00000003', 'AppUser3');
    if ($user->getFirstName() == 'Tutor1') {
        echo "<p style='color:green;'> Tutor Login was successful! </p>";
    } else {
        echo "<p style='color:red;'> Tutor Login was not successful! </p>";
    }
}

function canGetAllTutors()
{
    $tutors = array();
    $tutors = TutorDB::GetAllTutors();

    $numTutors = count($tutors);
    if ($numTutors == 2) {
        echo "<p style='color:green;'>Getting all tutors was successful! </p>";
    } else {
        echo "<p style='color:red;'>Getting all tutors was not successful! </p>";
    }
}

function canCreateTutor()
{
    $db = Database::getDB();
    $tutor = new Tutor('testcreatetutor', 'user', 'L00111111', 'testpassword', 'email@email.com', 'my bio');
    TutorDB::CreateTutor($tutor);
    $createdTutor = TutorDB::TutorLogin('L00111111', 'testpassword');

    if ($createdTutor->getFirstName() == 'testcreatetutor') {
        echo "<p style='color:green;'> Creating Tutor successful! </p>";
    } else {
        echo "<p style='color:red;'>  not successful! </p>";
    }
}

function canDeleteTutor()
{
    $db = Database::getDB();
    $tutor = TutorDB::TutorLogin('L00111111', 'testpassword');
    TutorDB::DeleteTutor($tutor);
    $deletedTutor = TutorDB::TutorLogin('L00111111', 'testpassword');

    if ($deletedTutor == null) {
        echo "<p style='color:green;'>Deleting a tutor was successful! </p>";
    } else {
        echo "<p style='color:red;'>Deleting a tutor was not successful! </p>";
    }
}

canTutorLogin();
canGetAllTutors();
canCreateTutor();
canDeleteTutor();
