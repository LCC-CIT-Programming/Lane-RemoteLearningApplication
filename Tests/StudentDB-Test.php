<?php
include_once('../Models/AppUser.php');
include_once('../Models/StudentDB.php');
include_once('../Models/db.php');
include_once('../Models/Student.php');

function canStudentLogin() {
  $user = StudentDB::StudentLogin('L00000005', 'Student1');
  if ($user->getFirstName() == 'Student1') {
    echo "<p style='color:green;'> Student Login was successful! </p>";
  } else {
    echo "<p style='color:red;'> Student Login not successful! </p>";
  }
}

canStudentLogin();
?>
