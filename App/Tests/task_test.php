<?php
include_once('../Models/task.php');

function canConstructTask()
{
    $task = new Task(1, 'CIS 244', date("Y-m-d h:i:s"));

    if (isset($task)) {
        echo "<p style='color:green;'> Creating a visit was successful! </p>";
    } else {
        echo "<p style='color:red;'> Creating a visit was not successful! </p>";
    }
}

function canGetTaskID()
{
    $task = new Task(1, 'CIS 244', date("Y-m-d h:i:s"));

    if ($task->getVisitID() == 1) {
        echo "<p style='color:green;'> Getting the task's visit id was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the task's visit id was not successful! </p>";
    }
}

function canGetCourseNumber()
{
    $task = new Task(1, 'CIS 244', date("Y-m-d h:i:s"));

    if ($task->getCourseNumber() == 'CIS 244') {
        echo "<p style='color:green;'> Getting the task's course number was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the task's course number was not successful! </p>";
    }
}

function canGetStartTime()
{
    $task = new Task(1, 'CIS 244', date("Y-m-d h:i:s"));

    if ($task->getStartTime() == date("Y-m-d h:i:s")) {
        echo "<p style='color:green;'> Getting the start time was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the start time was not successful! </p>";
    }
}

function canGetAndSetTaskID()
{
    $task = new Task(1, 'CIS 244', date("Y-m-d h:i:s"), 3);

    if ($task->getTaskID() == 3) {
        echo "<p style='color:green;'> Setting the task id time was successful! </p>";
    } else {
        echo "<p style='color:red;'> Setting the task id was not successful! </p>";
    }
}


function canGetAndSetEndTime()
{
    $task = new Task(1, 'CIS 244', date("Y-m-d h:i:s"), 3);
    $task->setEndTime(date("Y-m-d h:i:s", 1487105670));

    if ($task->getEndTime() == date("Y-m-d h:i:s", 1487105670)) {
        echo "<p style='color:green;'> Setting the end time was successful! </p>";
    } else {
        echo "<p style='color:red;'> Setting the end time was not successful! </p>";
    }
}

canConstructTask();
canGetTaskID();
canGetCourseNumber();
canGetStartTime();
canGetAndSetTaskID();
canGetAndSetEndTime();
