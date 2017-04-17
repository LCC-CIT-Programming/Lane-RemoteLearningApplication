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
                    $visit = new Visit($user->GetUserID(), 1, $role, date("Y-m-d h:i:s"));
                    VisitDB::CreateVisit($visit);
                    $visit = VisitDB::RetrieveVisit($visit);
                    $_SESSION['visit'] = $visit;
                    $task = new Task($visit->getVisitID(), $courses[0]->getCourseNumber(), date("Y-m-d h:i:s"));
                    TaskDB::CreateTask($task);
                    $task = TaskDB::RetrieveTask($task);
                    $_SESSION['task'] = $task;
                            header('Location: ?action=home');
                } else {
                    $_SESSION['user'] = null;
                    $loginError = "Login attempt failed.";
                    include("./Views/login.php");
                }
            } elseif ($role == "tutor") {
                    $user = TutorDB::TutorLogin($username, $password);
                    if ($user !== null && isset($user)) {
                        $_SESSION['user'] = $user;
                        $visit = new Visit($user->GetUserID(), 1, $role, date("Y-m-d h:i:s"));
                        VisitDB::CreateVisit($visit);
                        $visit = VisitDB::RetrieveVisit($visit);
                        $_SESSION['visit'] = $visit;
                                //include("./Views/home.php");
                                header('Location: ?action=home');
                    } else {
                        $_SESSION['user'] = null;
                        $loginError = "Login attempt failed.";
                        include("./Views/login.php");
                    }
                } else {
                    include("./Views/login.php");
                }

    break;
    case "ask":
    if ($role == 'student') {
        $questionError = "";
        $success = "";
        include("./Views/ask.php");
    } else {
        include("./Views/home.php");
    }

    break;
    case "ask_question":
        $courseNum = filter_input(INPUT_POST, "courseSelect");
        $subject = filter_input(INPUT_POST, "subject");
        $description = filter_input(INPUT_POST, "description");
        $status = "open";
        $askTime = date("Y-m-d h:i:s");
        if (strpos($user->getEmail(), '@my.lanecc.edu') == false) {
            $questionError = "You must use your my.lanecc.edu email. See your profile to edit account information.";
            $success = "";
            include("./Views/ask.php");
        } elseif ($courseNum == null || $subject == null ||
            $description == null || $status == null || $askTime == null) {
            $questionError = "Invalid question. Check all fields and try again.";
            $success = "";
            include("./Views/ask.php");
        } else {
            $user = $_SESSION['user'];
            $userID = $user->GetUserID();
            $question = new Question($userID, $courseNum, $subject, $description, $status, $askTime);
            QuestionDB::CreateQuestion($question);
            $success = "Question created, ask another?";
            $questionError = "";
            $task = $_SESSION['task'];
            $task->setEndTime(date("Y-m-d h:i:s"));
            taskdb::UpdateTask($task);
            $startNewTask = new Task($visit->getVisitID(), $courseNum, date("Y-m-d h:i:s"));
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
    case "update_location":
    $location = filter_input(INPUT_POST, "locationID");
    $visit->setLocationID($location);
    VisitDB::UpdateVisit($visit);
    echo $visit->getLocationID();
    echo $visit->getVisitID();
    break;

    case "cancel_question":
            $id = filter_input(INPUT_POST, 'id');
            if (isset($id)) {
                $temp = new Question(1, 1, 'a', 'a', 'a', date("Y-m-d h:i:s"), $id);
                $question = QuestionDB::GetQuestion($temp);
                $question->setStatus('Resolved');
                $question->setCloseTime(date("Y-m-d h:i:s", time()));
                QuestionDB::UpdateQuestion($question);
                include("./Views/home.php");
            }
        break;

    case "logout":
            if ($role == 'student') {
                $task->setEndTime(date("Y-m-d h:i:s", time()));
                taskdb::UpdateTask($task);
            }
                $visit->setEndTime(date("Y-m-d h:i:s", time()));
                visitdb::UpdateVisit($visit);
                $loginError = "";
                session_unset();
                session_destroy();
                include("./Views/login.php");
        break;

    case "home":
        include("./Views/home.php");
    break;

    case "question_details":

          $questionID = filter_input(INPUT_POST, "acceptQuestion");
          if ($questionID == null) {
            $questionID = filter_input(INPUT_POST, "viewQuestion");
          }

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
                $date = filter_input(INPUT_POST, "Day");
                $start = filter_input(INPUT_POST, "StartTime");
                $end = filter_input(INPUT_POST, "EndTime");
                if (isset($start) && isset($end)) {
                    $startTime = date("Y-m-d H:i:s", strtotime($start));
                    $endTime = date("Y-m-d H:i:s", strtotime($end));
                    $weekDay = date('N', strtotime($date));
                    $userID = $user->getUserID();
                    $shift = new Schedule($userID, $startTime, $endTime, $weekDay);
                    scheduledb::CreateSchedule($shift);
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
        } else {
            $user = $_SESSION['user'];
            $userID = $user->GetUserID();
            $user->setEmail($email);
            if ($pass1 != "") {
                $user->setPassword($pass1);
            }
            StudentDB::UpdateProfile($user);
            $success = "Changes have been saved.";
            include("./Views/edit.php");
        }
    break;

    case "edit_Schedule":
        include("./Views/tutorSchedule.php");
    break;
    }
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include('./Errors/database_error.php');
    exit();
}
