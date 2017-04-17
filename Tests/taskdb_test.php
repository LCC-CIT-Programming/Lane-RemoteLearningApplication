<?php
include_once('../Models/task.php');
include_once('../Models/taskdb.php');
include_once('../Models/db.php');

function canCreateTask()
{
    $task = new Task(1, 'CIS 244', date("Y-m-d h:i:s"));
    try {
        taskdb::CreateTask($task);
        echo "<p style='color:green;'> Creating a task was successful! </p>";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function canRetrieveTask()
{
    $task = new Task(1, 'CIS 244', date("Y-m-d h:i:s"), 2);
    $retrievedtask = taskdb::RetrieveTask($task);

    if ($retrievedtask->getCourseNumber() == 'CIS 244') {
        echo "<p style='color:green;'> Retrieving a task was successful! </p>";
    } else {
        echo "<p style='color:red;'> Retrieving a task was not successful! </p>";
    }
}

function canUpdateTask()
{
    $task = new Task(1, 'CIS 244', date("Y-m-d h:i:s"), 2, date("Y-m-d h:i:s"));
    taskdb::UpdateTask($task);
    $retrievedtask = taskdb::RetrieveTaskByID($task);

    if ($retrievedtask->getEndTime() == date("Y-m-d h:i:s")) {
        echo "<p style='color:green;'> Updating a task was successful! </p>";
    } else {
        echo "<p style='color:red;'> Updating a task was not successful! </p>";
    }
}

function canDeleteTask()
{
    $task = new Task(1, 'CIS 244', date("Y-m-d h:i:s"), 3);
    taskdb::DeleteTask($task);
    $retrievedtask = taskdb::RetrieveTaskByID($task);

    if ($retrievedtask == null) {
        echo "<p style='color:green;'> Deleting a task was successful! </p>";
    } else {
        echo "<p style='color:red;'> Deleting a task was not successful! </p>";
    }
}

canCreateTask();
canRetrieveTask();
canUpdateTask();
canDeleteTask();
