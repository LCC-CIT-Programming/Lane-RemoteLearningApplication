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
require_once('/Models/task.php');
require_once('/Models/taskdb.php');
try {
session_start();
if (isset($_SESSION['user']))
		$user = $_SESSION['user'];
if (isset($_SESSION['courses']))
		$courses = $_SESSION['courses'];
if (isset($_SESSION['visit']))
		$visit = $_SESSION['visit'];
if (isset($_SESSION['task']))
		$task = $_SESSION['task'];
if (isset($_SESSION['role']))
		$role = $_SESSION['role'];
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
			$_SESSION['role']= $role;
			if ($role == "student") {
					$user = StudentDB::StudentLogin($username, $password);
					if ($user !== null && isset($user)) {
						  $courses = StudentDB::GetStudentCourses($user);
							$_SESSION['user'] = $user;
							$_SESSION['courses'] = $courses;
							$visit = new Visit($user->GetUserID(), 1, date("Y-m-d h:i:s"));
							VisitDB::CreateVisit($visit);
							$visit = VisitDB::RetrieveVisit($visit);
							$_SESSION['visit'] = $visit;
							$task = new Task($visit->getVisitID(), $courses[0]->getCourseNumber(),date("Y-m-d h:i:s"));
							TaskDB::CreateTask($task);
							$task = TaskDB::RetrieveTask($task);
							$_SESSION['task'] = $task;
							include("./Views/home.php");
					} else {
							$_SESSION['user'] = null;
							$loginError = "Login attempt failed.";
							include("./Views/login.php");
					}
				}
				else if ($role == "tutor"){
						$user = TutorDB::TutorLogin($username, $password);
						if ($user !== null && isset($user)) {
								$userID = $user->GetUserID();
								$startTime = date("Y-m-d h:i:s");
								$locationID = 1;
								$visit = new Visit($userID, $locationID, $startTime);
								$_SESSION['visit'] = $visit;
								$_SESSION['user'] = $user;
								VisitDB::CreateVisit($visit);
								include("./Views/home.php");
								
					
				}
					else {
							$_SESSION['user'] = null;
							$loginError = "Login attempt failed.";
							include("./Views/login.php");
					}
				}
				else
				{
					include("./Views/home.php");
				}
			
	break;
	case "ask":
	if ($role == 'student')
	{
		$questionError = "";
		$success = "";
		include("./Views/ask.php");
	}
	else
		include("./Views/home.php");
		
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
			$task = $_SESSION['task'];
			$task->setEndTime(date("Y-m-d h:i:s"));
			taskdb::UpdateTask($task);
			$startNewTask = new Task($visit->getVisitID(), $courseNum ,date("Y-m-d h:i:s"));
			TaskDB::CreateTask($startNewTask);
			$task = TaskDB::RetrieveTask($startNewTask);
			$_SESSION['task'] = $task;
			include("./Views/ask.php");
		}
	break;
	case "update_task":
	$courseNumber = filter_input(INPUT_POST, "courseNumber");
	
	$task->setEndTime(date("Y-m-d h:i:s"));
	TaskDB::UpdateTask($task);
	
	$newTask = new Task($visit->getVisitID(), $courseNumber, date("Y-m-d h:i:s"));
	TaskDB::CreateTask($newTask);
	$task = TaskDB::RetrieveTask($newTask);
	$_SESSION['task'] = $task;
	
	break;
	case "update_location" :
	$location = filter_input(INPUT_POST, "locationID");
	$visit->setLocationID($location);
	VisitDB::UpdateVisit($visit);
	echo $visit->getLocationID();
	echo $visit->getVisitID();
	break;
	case "logout":
			$_SESSION['user'] = null;
			$loginError = "";
			session_unset();
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
	case "edit":
		$success = "";
		$passError = "";
		include("./Views/edit.php");
	break;
	
	case "edit_profile":
		$success = "";
		$passError = "";
		$email = filter_input(INPUT_POST, "email");
		$pass1 = filter_input(INPUT_POST, "newPwd1");
		$pass2 = filter_input(INPUT_POST, "newPwd2");
		if ($pass1 != $pass2){	
			$passError = "Sorry the passwords do not match, please try again.";
			$success = "";
			include("./Views/edit.php");
		}
		else{
			$user = $_SESSION['user'];
			$userID = $user->GetUserID();
			$user->setEmail($email);
			$user->setPassword($pass1);
			
			StudentDB::UpdateProfile($user);
			$success = "Changes have been saved.";
			include("./Views/edit.php");
		}	
	break;
		
	case "edit_TutProfile":
		$success = "";
		$passError = "";
		$email = filter_input(INPUT_POST, "email");
		$pass1 = filter_input(INPUT_POST, "newPwd1");
		$pass2 = filter_input(INPUT_POST, "newPwd2");
		$summary = filter_input(INPUT_POST, "summary");
		if ($pass1 != $pass2){	
			$passError = "Sorry the passwords do not match, please try again.";
			$success = "";
			include("./Views/tutorEdit.php");
		}
		else{
			$user = $_SESSION['user'];
			$userID = $user->GetUserID();
			$user->setEmail($email);
			$user->setPassword($pass1);
			$user->setTutorBio($summary);
			
			TutorDB::UpdateProfile($user);
			$success = "Changes have been saved.";
			include("./Views/tutorEdit.php");
		}	
	break;
	
	case "edit_Schedule":
		include("./Views/tutorSchedule.php");
	break;
	}
} catch(PDOException $e) {
		$error_message = $e->getMessage();
		include('./Errors/database_error.php');
		exit();
}
 ?>