<?php

$useCAS = false;
$doc_root = "";
$app_path = "";
$picture_path = "";

require_once('Utils/settimezone.php');
require_once('Utils/filepath.php');
require_once('Utils/uploadfiles.php');
require_once('Utils/usehttps.php');
require_once('Models/appuser.php');
require_once('Models/student.php');
require_once('Models/studentdb.php');
require_once('Models/db.php');
require_once('Models/course.php');
require_once('Models/coursedb.php');
require_once('Models/question.php');
require_once('Models/questiondb.php');
require_once('Models/tutor.php');
require_once('Models/tutordb.php');
require_once('Models/visit.php');
require_once('Models/visitdb.php');
require_once('Models/task.php');
require_once('Models/taskdb.php');
require_once('Models/schedule.php');
require_once('Models/scheduledb.php');
require_once('Models/resolution.php');
require_once('Models/resolutiondb.php');
require_once('Models/location.php');
require_once('Models/locationdb.php');
require_once('Models/tasktype.php');
require_once('Models/tasktypedb.php');
require_once('Models/major.php');
require_once('Models/majordb.php');

forceHttps(true);

try {

    session_start();
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    }
	else 
		$user = null;
    if (isset($_SESSION['courses'])) {
        $courses = $_SESSION['courses'];
    }
    if (isset($_SESSION['visit'])) {
        $visit = $_SESSION['visit'];
    }
    if (isset($_SESSION['task'])) {
        $task = $_SESSION['task'];
    }
    if (isset($_SESSION['role'])) {
        $role = $_SESSION['role'];
    }
    if (isset($_SESSION['locations'])) {
        $locations = $_SESSION['locations'];
    }
    else {
    	$locations = LocationDB::getLocations();
    	$_SESSION['locations'] = $locations;
    }
    if (isset($_SESSION['tasktypes'])) {
        $taskTypes = $_SESSION['tasktypes'];
    }
    else {
    	$taskTypes = TaskTypeDB::getTaskTypes();
    	$_SESSION['tasktypes'] = $taskTypes;
    }
    if (isset($_SESSION['majors'])) {
        $majors = $_SESSION['majors'];
    }
    else {
    	$majors = MajorDB::getMajors();
    	$_SESSION['majors'] = $majors;
    }

    $action = filter_input(INPUT_POST, 'action');
    if ($action == null) {
        $action = filter_input(INPUT_GET, 'action');
        if ($action == null) {
            $action = 'default';
        }
    }
    
	if ($user == null){
		if ($action != 'default' && $action != 'login')
		{
			$action = 'default';
		}
	}
		

    switch ($action) {

        // ----------- LOGIN [GET] -----------  //
        case "default":
                $_SESSION['user'] = null;
                $loginError = "";
                include("./Views/login.php");
        break;

        // ----------- LOGIN [POST] -----------  //
        case "login":
            $username = filter_input(INPUT_POST, "lnumber");
            $password = filter_input(INPUT_POST, "password");
            $role = filter_input(INPUT_POST, "roleSelect");
            if ($useCAS) {
            	//TODO:  Call Jacob's function here
            	$user = AppUser::login($username, $role);
            }
            else {
                $user = AppUser::login($username, $role);
            }
            
            $_SESSION['user'] = $user;

            // ----------- SUCCESSFUL LOGIN -----------  //
            if ($user !== null)
            {
                header('Location: index.php?action=home');
                die();
            }

            // -----------   FAILED LOGIN   -----------  //
            else {
                $loginError = "Login attempt failed.";
                include("./Views/login.php");
            }
        break;

        // ----------- ASK [GET] -----------  //
        case "ask":
            $questionStatus = "";
            include("./Views/ask.php");
        break;

        // ----------- ASK [POST] -----------  //
        case "ask_question":
            $courseNum = filter_input(INPUT_POST, "courseSelect");
            $subject = filter_input(INPUT_POST, "subject");
            $description = filter_input(INPUT_POST, "description");
            Question::AskQuestion($courseNum, $subject, $description);
        break;

        // ----------- TASK [AJAX/POST] -----------  //
        case "update_task":
            $courseNumber = filter_input(INPUT_POST, "courseNumber");
            $taskType = filter_input(INPUT_POST, "taskType");
            $currentTask = Task::ChangeTask($courseNumber, $taskType, $visit, $task);
            $_SESSION['task'] = $currentTask;
        break;

        // ----------- LOCATION [AJAX/POST] -----------  //
        case "update_location":
            $location = filter_input(INPUT_POST, "locationID");
            if ($visit->getVisitID() != $location) {
                $visit->setLocationID($location);
                VisitDB::UpdateVisit($visit);
            }
        break;

        // ----------- CANCEL QUESTION [AJAX/POST] -----------  //
        case "cancel_question":
            $id = filter_input(INPUT_POST, 'cancelQuestion');

            if (isset($id)) {
                $question = QuestionDB::GetQuestionByID($id);
                $question->CancelQuestion();
            }
        break;
        
        // ----------- STILL LOGGED IN [AJAX/GET] -----------  //
        case "still_logged_in":
            if (isset($visit)) {
                $visit->setLastPing(date("Y-m-d H:i:s", time()));
                visitdb::UpdateVisit($visit);
            }
        break;

        // ----------- LOGOUT [GET] -----------  //
        case "logout":
            if (isset($task) || isset($visit) || isset($role)) {
                if ($role == 'student') {
                    $task->setEndTime(date("Y-m-d H:i:s", time()));
                    taskdb::EndTask($task);
                }
                $visit->setEndTime(date("Y-m-d H:i:s", time()));
                visitdb::UpdateVisit($visit);
            }

            $loginError = "";
            session_unset();
            session_destroy();
            include("./Views/login.php");
        break;

        // ----------- HOME [GET] -----------  //
        case "home":
            include("./Views/home.php");
        break;

        // ----------- DISPLAY QUESTION [AJAX/POST] -----------  //
        case "display_questions":
            $questions = QuestionDB::getOpenQuestions();
            $questionTableData = array();

            foreach ($questions as $question) {
                $course = CourseDB::RetrieveCourseByNumber($question->getCourseNumber());
                $singleQuestion = array("courseName" => $course->getCourseName(),
                                        "subject" => $question->getSubject(),
                                        "description" => $question->getDescription(),
                                        "askTime" => $question->getAskTime(),
                                        "questionID" => $question->getQuestionID(),
                                        "askUserID" => $question->getUserID(),
                                        "userID" => $user->getUserID(),
                                        "userRole" => $role);

                array_push($questionTableData, $singleQuestion);
            }

            echo json_encode($questionTableData);
        break;

        // ----------- CHECK UNRESOLVED/ACCEPTED QUESTIONS [AJAX/POST] -----------  //
        case "check_accepted":
            $resolutions = ResolutionDB::RetrieveUnfinishedResolutions();

            if ($resolutions != null) {
                $acceptedQuestionInfo = array();
                foreach ($resolutions as $resolution) {
                    $tutor = TutorDB::RetrieveTutorByID($resolution->getUserID());
                    $question = QuestionDB::GetQuestionByID($resolution->getQuestionID());
                    $userID = $question->getUserID();

                    $singleResolution = array("tutorFName" => $tutor->getFirstName(),
                                            "tutorLName" => $tutor->getLastName(),
                                            "tutorEmail" => $tutor->getEmail(),
                                            "description" => $question->getDescription(),
                                            "openTime" => $question->getOpenTime(),
                                            "uID" => $question->getUserID(),
                                            "ouID" => $user->getUserID(),
                                            "qID" => $question->getQuestionID());

                    array_push($acceptedQuestionInfo, $singleResolution);
                }
                echo json_encode($acceptedQuestionInfo);
            }
            else
                echo json_encode(null);
        break;

        // ----------- GET SPECIFIC QUESTIONS [AJAX/POST] -----------  //
        case "question_details":
            $questionID = filter_input(INPUT_POST, "viewQuestion");
            $questionDetails = QuestionDB::GetQuestionByID($questionID);
            $studentDetails = StudentDB::RetrieveStudentByID($questionDetails->getUserID());
            $questionJSON = array(
                                    "courseNumber" => $questionDetails->getCourseNumber(),
                                    "subject" => $questionDetails->getSubject(),
                                    "question" => $questionDetails->getDescription(),
                                    "questionID" => $questionDetails->getQuestionID(),
                                    "askTime" => $questionDetails->getAskTime(),
                                    "studentFirstName" => $studentDetails->getFirstName(),
                                    "studentLastName" => $studentDetails->getLastName(),
                                    "studentEmail" => $studentDetails->getEmail());

            echo json_encode($questionJSON);
        break;

        // ----------- ACCEPT SPECIFIC QUESTIONS [AJAX/POST] -----------  //
        case "accept_question":
            $questionID = filter_input(INPUT_POST, "acceptQuestion");
            $questionDetails = QuestionDB::GetQuestionByID($questionID);
            $studentDetails = StudentDB::RetrieveStudentByID($questionDetails->getUserID());

            $questionDetails->setStatus('In-Process');
            $questionDetails->setOpenTime(date("Y-m-d H:i:s", time()));
            QuestionDB::UpdateQuestion($questionDetails);

            $newResolution = new Resolution($questionID, $user->getUserID());
            ResolutionDB::CreateResolution($newResolution);

            $questionJSON = array(
                                    "courseNumber" => $questionDetails->getCourseNumber(),
                                    "subject" => $questionDetails->getSubject(),
                                    "question" => $questionDetails->getDescription(),
                                    "questionID" => $questionDetails->getQuestionID(),
                                    "askTime" => $questionDetails->getAskTime(),
                                    "studentFirstName" => $studentDetails->getFirstName(),
                                    "studentLastName" => $studentDetails->getLastName(),
                                    "studentEmail" => $studentDetails->getEmail());

            echo json_encode($questionJSON);
        break;

        // ----------- REOPEN SPECIFIC QUESTIONS [AJAX/POST] -----------  //
        case "reopen_question":
            if (filter_input(INPUT_POST, "openQuestion") !== null) {
                $questionID = filter_input(INPUT_POST, "openQuestion");
                $questionDetails = QuestionDB::GetQuestionByID($questionID);
                $questionDetails->setStatus('Open');
                $questionDetails->setOpenTime(null);
                QuestionDB::UpdateQuestion($questionDetails);

                $resolution = ResolutionDB::RetrieveResolutionByID($questionID);
                ResolutionDB::DeleteResolution($resolution);
            }
        break;

        case "escalate_question":
            if (filter_input(INPUT_POST, "escalateQuestion") !== null) {
                $questionID = filter_input(INPUT_POST, "escalateQuestion");
                $questionDetails = QuestionDB::GetQuestionByID($questionID);
                $questionDetails->setStatus('Escalated');
                QuestionDB::UpdateQuestion($questionDetails);
            }
        break;

        case "resolve_question":
            if (filter_input(INPUT_POST, "resolveQuestion") !== null) {
                $questionID = filter_input(INPUT_POST, "resolveQuestion");
                $questionDetails = QuestionDB::GetQuestionByID($questionID);
                $questionDetails->setStatus('Resolved');
                $questionDetails->setCloseTime(date("Y-m-d H:i:s", time()));

                $res = ResolutionDB::RetrieveResolutionByID($questionID);
                $res->setResolution('Resolved');
                ResolutionDB::UpdateResolution($res);
                QuestionDB::UpdateQuestion($questionDetails);
            }
        break;

        case "schedule":
            include("./Views/schedule.php");
        break;

        case "delete_schedule":
            $id = filter_input(INPUT_POST, 'id');
            if (isset($id)) {
                $temp = new Schedule(1, date("Y-m-d H:i:s", time()), date("Y-m-d H:i:s", time()), 1, $id);
                $schedule = scheduledb::GetSchedule($temp);
                scheduledb::DeleteSchedule($schedule);
                $schedules = scheduledb::GetTutorSchedule($user);
                $_SESSION['schedule'] = $schedules;
                include("./Views/tutor_schedule.php");
            }
        break;

        case "edit_schedule":
            if ($role == 'tutor') {
                $scheduleError = "";
                $date = filter_input(INPUT_POST, "Day");
                $start = filter_input(INPUT_POST, "StartTime");
                $end = filter_input(INPUT_POST, "EndTime");
                if (isset($start) && isset($end)) {
                    //Add schedule verification here 9-5
                    $startTime = date("Y-m-d H:i:s", strtotime($start));
                    $endTime = date("Y-m-d H:i:s", strtotime($end));
                    $weekDay = date('N', strtotime($date));
                    $userID = $user->getUserID();
                    $shift = new Schedule($userID, $startTime, $endTime, $weekDay);
                    scheduledb::CreateSchedule($shift);
                    //else throw schedule error here
                }
                $schedules = scheduledb::GetTutorSchedule($user);
                $_SESSION['schedule'] = $schedules;
                include("./Views/tutor_schedule.php");
                break;
            } else {
                include("./Views/Home.php");
            }
        break;

	// ----------- EDIT APPUSER(STUDENT) PROFILE -----------  //
	    case "edit":
            $profileSuccess = "";
            $profileErrors = array();
			$uploadSuccess = "";
			$uploadErrors = array();
            include("./Views/edit.php");
        break;
        
        case "edit_profile":
            $profileSuccess = "";
            $profileErrors = array();
			$uploadSuccess = "";
			$uploadErrors = array();
			
            $email = filter_input(INPUT_POST, "newEmail", FILTER_VALIDATE_EMAIL);
            $bio = filter_input(INPUT_POST, "newBio", FILTER_SANITIZE_STRING);
            if ($email === false || $email === null)
            	$profileErrors[] = "Please provide a valid email address.";
            if ($bio === false || $bio === null)
            	$profileErrors[] = "Please tell us something about yourself.";            
            if ($user instanceof Tutor) {
            	$tutorbio = filter_input(INPUT_POST, "newTutorBio", FILTER_SANITIZE_STRING);  
            	if ($tutorbio === false || $tutorbio === null)
            		$profileErrors[] = "Please tell us something about your tutoring expertise.";  
            }
            if ($user instanceof Student) {
            	$majorid = filter_input(INPUT_POST, "newStudentMajor", FILTER_VALIDATE_INT);  
            	if ($majorid === false || $majorid === null)
            		$profileErrors[] = "Please select your major.";  
            }
            if (count($profileErrors) == 0) {
            	$user->setEmail($email);
            	$user->setBio($bio);
            	if ($user instanceof Tutor) {
            		$user->setTutorBio($tutorbio);
					TutorDB::UpdateTutor($user);
            	}
            	else {
            		$user->setMajorId($majorid);
            		StudentDB::UpdateStudent($user);
            	}
            	$profileSuccess = "Your profile has been saved.";
            }
            include("./Views/edit.php");
        break;
        
		case "upload_picture":
            $profileSuccess = "";
            $profileErrors = array();
			$uploadSuccess = "";
			$uploadErrors = array();
			if (uploadPicture($doc_root, $picture_path, $user, $uploadErrors))
				// this is not displayed on the page because the new image is loaded on success
				$uploadSuccess = "Your image was successfully uploaded.";
			include("./Views/edit.php");
		break;
    }
} catch (PDOException $pdoEx) {
    $error_message = $pdoEx->getMessage();
    include('./Errors/database_error.php');
    exit();
}
catch (Exception $ex) {
    $error_message = $ex->getMessage();
    echo($error_message);
    exit();
}
