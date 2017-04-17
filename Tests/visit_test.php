<?php
include_once('../Models/visit.php');

function canConstructVisit()
{
    $visit = new Visit(5, 1, 1, date("Y-m-d h:i:s"));

    if (isset($visit)) {
        echo "<p style='color:green;'> Creating a visit was successful! </p>";
    } else {
        echo "<p style='color:red;'> Creating a visit was not successful! </p>";
    }
}

function canGetVisitID()
{
    $visit = new Visit(5, 1, 1, date("Y-m-d h:i:s"));

    if ($visit->getVisitID() == 1) {
        echo "<p style='color:green;'> Getting the visit id was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the visit id was not successful! </p>";
    }
}

function canGetUserID()
{
    $visit = new Visit(5, 1);

    if ($visit->getUserID() == 5) {
        echo "<p style='color:green;'> Getting the user id was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the user id was not successful! </p>";
    }
}

function canGetLocationID()
{
    $visit = new Visit(5, 1);

    if ($visit->getLocationID() == 1) {
        echo "<p style='color:green;'> Getting the location id was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the location id was not successful! </p>";
    }
}

function canGetStartTime()
{
    $visit = new Visit(5, 1, 1, date("Y-m-d h:i:s"));

    if ($visit->getStartTime() == date("Y-m-d h:i:s")) {
        echo "<p style='color:green;'> Getting the start time was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the start time was not successful! </p>";
    }
}

function canGetEndTime()
{
    $visit = new Visit(5, 1, 1, date("Y-m-d h:i:s"));

    if ($visit->getEndTime() == null) {
        echo "<p style='color:green;'> Getting the end time was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the end time was not successful! </p>";
    }
}

function canSetEndTime()
{
    $visit = new Visit(5, 1, 1, date("Y-m-d h:i:s"));
    $visit->setEndTime(date("Y-m-d h:i:s", 1487105670));

    if ($visit->getEndTime() == date("Y-m-d h:i:s", 1487105670)) {
        echo "<p style='color:green;'> Setting the end time was successful! </p>";
    } else {
        echo "<p style='color:red;'> Setting the end time was not successful! </p>";
    }
}

function canSetLocationID()
{
    $visit = new Visit(5, 1, 1, date("Y-m-d h:i:s"));
    $visit->setLocationID(2);

    if ($visit->getLocationID() == 2) {
        echo "<p style='color:green;'> Setting the location id was successful! </p>";
    } else {
        echo "<p style='color:red;'> Setting the location id was not successful! </p>";
    }
}

canConstructVisit();
canGetVisitID();
canGetUserID();
canGetLocationID();
canGetStartTime();
canGetEndTime();
canSetEndTime();
canSetLocationID();
