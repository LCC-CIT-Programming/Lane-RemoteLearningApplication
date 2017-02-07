<?php
include_once('../Models/AppUser.php');
include_once('../Models/StudentDB.php');
include_once('../Models/db.php');
include_once('../Models/Student.php');
include_once('../Models/Course.php');

function canStudentLogin() {
  $user = StudentDB::StudentLogin('L00000005', 'Student1');
  if ($user->getFirstName() == 'Student1') {
    echo "<p style='color:green;'> Student Login was successful! </p>";
  } else {
    echo "<p style='color:red;'> Student Login was not successful! </p>";
  }
}

function canGetCourses() {
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

canStudentLogin();
canGetCourses();
?>
