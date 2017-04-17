<?php
include_once('../Models/course.php');

function canConstructCourse()
{
    $course = new Course('CS 296N', 'ASP.Net Core MVC', 1);

    if (isset($course)) {
        echo "<p style='color:green;'> Creating a course was successful! </p>";
    } else {
        echo "<p style='color:red;'> Creating a course was not successful! </p>";
    }
}

function canGetCourseNumber()
{
    $course = new Course('CS 296N', 'ASP.Net Core MVC', 1);

    if ($course->getCourseNumber() == 'CS 296N') {
        echo "<p style='color:green;'> Getting the course number was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the course number was not successful! </p>";
    }
}

function canSetCourseNumber()
{
    $course = new Course('CS 295N', 'ASP.Net Core MVC', 1);
    $course->setCourseNumber('CS 296N');

    if ($course->getCourseNumber() == 'CS 296N') {
        echo "<p style='color:green;'> Setting the course number was successful! </p>";
    } else {
        echo "<p style='color:red;'> Setting the course number was not successful! </p>";
    }
}

function canGetCourseName()
{
    $course = new Course('CS 296N', 'ASP.Net Core MVC', 1);

    if ($course->getCourseName() == 'ASP.Net Core MVC') {
        echo "<p style='color:green;'> Getting the course name was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the course name was not successful! </p>";
    }
}

function canSetCourseName()
{
    $course = new Course('CS 296N', 'ASP.Net', 1);
    $course->setCourseName('ASP.Net Core MVC');

    if ($course->getCourseName() == 'ASP.Net Core MVC') {
        echo "<p style='color:green;'> Setting the course name was successful! </p>";
    } else {
        echo "<p style='color:red;'> Setting the course name was not successful! </p>";
    }
}

function canGetLeadInstructor()
{
    $course = new Course('CS 296N', 'ASP.Net Core MVC', 1);

    if ($course->getLeadInstructor() == 1) {
        echo "<p style='color:green;'> Getting the lead instructor was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the lead instructor was not successful! </p>";
    }
}

function canSetLeadInstructor()
{
    $course = new Course('CS 296N', 'ASP.Net Core MVC', 2);
    $course->setLeadInstructor(1);

    if ($course->getLeadInstructor() == 1) {
        echo "<p style='color:green;'> Setting the lead instructor was successful! </p>";
    } else {
        echo "<p style='color:red;'> Setting the lead instructor was not successful! </p>";
    }
}

canConstructCourse();
canGetCourseNumber();
canGetCourseName();
canGetLeadInstructor();
canSetCourseNumber();
canSetCourseName();
canSetLeadInstructor();
