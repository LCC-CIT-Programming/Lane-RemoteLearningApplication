<?php
require_once('/Models/appUser.php');
require_once('/Models/student.php');
require_once('/Models/studentDB.php');
require_once('/Models/db.php');
require_once('/Models/course.php');
require_once('/Models/courseDB.php');
require_once('/Models/question.php');
require_once('/Models/questionDB.php');
require_once('/Models/tutor.php');
require_once('/Models/tutorDB.php');

try {
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
	$action = filter_input(INPUT_GET, 'action');
	if ($action == NULL) {
		$action = 'default';
	}
}


switch($action) {
	case "default":
			$_SESSION['user'] = null;
			$loginError = "";
			include("Views/login.php");
	break;

	case "login":
			$username = filter_input(INPUT_POST, "lnumber");
			$password = filter_input(INPUT_POST, "password");
			$role = filter_input(INPUT_POST, "isTutor");

			if ($role == NULL) {
					$user = StudentDB::StudentLogin($username, $password);

					if ($user !== null && isset($user)) {
						  $courses = StudentDB::GetStudentCourses($user);
							$_SESSION['user'] = $user;
							$_SESSION['courses'] = $courses;

							include("/Views/home.php");
					} else {
							$_SESSION['user'] = null;
							$loginError = "Login attempt failed.";
							include("Views/login.php");
					}
			}
	break;
	case "ask":
		
		include("Views/ask.php");
	break;
	
	}
} catch(PDOException $e) {
		$error_message = $e->getMessage();
		include('../Errors/database_error.php');
		exit();
}


 ?>
