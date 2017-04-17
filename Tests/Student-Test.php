<?php
include_once('../Models/appuser.php');
include_once('../Models/student.php');

function canConstructStudent()
{
    $student = new Student('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);

    if (isset($student)) {
        echo "<p style='color:green;'> Creating a student was successful! </p>";
    } else {
        echo "<p style='color:red;'> Creating a student was not successful! </p>";
    }
}

function canGetStudentID()
{
    $student = new Student('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1, 1);

    if ($student->getUserID() == 1) {
        echo "<p style='color:green;'> Getting the student id was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the student id was not successful! </p>";
    }
}

function canGetStudentLNumber()
{
    $student = new Student('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);

    if ($student->getLNumber() == 'L00123123') {
        echo "<p style='color:green;'> Getting the student's lnumber was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the student's lnumber was not successful! </p>";
        echo $student->getLNumber();
    }
}

function canGetStudentFirstName()
{
    $student = new Student('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);

    if ($student->getFirstName() == 'test') {
        echo "<p style='color:green;'> Getting the student's first name was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the student's first name was not successful! </p>";
    }
}

function canSetStudentFirstName()
{
    $student = new Student('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);
    $student->setFirstName('newname');

    if ($student->getFirstName() == 'newname') {
        echo "<p style='color:green;'> Setting the student's first name was successful! </p>";
    } else {
        echo "<p style='color:red;'> Setting the student's first name was not successful! </p>";
    }
}

function canGetStudentLastName()
{
    $student = new Student('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);

    if ($student->getLastName() == 'user') {
        echo "<p style='color:green;'> Getting the student's last name was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the student's last name was not successful! </p>";
    }
}

function canSetStudentLastName()
{
    $student = new Student('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);
    $student->setLastName('newname');

    if ($student->getLastName() == 'newname') {
        echo "<p style='color:green;'> Setting the student's last name was successful! </p>";
    } else {
        echo "<p style='color:red;'> Setting the student's last name was not successful! </p>";
    }
}

function canGetStudentPassword()
{
    $student = new Student('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);

    if ($student->getPassword() == 'testpassword') {
        echo "<p style='color:green;'> Getting the student's password was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the student's password was not successful! </p>";
    }
}

function canSetStudentPassword()
{
    $student = new Student('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);
    $student->setPassword('newpassword');

    if ($student->getPassword() == 'newpassword') {
        echo "<p style='color:green;'> Setting the student's password was successful! </p>";
    } else {
        echo "<p style='color:red;'> Setting the student's password was not successful! </p>";
    }
}

function canGetStudentEmail()
{
    $student = new Student('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);

    if ($student->getEmail() == 'email@email.com') {
        echo "<p style='color:green;'> Getting the student's email was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the student's email was not successful! </p>";
    }
}

function canSetStudentEmail()
{
    $student = new Student('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);
    $student->setEmail('newemail');

    if ($student->getEmail() == 'newemail') {
        echo "<p style='color:green;'> Setting the student's email was successful! </p>";
    } else {
        echo "<p style='color:red;'> Setting the student's email was not successful! </p>";
    }
}

function canGetStudentMajor()
{
    $student = new Student('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);

    if ($student->getMajorID() == 1) {
        echo "<p style='color:green;'> Getting the student's major was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the student's major was not successful! </p>";
    }
}

function canSetStudentMajor()
{
    $student = new Student('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);
    $student->setMajorID(2);

    if ($student->getMajorID() == 2) {
        echo "<p style='color:green;'> Setting the student's major was successful! </p>";
    } else {
        echo "<p style='color:red;'> Setting the student's major was not successful! </p>";
    }
}

canConstructStudent();
canGetStudentID();
canGetStudentLNumber();
canGetStudentFirstName();
canSetStudentFirstName();
canGetStudentLastName();
canSetStudentLastName();
canGetStudentPassword();
canSetStudentPassword();
canGetStudentEmail();
canSetStudentEmail();
canGetStudentMajor();
canSetStudentMajor();
