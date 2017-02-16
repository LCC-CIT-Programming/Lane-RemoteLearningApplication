<?php
require_once('/Models/AppUser.php');
require_once('/Models/Student.php');
require_once('/Models/StudentDB.php');
require_once('/Models/db.php');
require_once('/Models/Course.php');
require_once('/Models/CourseDB.php');
require_once('/Models/Question.php');
require_once('/Models/QuestionDB.php');
require_once('/Models/Tutor.php');
require_once('/Models/TutorDB.php');

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
			
			else
			{
				$user = TutorDB::TutorLogin($username, $password);
				if ($user !== null && isset($user))
				{
					$userId = $user->GetUserID();
					$visitId = 1;
					$startTime = date("Y-m-d h:i:s");
					$locationId = 1;
					$visit = new Visit($visitId, $userId, $locationId, $startTime);
					$_SESSION['visit'] = $visit;
					$_SESSION['user'] = $user;
					
				}
				
			}
	break;
	}
} catch(PDOException $e) {
		$error_message = $e->getMessage();
		include('../Errors/database_error.php');
		exit();
}


 ?>
