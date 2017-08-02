<?php
require_once('Utils/filepath.php');
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

try {

    session_start();
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    }
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

    $action = filter_input(INPUT_POST, 'action');
    if ($action == null) {
        $action = filter_input(INPUT_GET, 'action');
        if ($action == null) {
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
            $user = AppUser::login($username, $password, $role);
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
            $currentTask = Task::ChangeTask($courseNumber, $visit, $task);
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

        // ----------- LOGOUT [GET] -----------  //
        case "logout":
            if (isset($task) || isset($visit) || isset($role)) {
                if ($role == 'student') {
                    $task->setEndTime(date("Y-m-d h:i:s", time()));
                    taskdb::UpdateTask($task);
                }
                    $visit->setEndTime(date("Y-m-d h:i:s", time()));
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
            $questionDetails->setOpenTime(date("Y-m-d h:i:s", time()));
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
                $questionDetails->setCloseTime(date("Y-m-d h:i:s", time()));

                $res = ResolutionDB::RetrieveResolutionByID($questionID);
                $res->setResolution('Resolved');
                ResolutionDB::UpdateResolution($res);
                QuestionDB::UpdateQuestion($questionDetails);
            }
        break;

        case "schedule":
            include("./Views/schedule.php");
        break;

        case "edit":
            $success = "";
            $passError = "";
            include("./Views/edit.php");
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


        case "edit_profile":
            $success = "";
            $passError = "";
            $email = filter_input(INPUT_POST, "email");
            $pass1 = filter_input(INPUT_POST, "newPwd1");
            $pass2 = filter_input(INPUT_POST, "newPwd2");

            if ($pass1 != $pass2) {
                $passError = "Sorry the passwords do not match, please try again.";
                $success = "";
                include("./Views/edit.php");
            }
            else
            {
                $user = $_SESSION['user'];
                $userID = $user->GetUserID();

                //Verify they actually inted to change their pass.
                $user->setEmail($email);
                if ($pass1 != "") {
                    $user->setPassword($pass1);
                }

                StudentDB::UpdateProfile($user);
                $success = "Changes have been saved.";
                include("./Views/edit.php");
            }
        break;
    }
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include('./Errors/database_error.php');
    exit();
}
