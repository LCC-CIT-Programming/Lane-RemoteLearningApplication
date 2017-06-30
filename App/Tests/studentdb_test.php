<?php
include_once('../Models/AppUser.php');
include_once('../Models/StudentDB.php');
include_once('../Models/db.php');
include_once('../Models/Student.php');
include_once('../Models/Course.php');
include_once('../Models/Question.php');

function canStudentLogin()
{
    $user = StudentDB::StudentLogin('L00000005', 'Student1');
    if ($user->getFirstName() == 'Student1') {
        echo "<p style='color:green;'> Student Login was successful! </p>";
    } else {
        echo "<p style='color:red;'> Student Login was not successful! </p>";
    }
}

function canGetCourses()
{
    $user = StudentDB::StudentLogin('L00000006', 'Student2');

    $courses = array();
    $courses = StudentDB::GetStudentCourses($user);
    $numCourses = count($courses);
    if ($numCourses == 2) {
        echo "<p style='color:green;'>Getting student courses was successful! </p>";
    } else {
        echo "<p style='color:red;'>Getting student courses was not successful! </p>";
    }
}

function canRetreiveStudentByID()
{
    $user = StudentDB::StudentLogin('L00000006', 'Student2');
    $retrieve = StudentDB::RetrieveStudentByID($user->getUserID());

    if ($retrieve != null) {
        echo "<p style='color:green;'>Getting student by id was successful! </p>";
    } else {
        echo "<p style='color:red;'>Getting student by id was not successful! </p>";
    }
}

function canCreateStudent()
{
    $student = new Student(1, 'test', 'user', 'L00111111', 'testpassword', 'email@email.com', 1);
    StudentDB::CreateStudent($student);

    $createdStudent = StudentDB::StudentLogin('L00111111', 'testpassword');

    if ($createdStudent != null) {
        echo "<p style='color:green;'>Creating a student was successful! </p>";
    } else {
        echo "<p style='color:red;'>Creating a student was not successful! </p>";
    }
}

function canUpdateStudent()
{
    $student = StudentDB::StudentLogin('L00111111', 'testpassword');
    $student->setPassword('newpassword');
    StudentDB::UpdateStudent($student);

    $updatedStudent = StudentDB::StudentLogin('L00111111', 'newpassword');
    if ($updatedStudent != null) {
        echo "<p style='color:green;'>Updating student was successful! </p>";
    } else {
        echo "<p style='color:red;'>Updating student was not successful! </p>";
    }
}

function canDeleteStudent()
{
    $student = StudentDB::StudentLogin('L00111111', 'newpassword');
    StudentDB::DeleteStudent($student);
    $deletedStudent = StudentDB::StudentLogin('L00111111', 'newpassword');

    if ($deletedStudent == null) {
        echo "<p style='color:green;'>Deleting a student was successful! </p>";
    } else {
        echo "<p style='color:red;'>Deleting a student was not successful! </p>";
    }
}

function canGetStudentOpenQuestions()
{
    $student = StudentDB::StudentLogin('L00000006', 'Student2');
    $questions = array();
    $questions = StudentDB::GetOpenQuestions($student);

    if (count($questions) == 1) {
        echo "<p style='color:green;'>Getting a student's open questions was successful! </p>";
    } else {
        echo "<p style='color:red;'>Getting a student's open questions was not successful! </p>";
    }
}


canStudentLogin();
canGetCourses();
canRetreiveStudentByID();
// canCreateStudent();
// canUpdateStudent();
// canDeleteStudent();
canGetStudentOpenQuestions();
