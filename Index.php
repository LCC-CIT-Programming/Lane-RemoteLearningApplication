<?php
require_once('/Models/appuser.php');
require_once('/Models/student.php');
require_once('/Models/studentdb.php');
require_once('/Models/db.php');
require_once('/Models/course.php');
require_once('/Models/coursedb.php');
require_once('/Models/question.php');
require_once('/Models/questiondb.php');
require_once('/Models/tutor.php');
require_once('/Models/tutordb.php');
require_once('/Models/visit.php');
require_once('/Models/visitdb.php');

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
				} else {
						  $user = TutorDB::TutorLogin($username, $password);

						if ($user !== null && isset($user)) {
								$userID = $user->GetUserID();
								$startTime = date("Y-m-d h:i:s");
								$locationID = 1;
								$visit = new Visit($userID, $locationID, $startTime);
								$_SESSION['visit'] = $visit;
								$_SESSION['user'] = $user;
								VisitDB::CreateVisit($visit);
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
