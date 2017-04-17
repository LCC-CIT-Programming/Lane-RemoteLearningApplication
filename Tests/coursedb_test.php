<?php
include_once('../Models/Course.php');
include_once('../Models/CourseDB.php');
include_once('../Models/db.php');

function canRetrieveCourse()
{
    $course = new Course('CS 133N', 'Beginning C#', 2);
    $valid = CourseDB::RetrieveCourse($course);

    if ($valid != null) {
        echo "<p style='color:green;'>Retrieving the course was successful! </p>";
    } else {
        echo "<p style='color:red;'>Retrieving the course was not successful! </p>";
    }
}

function canRetrieveCourseById()
{
    $valid = CourseDB::RetrieveCourseByNumber('CS 133N');

    if ($valid != null) {
        echo "<p style='color:green;'>Retrieving the course was successful! </p>";
    } else {
        echo "<p style='color:red;'>Retrieving the course was not successful! </p>";
    }
}

function canCreateCourse()
{
    $course = new Course('CS 296N', 'ASP.Net Core MVC', 1);
    CourseDB::CreateCourse($course);

    $valid = CourseDB::RetrieveCourse($course);
    if ($valid != null) {
        echo "<p style='color:green;'>Adding the course was successful! </p>";
    } else {
        echo "<p style='color:red;'>Adding the course was not successful! </p>";
    }
}

function canUpdateCourseByNumber()
{
    $course = new Course('CS 296N', 'test', 2);
    CourseDB::UpdateCourseByNumber($course);
    $valid = CourseDB::RetrieveCourse($course);

    if ($valid->getLeadInstructor() == 2) {
        echo "<p style='color:green;'>Updating the course was successful! </p>";
    } else {
        echo "<p style='color:red;'>Updating the course was not successful! </p>";
    }
}

function canUpdateCourseByName()
{
    $course = new Course('CS 300', 'test', 2);
    CourseDB::UpdateCourseByName($course);
    $valid = CourseDB::RetrieveCourse($course);

    if (($valid->getLeadInstructor() == 2) && ($valid->getCourseNumber() == 'CS 300')) {
        echo "<p style='color:green;'>Updating the course was successful! </p>";
    } else {
        echo "<p style='color:red;'>Updating the course was not successful! </p>";
    }
}

function canDeleteCourse()
{
    $course = new Course('CS 300', 'test', 2);
    CourseDB::DeleteCourse($course);

    $valid = CourseDB::RetrieveCourse($course);
    if ($valid == null) {
        echo "<p style='color:green;'>Deleting the course was successful! </p>";
    } else {
        echo "<p style='color:red;'>Deleting the course was not successful! </p>";
    }
}

canRetrieveCourse();
canRetrieveCourseById();
canCreateCourse();
canUpdateCourseByNumber();
canUpdateCourseByName();
canDeleteCourse();
