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
session_start();

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
			include("./Views/login.php");
	break;

	case "login":
			$username = filter_input(INPUT_POST, "lnumber");
			$password = filter_input(INPUT_POST, "password");
			$role = filter_input(INPUT_POST, "roleSelect");

			if ($role == "isStudent") {
					$user = StudentDB::StudentLogin($username, $password);

					if ($user !== null && isset($user)) {
						  $courses = StudentDB::GetStudentCourses($user);
							$_SESSION['user'] = $user;
							$_SESSION['courses'] = $courses;
							$visit = new Visit($user->GetUserID(), 1, date("Y-m-d h:i:s"));
							VisitDB::CreateVisit($visit);

							include("/Views/home.php");

					} else {
							$_SESSION['user'] = null;
							$loginError = "Login attempt failed.";
							include("./Views/login.php");
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
			else {
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
	case "ask":
		$questionError = "";
		$success = "";
		include("./Views/ask.php");
	break;
	
	case "ask_question":

		$courseNum = filter_input(INPUT_POST, "courseSelect");
		$subject = filter_input(INPUT_POST, "subject");	
		$description = filter_input(INPUT_POST, "description");
		$status = "open";
		$askTime = date("Y-m-d h:i:s");
		
		if ($courseNum == null || $subject == null || 
			$description == null || $status == null || $askTime == null){
				$questionError = "Invalid question. Check all fields and try again.";
			
				$success = "";
				include("./Views/ask.php");
				
			}
		else{
			$user = $_SESSION['user'];
			$userID = $user->GetUserID();
			$question = new Question($userID, $courseNum, $subject, $description, $status, $askTime);
			QuestionDB::CreateQuestion($question);
			
			$success = "Question created, ask another?";
			$questionError = "";
			include("./Views/ask.php");
			
		}
	break;
	
	case "logout":
			$_SESSION['user'] = null;
			$loginError = "";
			session_destroy();
			include("./Views/login.php");
	break;
	
	case "home":
		include("./Views/home.php");
	break;
	
	case "schedule":
		include("./Views/schedule.php");
	break;

	case "ask":
			include("/Views/ask.php");
	break;
    
	}
} catch(PDOException $e) {
		$error_message = $e->getMessage();
		include('./Errors/database_error.php');
		exit();
}
 ?>
