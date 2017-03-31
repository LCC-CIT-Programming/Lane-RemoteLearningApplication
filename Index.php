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
require_once('/Models/schedule.php');
require_once('/Models/scheduledb.php');

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
	if (isset($_SESSION['schedule']))
			$schedules = $_SESSION['schedule'];

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
				$_SESSION['role'] = $role;
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
						include("./Views/login.php");
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
				taskdb::CreateTask($startNewTask);
				$task = taskdb::RetrieveTask($startNewTask);
				$_SESSION['task'] = $task;
				include("./Views/ask.php");
			}
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

		case "delete_schedule":
			$id = filter_input(INPUT_POST, 'id');
			if(isset($id)) {
				$temp = new Schedule(1, date("Y-m-d H:i:s", time()), date("Y-m-d H:i:s", time()), 1, $id);
				$schedule = scheduledb::GetSchedule($temp);
				scheduledb::DeleteSchedule($schedule);
				$schedules = scheduledb::GetTutorSchedule($user);
				$_SESSION['schedule'] = $schedules;
				include("./Views/addTutorSchedule.php");
			}
		break;

		case "edit_schedule":
			if ($role == 'tutor') {

					$date = filter_input(INPUT_POST, "Day");
					$start = filter_input(INPUT_POST, "StartTime");
					$end = filter_input(INPUT_POST, "EndTime");

					if(isset($start) && isset($end)) {
						$startTime = date("Y-m-d H:i:s", strtotime($start));
						$endTime = date("Y-m-d H:i:s", strtotime($end));
						$weekDay = date('N', strtotime($date));

						$userID = $user->getUserID();

						$shift = new Schedule($userID, $startTime, $endTime, $weekDay);
						scheduledb::CreateSchedule($shift);
					}
			  $schedules = scheduledb::GetTutorSchedule($user);
				$_SESSION['schedule'] = $schedules;

				include("./Views/addTutorSchedule.php");
				break;
		  } else {
				include("./Views/Home.php");
			}

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
		}
	} catch(PDOException $e) {
			$error_message = $e->getMessage();
			include('./Errors/database_error.php');
			exit();
}
?>
