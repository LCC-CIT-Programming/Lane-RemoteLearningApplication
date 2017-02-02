<?php
try {
require_once('/Models/AppUser.php');
require_once('/Models/Student.php');
require_once('/Models/StudentDB.php');
require_once('/Models/db.php');


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
	$action = filter_input(INPUT_GET, 'action');
	if ($action == NULL) {
		$action = 'default';
	}
}


switch($action) {
		case "default":
				$loginError = "";
				include("Views/Login.php");
	  break;

		case "login":
				$username = filter_input(INPUT_POST, "lnumber");
				$password = filter_input(INPUT_POST, "password");
				$role = filter_input(INPUT_POST, "isTutor");

				if ($role == NULL) {
						//$testStudent = new Student(1, 'test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);
						$user = StudentDB::StudentLogin($username, $password);

						if ($user !== null && isset($user)) {
								$_SESSION['user'] = $user;
								//$tutors = array();
								//$questions = array();
								include("/Views/Home.php");
						} else {
								$_SESSION['user'] = null;
								$loginError = "Login attempt failed.";
								include("Views/Login.php");
						}


				//$_SESSION['user'] = $student;
				//$visit = new Visit($student->getStudentID(), 1);
				//$visit->setStartTime(date("Y-m-d h:i:s"));
			  //$_SESSION['currentVisit'] = $visit;
				//$courses = StudentDB::GetStudentCourses($student);


				//save visit in database


		}
		break;
	}
} catch(Exception $e) {

	}

 ?>
