<?php

$useCAS = false;
$doc_root = "/var/www/citlab/";
$app_path = "/citlab/";
$picture_path = "ProfilePictures/";

require_once('Utils/settimezone.php');
//require_once('Utils/filepath.php');
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
require_once('Models/instructor.php');
require_once('Models/instructordb.php');
require_once('CAS/config.php');
require_once('CAS/CAS.php');

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
                //Only for testing
                phpCAS::setDebug();
                phpCAS::setVerbose(true);
                phpCAS::setNoCasServerValidation();
                //End testing
                //phpCAS::setCasServerCACert($cas_server_ca_cert_path); //Need
                //to set in production.
                phpCAS::client(CAS_VERSION_2_0, $cas_host, $cas_port,
                               $cas_context);
                if (phpCAS::forceAuthentication()) {
                    $user = AppUser::login($username, $role);
                }
                else {
                    $user = null;
                }
            }
            else {
                $user = AppUser::login($username, $role);
            }

            // ----------- SUCCESSFUL LOGIN -----------  //            
            $_SESSION['user'] = $user;
            if ($user !== null) {
            	if ($role == 'student' || $role == 'tutor')
            	    $visit = $_SESSION['visit'];
            	header('Location: index.php?action=home');
                die();
            }
            // -----------   FAILED LOGIN   -----------  //
            else {
                $loginError = "Login attempt failed.";
                include("./Views/login.php");
                die();
            }
        break;

        // ----------- ASK [GET] -----------  //
        case "ask":
            $questionStatus = "";
            $task = $_SESSION['task'];
            include("./Views/ask.php");
        break;

        // ----------- ASK [POST] -----------  //
        case "ask_question":
            $questionStatus = "";
            $courseNum = filter_input(INPUT_POST, "courseSelect");
            $subject = filter_input(INPUT_POST, "subject", FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);
			if ($courseNum == null || $courseNum === false || 
				$subject == null || $subject === false || 
				$description == null || $description === false) 
			{
				$questionStatus = "Invalid question. Check all fields and try again.";
			} 
			else 
			{
			    Question::AskQuestion($courseNum, $subject, $description);
			    // asking a question about another course will change the task in session
			    $task = $_SESSION['task'];
			    $questionStatus = "Question created, ask another?";
			}
            include("./Views/ask.php");
        break;

        // ----------- TASK [AJAX/POST] -----------  //
        case "update_task":
            $task = $_SESSION['task'];
            $courseNumber = filter_input(INPUT_POST, "courseNumber");
            $taskType = filter_input(INPUT_POST, "taskType");
            $currentTask = Task::ChangeTask($courseNumber, $taskType, $visit, $task);          
            $_SESSION['task'] = $currentTask;
            $task = $currentTask;
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
                else if ($role == 'tutor') {
					$visit->setEndTime(date("Y-m-d H:i:s", time()));
					visitdb::UpdateVisit($visit);
				}
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
            //$questions = QuestionDB::getOpenQuestions();
            //$questions = QuestionDB::getUnresolvedQuestions();
            $questions = QuestionDB::GetUnresolvedQuestionsForOnlineStudents();
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
                                        "userRole" => $role,
                                        "status" => $question->getStatus());

                array_push($questionTableData, $singleQuestion);
            }

            echo json_encode($questionTableData);
        break;

        // ----------- CHECK UNRESOLVED/ACCEPTED QUESTIONS [AJAX/POST] -----------  //
        case "check_accepted":
            $resolutions = ResolutionDB::RetrieveUnfinishedResolutionsForStudentByStatus($user->getUserID(), 'Tutor Accepted');

            if ($resolutions != null) {
                $acceptedQuestionInfo = array();
                foreach ($resolutions as $resolution) {
                    $tutor = TutorDB::RetrieveTutorByID($resolution->getUserID());
                    $tutorVisit = VisitDB::RetrieveLastVisit($tutor->getUserID(), "tutor");
                    $question = QuestionDB::GetQuestionByID($resolution->getQuestionID());
                    
            		if (($tutorVisit != null) && 
            			($tutorVisit->getLocationID() == $visit->getLocationID()) &&
            		 	($tutorVisit->getLocationID() <= 2)) // either of our labs
						$showUrl = false;
					else 
						$showUrl = true;
					
					//$showUrl = true;
                    $singleResolution = array("tutorFName" => $tutor->getFirstName(),
                                            "tutorLName" => $tutor->getLastName(),
                                            "tutorEmail" => $tutor->getEmail(),
                                            "description" => $question->getDescription(),
                                            "openTime" => $question->getOpenTime(),
                                            "uID" => $question->getUserID(),
                                            "ouID" => $user->getUserID(),
                                            "qID" => $question->getQuestionID(),
                                            "showUrl" => $showUrl);

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
            $resolution = ResolutionDB::RetrieveResolutionByID($questionID);
            if ($resolution != null) {
            	$tutorDetails = TutorDB::RetrieveTutorByID($resolution->getUserID());
            	$tutorName = $tutorDetails->getFirstName() . " " . $tutorDetails->getLastName() ;
            }
            else
            	$tutorName = "";
	
            
            $questionJSON = array(
                                    "courseNumber" => $questionDetails->getCourseNumber(),
                                    "subject" => $questionDetails->getSubject(),
                                    "question" => $questionDetails->getDescription(),
                                    "questionID" => $questionDetails->getQuestionID(),
                                    "askTime" => $questionDetails->getAskTime(),
                                    "status" => $questionDetails->getStatus(), 
                                    "resolutionText" => ($resolution != null) ? $resolution->getResolution() : "" ,
                                    "tutorName" => $tutorName,  
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

            $questionDetails->setStatus('Tutor Accepted');
            $questionDetails->setOpenTime(date("Y-m-d H:i:s", time()));
            QuestionDB::UpdateQuestion($questionDetails);
            
            $resolution = ResolutionDB::RetrieveResolutionByID($questionID);
            if ($resolution == null) {
				$newResolution = new Resolution($questionID, $user->getUserID());
				ResolutionDB::CreateResolution($newResolution);
            }
            else {
            	$resolution->setUserID($user->getUserID());
            	$resolution->setResolution("");
            	ResolutionDB::UpdateResolution($resolution);
            }

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
        
        case "acknowledge_tutor":
            if (filter_input(INPUT_POST, "acknowledgeQuestion") !== null) {
                $questionID = filter_input(INPUT_POST, "acknowledgeQuestion");
                $questionDetails = QuestionDB::GetQuestionByID($questionID);
                $questionDetails->setStatus('Student Acknowledged');
                QuestionDB::UpdateQuestion($questionDetails);
            }
        break;

        // ----------- REOPEN SPECIFIC QUESTIONS [AJAX/POST] -----------  //
        case "reopen_question":
            if (filter_input(INPUT_POST, "openQuestion") !== null) {
                $questionID = filter_input(INPUT_POST, "openQuestion");
                $description = filter_input(INPUT_POST, "resolutionText", FILTER_SANITIZE_STRING);
                $questionDetails = QuestionDB::GetQuestionByID($questionID);
                $questionDetails->setStatus('Open');
                $questionDetails->setOpenTime(null);
                QuestionDB::UpdateQuestion($questionDetails);

                $resolution = ResolutionDB::RetrieveResolutionByID($questionID);
                $resolution->setUserID($user->getUserID());
                $resolution->setResolution($description);
                ResolutionDB::UpdateResolution($resolution);
                //ResolutionDB::DeleteResolution($resolution);
            }
        break;

        case "escalate_question":
            if (filter_input(INPUT_POST, "escalateQuestion") !== null) {
                $questionID = filter_input(INPUT_POST, "escalateQuestion");
                $description = filter_input(INPUT_POST, "escalationText", FILTER_SANITIZE_STRING);
                $questionDetails = QuestionDB::GetQuestionByID($questionID);
                $questionDetails->setStatus('Escalated');
                
                $res = ResolutionDB::RetrieveResolutionByID($questionID);
                $res->setUserID($user->getUserID());
                $res->setResolution($description);
                ResolutionDB::UpdateResolution($res);
                QuestionDB::UpdateQuestion($questionDetails);
            }
        break;

        case "resolve_question":
            if (filter_input(INPUT_POST, "resolveQuestion") !== null) {
                $questionID = filter_input(INPUT_POST, "resolveQuestion");
                $description = filter_input(INPUT_POST, "resolutionText", FILTER_SANITIZE_STRING);
                $questionDetails = QuestionDB::GetQuestionByID($questionID);
                $questionDetails->setStatus('Resolved');
                $questionDetails->setCloseTime(date("Y-m-d H:i:s", time()));

                $res = ResolutionDB::RetrieveResolutionByID($questionID);
                $res->setUserID($user->getUserID());
                $res->setResolution($description);
                ResolutionDB::UpdateResolution($res);
                QuestionDB::UpdateQuestion($questionDetails);
            }
        break;
        
	// ----------- TUTOR SCHEDULE -----------  //
        case "schedule":
            include("./Views/schedule.php");
        break;

        case "delete_schedule":
            $id = filter_input(INPUT_POST, 'id');
            if (isset($id)) {
                $temp = new Schedule(1, date("Y-m-d H:i:s", time()), date("Y-m-d H:i:s", time()), 1, $id);
                $schedule = ScheduleDB::GetSchedule($temp);
                ScheduleDB::DeleteSchedule($schedule);
                $schedules = ScheduleDB::GetTutorSchedule($user);
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
            	else if ($user instanceof Student) {
            		$user->setMajorId($majorid);
            		StudentDB::UpdateStudent($user);
            	}
            	else if ($user instanceof Instructor) {
            		InstructorDB::UpdateInstructor($user);
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
	
    $datetime = new DateTime();    
    $datetime->setTimezone(new DateTimeZone('America/Los_Angeles'));    
    $logEntry = $datetime->format('Y/m/d H:i:s') . '/' .              
    	$pdoEx->getMessage(). '/' .        
        $pdoEx->getCode() . '/' .        
        $pdoEx->getFile() . '/' .        
        $pdoEx->getLine();      
    error_log($logEntry);   
    
    include('./Errors/database_error.php');
    exit();
}
catch (Exception $ex) {
	
    $datetime = new DateTime();    
    $datetime->setTimezone(new DateTimeZone('America/Los_Angeles'));    
    $logEntry = $datetime->format('Y/m/d H:i:s') . '/' .              
    	$ex->getMessage(). '/' .        
        $ex->getCode() . '/' .        
        $ex->getFile() . '/' .        
        $ex->getLine();      
    error_log($logEntry);   
    
    include('./Errors/database_error.php');
    exit();
}
