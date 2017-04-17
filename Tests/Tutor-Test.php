<?php
include_once('../Models/db.php');
include_once('../Models/appuser.php');
include_once('../Models/tutor.php');
include_once('../Models/tutordb.php');


function canConstructTutor()
{
    $Tutor = new Tutor('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);

    if (isset($Tutor)) {
        echo "<p style='color:green;'> Creating a Tutor was successful! </p>";
    } else {
        echo "<p style='color:red;'> Creating a Tutor was not successful! </p>";
    }
}

function canGetTutorID()
{
    $Tutor = new Tutor('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1, 1);
    if ($Tutor->getUserID() == 1) {
        echo "<p style='color:green;'> Getting the Tutor id was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the Tutor id was not successful! </p>";
    }
}

function canGetTutorLNumber()
{
    $Tutor = new Tutor('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);
    if ($Tutor->getLNumber() == 'L00123123') {
        echo "<p style='color:green;'> Getting the Tutor's lnumber was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the Tutor's lnumber was not successful! </p>";
        echo $Tutor->getLNumber();
    }
}

function canGetTutorFirstName()
{
    $Tutor = new Tutor('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);

    if ($Tutor->getFirstName() == 'test') {
        echo "<p style='color:green;'> Getting the Tutor's first name was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the Tutor's first name was not successful! </p>";
    }
}

function canSetTutorFirstName()
{
    $Tutor = new Tutor('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);
    $Tutor->setFirstName('newname');

    if ($Tutor->getFirstName() == 'newname') {
        echo "<p style='color:green;'> Setting the Tutor's first name was successful! </p>";
    } else {
        echo "<p style='color:red;'> Setting the Tutor's first name was not successful! </p>";
    }
}

function canGetTutorLastName()
{
    $Tutor = new Tutor('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);

    if ($Tutor->getLastName() == 'user') {
        echo "<p style='color:green;'> Getting the Tutor's last name was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the Tutor's last name was not successful! </p>";
    }
}

function canSetTutorLastName()
{
    $Tutor = new Tutor('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);
    $Tutor->setLastName('newname');

    if ($Tutor->getLastName() == 'newname') {
        echo "<p style='color:green;'> Setting the Tutor's last name was successful! </p>";
    } else {
        echo "<p style='color:red;'> Setting the Tutor's last name was not successful! </p>";
    }
}

function canGetTutorPassword()
{
    $Tutor = new Tutor('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);

    if ($Tutor->getPassword() == 'testpassword') {
        echo "<p style='color:green;'> Getting the Tutor's password was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the Tutor's password was not successful! </p>";
    }
}

function canSetTutorPassword()
{
    $Tutor = new Tutor('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);
    $Tutor->setPassword('newpassword');

    if ($Tutor->getPassword() == 'newpassword') {
        echo "<p style='color:green;'> Setting the Tutor's password was successful! </p>";
    } else {
        echo "<p style='color:red;'> Setting the Tutor's password was not successful! </p>";
    }
}

function canGetTutorEmail()
{
    $Tutor = new Tutor('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);

    if ($Tutor->getEmail() == 'email@email.com') {
        echo "<p style='color:green;'> Getting the Tutor's email was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the Tutor's email was not successful! </p>";
    }
}

function canSetTutorEmail()
{
    $Tutor = new Tutor('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 1);
    $Tutor->setEmail('newemail');

    if ($Tutor->getEmail() == 'newemail') {
        echo "<p style='color:green;'> Setting the Tutor's email was successful! </p>";
    } else {
        echo "<p style='color:red;'> Setting the Tutor's email was not successful! </p>";
    }
}

function canGetTutorBio()
{
    $Tutor = new Tutor('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 'testbio');

    if ($Tutor->getTutorBio() == 'testbio') {
        echo "<p style='color:green;'> Getting the Tutor's bio was successful! </p>";
    } else {
        echo "<p style='color:red;'> Getting the Tutor's bio was not successful! </p>";
    }
}

function canSetTutorBio()
{
    $Tutor = new Tutor('test', 'user', 'L00123123', 'testpassword', 'email@email.com', 'testbio');
    $Tutor->setTutorBio('testbio change');

    if ($Tutor->getTutorBio() == 'testbio change') {
        echo "<p style='color:green;'> Setting the Tutor's bio was successful! </p>";
    } else {
        echo "<p style='color:red;'> Setting the Tutor's bio was not successful! </p>";
    }
}

canConstructTutor();
canGetTutorID();
canGetTutorLNumber();
canGetTutorFirstName();
canSetTutorFirstName();
canGetTutorLastName();
canSetTutorLastName();
canGetTutorPassword();
canSetTutorPassword();
canGetTutorEmail();
canSetTutorEmail();
canGetTutorBio();
canSetTutorBio();
