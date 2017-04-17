<?php
include_once('../Models/appuser.php');
include_once('../Models/student.php');
include_once('../Models/course.php');
include_once('../Models/question.php');

function canConstructQuestion()
{
    $student = new Student('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);
    $studentid = $student->getUserID();
    $course = new Course('CS 296N', 'ASP.Net Core MVC', 1);
    $courseid = $course->getCourseNumber();
    $question = new Question(1, $studentid, $courseid, 'test', 'test', 'test', '2017-01-21');

    if (isset($question)) {
        echo "<p style='color:green;'> Creating a question was successful! </p>";
    } else {
        echo "<p style='color:red;'> Creating a question was not successful! </p>";
    }
}

function canGetQuestionID()
{
    $student = new Student('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1, 1);
    $studentid = $student->getUserID();
    $course = new Course('CS 296N', 'ASP.Net Core MVC', 1);
    $courseid = $course->getCourseNumber();
    $question = new Question($studentid, $courseid, 'test', 'test', 'test', '2017-01-21', 1, 1);

    if ($question->getQuestionID() == 1) {
        echo "<p style='color:green;'> Getting the question id was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the question id was not successful! </p>";
    }
}



function canGetUserID()
{
    $student = new Student('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1, 1);
    $studentid = $student->getUserID();
    $course = new Course('CS 296N', 'ASP.Net Core MVC', 1);
    $courseid = $course->getCourseNumber();

    $question = new Question($studentid, $courseid, 'test', 'test', 'test', '2017-01-21');
    if ($question->getUserID() == 1) {
        echo "<p style='color:green;'> Getting the question's student id was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the question's student id was not successful! </p>";
    }
}

function canGetCourseNumber()
{
    $student = new Student(1, 'test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);
    $studentid = $student->getUserID();
    $course = new Course('CS 296N', 'ASP.Net Core MVC', 1);
    $courseid = $course->getCourseNumber();

    $question = new Question($studentid, $courseid, 'test', 'test', 'test', '2017-01-21');
    if ($question->getCourseNumber() == 'CS 296N') {
        echo "<p style='color:green;'> Getting the question's course number was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the question's course number was not successful! </p>";
        echo $question->getCourse()->getCourseNumber();
    }
}
function canGetSubject()
{
    $student = new Student(1, 'test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);
    $studentid = $student->getUserID();
    $course = new Course('CS 296N', 'ASP.Net Core MVC', 1);
    $courseid = $course->getCourseNumber();

    $question = new Question($studentid, $courseid, 'test', 'test', 'test', '2017-01-21');

    if ($question->getSubject() == 'test') {
        echo "<p style='color:green;'> Getting the question's subject was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the question's subject was not successful! </p>";
    }
}
function canGetDescription()
{
    $student = new Student(1, 'test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);
    $studentid = $student->getUserID();
    $course = new Course('CS 296N', 'ASP.Net Core MVC', 1);
    $courseid = $course->getCourseNumber();
    $question = new Question($studentid, $courseid, 'test', 'test', 'test', '2017-01-21');

    if ($question->getDescription() == 'test') {
        echo "<p style='color:green;'> Getting the question's description was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the question's description was not successful! </p>";
    }
}

function canGetStatus()
{
    $student = new Student(1, 'test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);
    $studentid = $student->getUserID();
    $course = new Course('CS 296N', 'ASP.Net Core MVC', 1);
    $courseid = $course->getCourseNumber();
    $question = new Question($studentid, $courseid, 'test', 'test', 'test', '2017-01-21');

    if ($question->getStatus() == 'test') {
        echo "<p style='color:green;'> Getting the question's status was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the question's status was not successful! </p>";
    }
}

function canSetStatus()
{
    $student = new Student('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);
    $studentid = $student->getUserID();
    $course = new Course('CS 296N', 'ASP.Net Core MVC', 1);
    $courseid = $course->getCourseNumber();
    $question = new Question($studentid, $courseid, 'test', 'test', 'test', '2017-01-21');
    $question->setStatus('status changed');

    if ($question->getStatus() == 'status changed') {
        echo "<p style='color:green;'> Setting the question's status was successful! </p>";
    } else {
        echo "<p style='color:red;'> Setting the question's status was not successful! </p>";
    }
}



function canSetAskTime()
{
    $student = new Student('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);
    $studentid = $student->getUserID();
    $course = new Course('CS 296N', 'ASP.Net Core MVC', 1);
    $courseid = $course->getCourseNumber();
    $question = new Question($studentid, $courseid, 'test', 'test', 'test', '2017-01-21');
    $question->setAskTime('2106-01-21');

    if ($question->getAskTime() == '2106-01-21') {
        echo "<p style='color:green;'> Setting the question's ask time was successful! </p>";
    } else {
        echo "<p style='color:red;'> Setting the question's ask time was not successful! </p>";
    }
}


function canSetOpenTime()
{
    $student = new Student(1, 'test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);
    $studentid = $student->getUserID();
    $course = new Course('CS 296N', 'ASP.Net Core MVC', 1);
    $courseid = $course->getCourseNumber();
    $question = new Question(1, $studentid, $courseid, 'test', 'test', 'test', '2017-01-21');
    $question->setOpenTime('2106-01-21');

    if ($question->getOpenTime() == '2106-01-21') {
        echo "<p style='color:green;'> Setting the question's open time was successful! </p>";
    } else {
        echo "<p style='color:red;'> Setting the question's open time was not successful! </p>";
    }
}

function canSetCloseTime()
{
    $student = new Student(1, 'test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);
    $studentid = $student->getUserID();
    $course = new Course('CS 296N', 'ASP.Net Core MVC', 1);
    $courseid = $course->getCourseNumber();
    $question = new Question(1, $studentid, $courseid, 'test', 'test', 'test', '2017-01-21');
    $question->setOpenTime('2106-01-21');

    if ($question->getOpenTime() == '2106-01-21') {
        echo "<p style='color:green;'> Setting the question's close time was successful! </p>";
    } else {
        echo "<p style='color:red;'> Setting the question's close time was not successful! </p>";
    }
}

canConstructQuestion();
canGetQuestionID();
canGetUserID();
canGetCourseNumber();
canGetSubject();
canGetDescription();
canGetStatus();
canSetStatus();
canSetAskTime();
canSetOpenTime();
canSetCloseTime();
